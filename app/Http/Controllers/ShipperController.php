<?php

namespace App\Http\Controllers;

use App\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipperController extends Controller
{
    public function index(Request $request)
    {
//        dd(123);
        $shippers = Shipper::query();
        if ($search = $request->search)
        {
            $shippers->orWhere('id', $search)
                ->orWhere('user_id', $search);
        }

        if ($sort = $request->sort)
        {
            $shippers->orderBy($sort, 'desc');
        }

        $page = 8;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'shippers' => $shippers->paginate($page),
            'queries' => $request->query(),
        ];
        return view('backend.shippers.list')->with($viewData);
    }

    public function create()
    {
        return view('backend.shippers.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'shipper_name' => 'required',
            'shipper_phone' => 'required|numeric',
        ];

        $message = [
            'shipper_phone.numeric' => "Số điện thoại phải là số"
        ];

        $this->validate($request, $rules, $message);

        $data = $request->only([
            'shipper_name',
            'shipper_phone',
        ]);


        $data['admin_id'] = Auth::guard('admin')->user()->id;

        if ($image = $request->image)
        {
            $name = time().'.'.$image->getClientOriginalExtension();;
            $image->move(public_path('images/shippers'), $name);
            $data['image'] = $name;
        }


        Shipper::create($data);

        return redirect(route('admin.shippers.list'));
    }

    public function edit($id)
    {
        if ($id)
        {
            $shipper = Shipper::findOrFail($id);
            if ($shipper)
                return view('backend.shippers.edit', compact('shipper'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($id = $request->id)
        {
            $shipper = Shipper::find($id);
            if ($shipper)
            {
                $data = $request->only([
                    'shipper_name',
                    'shipper_status_code',
                    'shipper_phone',
                    'shipper_image',
                ]);

                if ($image = $request->image)
                {
                    $name = time().'.'.$image->getClientOriginalExtension();;
                    $image->move(public_path('images/avatars'), $name);
                    $data['image'] = $name;
                }

                $shipper->update(array_merge($data, [
                    'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
                ]));
                return redirect(route('admin.shippers.list'));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
}
