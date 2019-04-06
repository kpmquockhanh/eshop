<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Product;
use App\saler;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SalerController extends Controller
{
    public function index(Request $request)
    {
//        $salers = Admin::where('id', '!=', Auth::guard('admin')->id());
        $salers = Admin::query();
        if ($search = $request->search)
        {
            $salers->orWhere('name','like', '%'.$search.'%')
                ->orWhere('email','like', '%'.$search.'%');
        }

        if ($sort = $request->sort)
        {
            $salers->orderBy($sort, 'desc');
        }

        $page = 8;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'salers' => $salers->paginate($page),
            'queries' => $request->query(),
        ];
//        dd($viewData['salers']);
        return view('backend.salers.list')->with($viewData);
    }

//    public function create()
//    {
//        return view('backend.salers.add');
//    }
//
//    public function store(salerRequest $request)
//    {
//        $data = $request->only([
//            'name',
//            'location',
//            'status',
//            'type',
//        ]);
//
//        if ($image = $request->image)
//        {
//            $name = time().'.'.$image->getClientOriginalExtension();;
//            $image->move(public_path('images/avatars'), $name);
//            $data['image'] = $name;
//        }
//
//
//        saler::insert(array_merge($data, [
//            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
//            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
//        ]));
//
//        return redirect(route('admin.salers.list'));
//    }

    public function edit($id)
    {
        if ($id)
        {
            $saler = Admin::findOrFail($id);
            if ($saler)
                return view('backend.salers.edit', compact('saler'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {

        $rules = [
            'name' => 'required',
            'location' => 'required',
            'status' => 'required',
            'password' => 'nullable|confirmed|min:6'
        ];

        $this->validate($request, $rules);

        if ($id = $request->id)
        {
            $saler = Admin::find($id);
            if ($saler)
            {
                $data = $request->only([
                    'name',
                    'location',
                    'status',
                    'type',
                ]);

                if (isset($data['type']))
                    if ($data['type'] == 3)
                        if (Auth::guard('admin')->user()->type !=3)
                            $data['type'] = $saler->type;

                if($password = $request->password)
                {
                    if (Auth::guard('admin')->id() == $saler->id)
                        $saler->password = Hash::make($password);
                }

                if ($image = $request->image)
                {
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('images/avatars'), $name);

                    if ($saler->image)
                        Storage::disk('avatars')->delete($saler->image);

                    $data['avatar'] = $name;
                }

                $saler->update(array_merge($data));
                return redirect(route('admin.salers.list'));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if ($id = $request->id)
        {
            $admin = Admin::findOrFail($id);

            if (Admin::destroy($id))
            {
                Product::where('admin_id', $id)->delete();
                return response()->json([
                    'status' => true,
                ]);
            }
        }
        return response()->json([
            'status' => false,
        ]);
    }

    public function changeStatus(Request $request)
    {
        if ($id = $request->id)
        {
            $saler = Admin::find($id);
            if ($saler)
            {
                $saler->update([
                    'status' => !$saler->status
                ]);

                return response()->json([
                    'status' => true,
                ]);
            }
            return response()->json([
                'status' => false,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }

    public function showListUser(Request $request)
    {
        $users = User::query()->paginate(10);
        $queries = $request->query();
        return view('backend.users.list', compact('users', 'queries'));
    }

    public function view($id)
    {
        if ($id)
        {
            $saler = Admin::findOrFail($id);
            if ($saler) {
                return view('backend.salers.view', compact('saler'));
            }
        }
        return redirect()->back();
    }
}
