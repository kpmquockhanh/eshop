<?php
/**
 * Created by PhpStorm.
 * User: kpmqu
 * Date: 2/12/2018
 * Time: 1:53 AM
 */

namespace Khanhlq\Crawler;

use App\Category;
use App\CategoryFlower;
use App\Flower;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Openbuildings\Spiderling\Exception_Notfound;
use Openbuildings\Spiderling\Page;

class Crawler
{
    public $baseUrls;

    protected $page;

    public function __construct()
    {
        $this->page = new Page();
        $this->baseUrls = [
            'https://hoayeuthuong.com/dien-hoa.aspx',
            'https://hoayeuthuong.com/cua-hang-hoa.aspx',
            'https://hoayeuthuong.com/hoa-tuoi.aspx',
        ];
    }

    public function getListCate(array $baseUrls)
    {

        $categories = Category::query()->get();
        $linkUrls = [];

        foreach ($baseUrls as $baseUrl) {
            $page = $this->getPage($baseUrl);
            if (!$page) {
                break;
            }
            //get link list category
            $links = $this->getListBySelector($page, 'div.r_nav ul li a');
//            dd($links);
            foreach ($links as $link) {
                $slug = str_slug(trim($link->text()));

                $category = $categories->where('cate_code', $slug)->first();
                if ($category) {
                    $linkUrls[] = [
                        'link' => $this->getFullPath($link->attribute('href')),
                        'count' => CategoryFlower::with('flower')->where('category_id', $category->id)->count(),
                        'name' => $category->cate_name,
                    ];
                } else {
                    $linkUrls[] = [
                        'link' => $this->getFullPath($link->attribute('href')),
                        'count' => 0,
                        'name' => $slug,
                    ];
                }
            }
        }

        return $linkUrls;
    }

    public function crawl($index)
    {
        if ($index == null) {
            return [
                'status' => false
            ];
        }

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');


        $listCates = $this->getListCate($this->baseUrls);
        if ($index > count($listCates) - 1) {
            abort(404);
        }

        $itemLink = $listCates[$index];
        $baseUrl = ($itemLink['link']);

        $page = $this->getPage($baseUrl);
        try {
            $dom = $page->find('#ctl00_cphContent_hdfGroupId');
        } catch (\Exception $e) {
            $dom = $page->find('#ctl00_cphContent_hdfKeyword');
        }
        $cateId = $dom->attribute('value');


        if (is_numeric($cateId)) {
            $url = 'https://hoayeuthuong.com/ajax/ProGroupHandler.ashx';
        } else {
            $url = 'https://hoayeuthuong.com/ajax/ProKeywordHandler.ashx';
        }

        foreach ($this->getListBySelector($page, '.items .item .i a') as $product) {
            $data = $this->getData($product->attribute('href'));
            if (!isset($data['price'])) {
                continue;
            }
            if ($data['price'] == 0) {
                continue;
            }

            if (!$this->createFlower($data)) {
                continue;
            }
        }

        $pIndex = 1;

        do {
            $crawlData = (
            json_decode(
                $this->requestGetFlower(
                    $url,
                    '{"catId":"' . $cateId . '","pIndex":' . $pIndex++ . ',"orderQuery":"","lang":"vn"}'
                )
            )
            );

            foreach ($crawlData->dataItem as $item) {
                //Detail

                $data = ($this->getData($item->LinkItem));

                if (!isset($data['price'])) {
                    $data['price'] = 0;
                }

                if (!$this->createFlower($data)) {
                    continue;
                }
            }
        } while ($crawlData->dataItem);

        return [
            'status' => true,
            'data' => $this->getCate(str_slug($itemLink['name']), $itemLink['link'])
        ];
    }

    public function createFlower($data)
    {
        try {
            if (!$product = Flower::query()->where('slug', str_slug($data['name']))->first()) {
                $this->downloadImage($data['img_link'], $data['image']);
//                dd($data);
                $product = Flower::query()->create($data);
            }

            if (!$cate = Category::query()->where('cate_code', str_slug($data['category']))->first()) {
                $cate = Category::query()->create([
                    'cate_name' => $data['category'],
                    'cate_code' => str_slug($data['category']),
                ]);
            }

            if (!CategoryFlower::query()->where('product_id', $product->id)->where('category_id', $cate->id)->first()) {
                CategoryFlower::query()->create([
                    'product_id' => $product->id,
                    'category_id' => $cate->id,
                ]);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getCate($slug, $link)
    {
        $categories = Category::query();

        $catetogory = $categories->where('cate_code', $slug)->first();

        if ($catetogory) {
            return [
                'link' => $link,
                'count' => CategoryFlower::with('flower')->where('category_id', $catetogory->id)->count(),
                'name' => $catetogory->cate_name,
            ];
        } else {
            return [
                'link' => $link,
                'count' => 0,
                'name' => "Chưa có",
            ];
        }
    }

    public function getFullPath($url)
    {
        $baseUrl = $this->baseUrls[0];
        if (!$this->isUrl($url)) {
            $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})\//';
            $matches = [];
            if (preg_match($regex, $baseUrl, $matches)) {
                return $matches[0] . ($url[0] == '/' ? substr($url, 1) : $url);
            }
        }
        return null;
    }

    public function isUrl($string)
    {
        return filter_var($string, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
    }

    public function downloadImage(string $url, string $name)
    {
        Storage::disk('uploads')->put($name, file_get_contents($url));
    }

    public function getPage($baseURL)
    {
        try {
            $newPage = new Page();
            $newPage->visit($baseURL);
            return $newPage;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getListBySelector(Page $html, string $selector)
    {
        return $html->all($selector);
    }

    public function getData($link)
    {
        $fullPath = $this->getFullPath($link);
//        dump($fullPath);
        $content = $this->getPage($fullPath);

        $data['link'] = $fullPath;

        $regex = '/(\d+\.?)+/';
        try {
            $domNew = $content->find('.l_item .b_item .single .new span');
            if (preg_match($regex, $domNew->text(), $matches)) {
                $data['sale_price'] = str_replace('.', '', $matches[0]);
            }
        } catch (\Exception $e) {
        }
        try {
            $domOld = $content->find('.l_item .b_item .single .old');
            if (preg_match($regex, $domOld->text(), $matches)) {
                $data['price'] = str_replace('.', '', $matches[0]);
            }
        } catch (\Exception $e) {
            return [];
        }

        $data['saleoff'] = 0;
        if (isset($data['sale_price']) && isset($data['price'])) {
            if ($data['sale_price'] != 0 && $data['price'] != 0) {
                $data['saleoff'] = round(1 - ($data['sale_price'] / $data['price']), 2);
            }
        }

        try {
            $data['name'] = explode(' - ', trim($content->find('.r_item h1')->text()))[1];
            $data['category'] = explode(' - ', trim($content->find('.r_item h1')->text()))[0];
            $data['message'] = trim($content->find('.r_item .desc')->text());
            $data['slug'] = str_slug($data['name']);
            $data['quantity'] = 0;
            $data['admin_id'] = Auth::guard('admin')->id() ?? 1;
            $data['show'] = 1;
            if (!isset($data['price'])) {
                $data['price'] = 0;
            }
            $data['img_link'] = $content->find('.l_item .t_item img')->attribute('data-original');
            $imgInfo = pathinfo($data['img_link']);
            $data['image'] = time() . '_' . $imgInfo['filename'] . '.' . $imgInfo['extension'];
        } catch (\Exception $e) {
            return [];
        }

        return $data;
    }

    public function requestGetFlower($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}
