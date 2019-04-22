<?php

namespace App\Http\Controllers;

use App\AddressDelivery;
use App\Cart;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'payment', 'shipper', 'address_delivery']);
        if ($search = $request->search)
        {
            $orders->orWhere('id', $search)
                ->orWhere('user_id', $search);
        }

        if ($sort = $request->sort)
        {
            $orders->orderBy($sort, 'desc');
        }

        $page = 8;
        if ($paginate = $request->paginate)
            $page = $paginate;

        if(!Auth::guard('admin')->user()->isAdmin()) {
            $orders->where('user_id', Auth::guard('admin')->id());
        }

        $viewData = [
            'orders' => $orders->paginate($page),
            'queries' => $request->query(),
        ];

//        dd($viewData);
        return view('backend.orders.list')->with($viewData);

    }

    public function store(Request $request)
    {
        $rules = [
            'name' =>'required',
            'phone' =>'required',
            'address' =>'required',
            'billing_email' =>'required',
            'shipping_method' =>'required',
            'payment_method' =>'required',
        ];
        $this->validate($request,$rules);

        $data = $request->only([
            'name',
            'phone',
            'note',
            'address',
            'billing_email',
            'shipping_method',
            'payment_method',
        ]);

        DB::transaction(function () use($data) {
            $addressDelivery = AddressDelivery::query()->create($data);
            $order = Order::query()->create([
                'user_id' => Auth::guard('user')->id(),
                'payment_id' => $data['shipping_method'],
                'shipper_id' => $data['shipping_method'],
                'address_delivery_id' => $addressDelivery->id,
                'transaction_status' => 0,
                'total_price' => CartController::getCart()->sum(function ($item){
                    return $item->Product->price*$item->quantity;
                }),
            ]);

            foreach (CartController::getCart() as $item)
            {
                OrderProduct::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                ]);
            }

            CartController::cleartAll();
        });

        return redirect(route('home'));

    }

    public function view($id)
    {
        $order =  Order::with('user', 'payment', 'shipper', 'address_delivery', 'Products')->findOrFail($id);
//        dd($order->Products);
        $viewData = [
            'order' => $order,
            'products' => $order->products
        ];

        return view('backend.orders.view')->with($viewData);
    }
}
