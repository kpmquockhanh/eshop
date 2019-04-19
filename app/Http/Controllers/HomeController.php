<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\CategoryProduct;
use App\Product;
use App\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viewData = [
            'products' => Product::query()->paginate(10),
            'carts' => Cart::getCart()
        ];

        return view('frontend.welcome')->with($viewData);
    }

    public function viewShop(Request $request)
    {
        $products = Product::query()->where('show',true);

        if ($cate_id = $request->cate)
        {
            $Cate = CategoryProduct::query()->where('category_id', $cate_id)->get(['product_id']);

            $idsProduct = [];
            foreach($Cate->toArray() as $i) {
                $idsProduct[] = $i['product_id'];
            }

            $products->whereIn('id', $idsProduct);
        }
        if ($price = $request->price)
            $products->where('price','>', $price);

        if ($request->s)
        {
            $products->where('name','like', '%'.$request->s.'%')
                    ->orWhere('message', 'like', '%'.$request->s.'%');
        }
        $products = $products->orderByDesc('id')->paginate(12);

        $toItem = $products->perPage() == $products->count() ?
            $products->currentPage() * $products->perPage():
            $products->count()?($products->currentPage()-1)*$products->perPage()+$products->count():0;
        $viewData = [
            'products' => $products,
            'toItem' => $toItem,
            'fromItem' => $toItem?$toItem-$products->count()+1:0,
            'queries' => $request->query(),
            'categories' => Category::with('products')->get(),
            'hotProducts' => Product::query()->orderByDesc('views')->take(3)->get(),
        ];
        if (Auth::check())
            $viewData = array_merge($viewData, ['carts'=> Cart::query()->with('Product')->where('user_id', Auth::guard('user')->id())->get()]);


        return view('frontend.shop')->with($viewData);
    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }

    public function detailProduct(Request $request)
    {
        if ($id = $request->id)
        {
            $product = Product::with('categories')->findOrFail($id);
            $id_related = (array_column($product->categories->toArray(), 'category_id'));
            $viewData = [
                'Product' => Product::query()->findOrFail($request->id),
                'relatedProducts' => Product::whereHas('categories', function ($q) use($id_related, $product){
                    $q->whereIn('category_id', $id_related);
                })->where('id', '<>', $id)->take(5)->get(),
            ];
            if (Auth::check())
                $viewData = array_merge($viewData, [
                    'carts'=> Cart::query()->with('Product')->where('user_id', Auth::guard('user')->id())->get(),

                ]);

            $product->increment('views');
            return view('frontend.detail')->with($viewData);
        }
        return redirect()->back();
    }

    public function viewQuick(Request $request)
    {
        if (!$request->id)
            return redirect()->back();

        $product = Product::find($request->id);

        if ($product){
            $product->increment('views');
            return response()->json([
                'status' => true,
                'data' => view('frontend.layouts.quick-view')->with(['Product' => $product])->render(),
            ]);
        }
        else
            return response()->json([
                'status' => false,
            ]);

    }
    public function addSub(Request $request)
    {
        $this->validate($request, ['email' => 'required']);

        try
        {
            Subscribe::query()->create($request->all());
        }catch(\Exception $e)
        {
            return redirect(route('home'));
        }

        return redirect(route('home'));
    }
}
