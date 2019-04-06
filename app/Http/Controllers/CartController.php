<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use App\Payment;
use App\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $viewData = [];
        $carts = $this->getCart();
        if (Auth::check())
            $viewData = array_merge($viewData, [
                'carts'=> $carts,
                'subtotal' => $carts->sum(function ($item){
                    return $item->Product->price*$item->quantity;
                })]);
        return view('frontend.cart.cart-page')->with($viewData);
    }
    public function test()
    {
        $userId = Auth::guard('user')->id();

    }

    public static function getCart()
    {
        return Cart::query()->with('Product')->where('user_id', Auth::guard('user')->id())->get();
    }


    public function addToCart(Request $request)
    {
        if ($id = $request->id)
        {
            if (!Product::find($id))
                return response()->json([
                    'status' => false,
                ]);


            $cart = Cart::query()
                ->where('user_id', Auth::guard('user')->id())
                ->where('product_id', $id)
                ->get();

            if ($cart->count())
                $cart->first()->increment('quantity');
            else
            {
                Cart::create([
                    'user_id' => Auth::guard('user')->id(),
                    'product_id' => $id,
                    'quantity' => $request->quantity?:1,
                ]);
            }

            return response()->json([
                'status' => true,
                'data' => view('frontend.cart.cart')->with(['carts' => $this->getCart()])->render(),
            ]);
        }else
            return response()->json([
                'status' => false,
            ]);

    }

    public function removeFromCart(Request $request)
    {
        if ($id = $request->id)
        {
            if (Cart::destroy($id))
                return response()->json([
                    'status' => true,
                    'data' => view('frontend.cart.cart')->with(['carts' => $this->getCart()])->render(),
                ]);
            else
                return response()->json([
                    'status' => true,
                ]);

        }else
            return response()->json([
                'status' => false,
            ]);
    }

    public static function cleartAll()
    {
        return Cart::query()->where('user_id', Auth::guard('user')->id())->delete();
    }

    public function clearAllCart()
    {
        if (Cart::query()->where('user_id', Auth::guard('user')->id())->delete())
        {
            return response()->json([
                'status' => true,
                'data' => view('frontend.cart.cart')->with(['carts' => $this->getCart()])->render(),
                'data_page' => view('frontend.cart.cart-page-ajax')->with(['carts' => $this->getCart()])->render(),
            ]);
        }
        else
            return response()->json([
                'status' => false,
            ]);
    }

    public function checkoutCart()
    {
        $viewData = [
        ];
        $carts = $this->getCart();
        if (Auth::check())
            $viewData = array_merge($viewData, [
                'carts'=> $carts,
                'shippers'=> Shipper::getActiveShippers(),
                'payments'=> Payment::getActivePayments(),
                'subtotal' => $carts->sum(function ($item){
                    return $item->Product->sale_price*$item->quantity;
                })]);
        return view('frontend.checkout.checkout')->with($viewData);
    }

    public function checkOrder()
    {
        $viewData = [
        ];
        $carts = $this->getCart();
        if (Auth::check())
            $viewData = array_merge($viewData, [
                'carts'=> $carts,
                ]);
        return view('frontend.checkout.track-order')->with($viewData);
    }

    public function updateCart(Request $request)
    {
        foreach($request->ids as $key => $id)
        {
            Cart::query()->where('id', $id)->update(['quantity' => $request->quantities[$key]]);
        }
        return redirect()->back();
    }
}