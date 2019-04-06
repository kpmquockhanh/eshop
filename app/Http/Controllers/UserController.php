<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $viewData = [
        ];
        $carts = $this->getCart();
        if (Auth::check())
            $viewData = array_merge($viewData, [
                'carts'=> $carts,
                'subtotal' => $carts->sum(function ($item){
                    return $item->Product->price*$item->quantity;
                })]);
        return view('frontend.account.index')->with($viewData);
    }

    public function showAddr()
    {
        $viewData = [
        ];
        $carts = $this->getCart();
        if (Auth::check())
            $viewData = array_merge($viewData, [
                'carts'=> $carts,
                'subtotal' => $carts->sum(function ($item){
                    return $item->Product->price*$item->quantity;
                })]);
        return view('frontend.account.addresses')->with($viewData);

    }
    public function showDetail()
    {
        $viewData = [];
        $carts = $this->getCart();
        if (Auth::check())
            $viewData = array_merge($viewData, [
                'carts'=> $carts,
                'subtotal' => $carts->sum(function ($item){
                    return $item->Product->price*$item->quantity;
                })]);
        return view('frontend.account.detail')->with($viewData);
    }

    public function changeInfo(Request $request)
    {
        $data = $request->only([
            'name',
        ]);

        Auth::user()->update($data);
        Auth::user()->save();

        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $data = $request->only([
            'password',
        ]);

        Auth::user()->update($data);
        Auth::user()->save();

        return redirect()->back();
    }

    public function getCart()
    {
        return (Auth::guard('user')->check())?
            Cart::query()->with('Product')->where('user_id', Auth::guard('user')->id())->get() : null;
    }

    public function changeAddr(Request $request)
    {
        if ($request->address)
        {
            $user = User::find(Auth::guard('user')->user()->id);
            $user->address = $request->address;
            if ($user->save())
                return redirect(route('user.addresses'));
            return redirect(route('user.addresses'))->withErrors('Error');
        }

        return redirect(route('user.addresses'))->withErrors('Please enter your address.');
    }
    public function changeDetail(Request $request)
    {
        $rules = [
          'name' => 'required',
//          'old_password' => 'required',
          'password' => 'confirmed',
        ];

        $this->validate($request, $rules);

        $data = $request->only([
            'name',
            'old_password',
            'password',
        ]);

        $user = User::find(Auth::guard('user')->user()->id);


        if ($data['name'])
        {
            $user->name = $data['name'];
        }

        if (Hash::check($data['old_password'], Auth::guard('user')->user()->password))
        {
            $user->password = Hash::make($request->password);
        }

        if ($user->save())
            return redirect(route('user.detail'));
        return redirect(route('user.detail'))->withErrors('Error');
    }
}
