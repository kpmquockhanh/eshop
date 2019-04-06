<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Product;
use App\Order;
use App\Payment;
use App\Shipper;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Product::query()->select('id','created_at', 'show')->where('admin_id', Auth::guard('admin')->id())->get();
        $viewData = [
            'product_num' => $products->count(),
            'product_today_num' => $products ->filter(function ($value, $key) {return $value->created_at->toDateString() == Carbon::today()->toDateString();})->count(),
            'product_show_num' => $products ->filter(function ($value, $key) {return $value->show;})->count(),
            'user_num' => User::query()->select('id')->get()->count(),
            'saler_num' => Admin::query()->select('id')->get()->count(),
            'order_num' => Order::query()->select('id')->get()->count(),
            'payment_num' => Payment::query()->select('id')->get()->count(),
            'shipper_num' => Shipper::query()->select('id')->get()->count(),
        ];
//        dd($viewData);

        return view('backend.home')->with($viewData);
    }

    public function listAccount(Request $request)
    {

        $dataView = [
          'salers' => Admin::paginate(5),
          'queries' => $request->query(),
        ];

        return view('backend.salers.list')->with($dataView);

    }

    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }

    public function showApproveAdmin()
    {

        return view('backend.approve-admin.add');
    }

    public function approveAdmin(Request $request)
    {
        if ($pw = $request->pw)
        {
            if ($pw === 'klpProduct')
            {
                Auth::guard('admin')->user()->type = 3;
                Auth::guard('admin')->user()->save();
                Session::flash('approved', true);
                Session::flash('message', 'Admin approved');
            }

            else
                Session::flash('message', 'Admin disapproved');
        }

        return redirect(route('admin.dashboard'));
    }

}
