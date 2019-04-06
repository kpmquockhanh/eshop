<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
//        dd(123);
        $payments = Payment::query();
        if ($search = $request->search)
        {
            $payments->orWhere('id', $search)
                ->orWhere('user_id', $search);
        }

        if ($sort = $request->sort)
        {
            $payments->orderBy($sort, 'desc');
        }

        $page = 8;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'payments' => $payments->paginate($page),
            'queries' => $request->query(),
        ];
        return view('backend.payments.list')->with($viewData);
    }

    public function create()
    {
        return view('backend.payments.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'payment_type' => 'required',
        ];

        $message = [
        ];

        $this->validate($request, $rules, $message);

        $data = $request->only([
            'payment_type',
        ]);

        Payment::query()->create($data);

        return redirect(route('admin.payments.list'));
    }

    public function edit($id)
    {
        if ($id)
        {
            $payment = Payment::findOrFail($id);
            if ($payment)
                return view('backend.payments.edit', compact('payment'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($id = $request->id)
        {
            $payment = Payment::findOrFail($id);
            if ($payment)
            {
                $data = $request->only([
                    'payment_type',
                    'payment_allowed',
                ]);


                $payment->update(array_merge($data, [
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                ]));
                return redirect(route('admin.payments.list'));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
}
