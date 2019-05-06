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
use App\CategoryProduct;
use App\Flower;
use App\Product;
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
            'https://www.dienmaythienhoa.vn/'
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
            $links = $this->getListBySelector($page, '.list-main-menu .item a');
//            dd($links);
            foreach ($links as $link) {
                $slug = str_slug(trim($link->text()));

                $category = $categories->where('cate_code', $slug)->first();
                if ($category) {
                    $linkUrls[] = [
                        'link' => $this->getFullPath($link->attribute('href')),
                        'count' => CategoryProduct::with('flower')->where('category_id', $category->id)->count(),
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

        $next = null;
        do {
            if ($next) {
                $page = $this->getPage($next->attribute('href'));
            }
            foreach ($this->getListBySelector($page, '.list-product-horical li.item-product .content > a') as $product) {
                $data = $this->getData($product->attribute('href'));
                $data['category'] = $page->find('.breadcrumb .breadcrumb-item a')->text();
                if (!isset($data['price']) || $data['price'] == 0) {
                    continue;
                }

                if (!$this->createProduct($data)) {
                    continue;
                }
            }
            $next = $page->find('.page.pagination .right .text a');
        } while ($next);

        return [
            'status' => true,
            'data' => $this->getCate(str_slug($itemLink['name']), $itemLink['link'])
        ];
    }

    public function createProduct($data)
    {
        try {
            if (!$product = Product::query()->where('slug', str_slug($data['name']))->first()) {
                $this->downloadImage($data['img_link'], $data['image']);
//                dd($data);
                $product = Product::query()->create($data);
            }

            if (!$cate = Category::query()->where('cate_code', str_slug($data['category']))->first()) {
                $cate = Category::query()->create([
                    'cate_name' => $data['category'],
                    'cate_code' => str_slug($data['category']),
                ]);
            }

            if (!CategoryProduct::query()->where('product_id', $product->id)->where('category_id', $cate->id)->first()) {
                CategoryProduct::query()->create([
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
                'count' => CategoryProduct::with('flower')->where('category_id', $catetogory->id)->count(),
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
        return $url;
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
        $content = $this->getPage($fullPath);

        if (!$content) {
            return [];
        }

        $data['link'] = $fullPath;
        try {
            $domOld = $content->find('.price')->text();
            $data['price'] = str_replace('đ', '', $domOld);
            $data['price'] = str_replace(',', '', $data['price']);
        } catch (\Exception $e) {
            return [];
        }
        $data['saleoff'] = 0;
//        if (isset($data['sale_price']) && isset($data['price'])) {
//            if ($data['sale_price'] != 0 && $data['price'] != 0) {
//                $data['saleoff'] = round(1 - ($data['sale_price'] / $data['price']), 2);
//            }
//        }

        try {
            $data['name'] = $content->find('.product-detail h2.title-product')->text();
            $data['brand'] = $content->find('.product-detail a.title-brand')->text();
//            $data['category'] = explode(' - ', trim($content->find('.r_item h1')->text()))[0];
            $data['message'] = trim($content->find('.short-description .content')->text());
            $data['slug'] = str_slug($data['name']);

            $data['quantity'] = 0;
            $data['admin_id'] = Auth::guard('admin')->id() ?? 1;
            $data['show'] = 1;
            if (!isset($data['price'])) {
                $data['price'] = 0;
            }
            $data['img_link'] = $content->find('.slide-product .item img')->attribute('src');
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
