<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Khanhlq\Crawler\Crawler;
use Khanhlq\Crawler\CrawlerV2;

class CrawlerController extends Controller
{
    public $crawler;
    public $crawlerV2;
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->crawler = new Crawler();
        $this->crawlerV2 = new CrawlerV2('abc');
    }

    public function index()
    {

//        dd(123123);
        $viewData = [
            'links' => $this->crawler->getListCate($this->crawler->baseUrls),
        ];

        return view('backend.products.crawler.list')->with($viewData);
    }

    public function crawl(Request $request)
    {
        $data = $this->crawler->crawl($request->index);

        if ($data['status']) {
            $data['data'] = view('backend.products.crawler.tr')->with(['link' => $data['data']])->render();
        }

        return response()->json($data);
    }

    public function testCrawl()
    {
        $this->crawlerV2->crawl();
    }

}
