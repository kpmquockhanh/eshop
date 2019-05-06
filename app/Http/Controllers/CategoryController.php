<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
//        $categories = Admin::where('id', '!=', Auth::guard('admin')->id());
        $categories = Category::query()
            ->orderBy('show_home', 'desc')
            ->orderBy('order', 'desc');
        if ($search = $request->search)
        {
            $categories->orWhere('name','like', '%'.$search.'%')
                ->orWhere('email','like', '%'.$search.'%');
        }

        if ($sort = $request->sort)
        {
            $categories->orderBy($sort, 'desc');
        }

        $page = 8;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'categories' => $categories->paginate($page),
            'queries' => $request->query(),
        ];
        return view('backend.categories.list')->with($viewData);
    }

    public function create()
    {
        return view('backend.categories.add');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'cate_name',
            'cate_code',
            'show_home',
            'order',
        ]);

        Category::query()->create($data);

        return redirect(route('admin.categories.list'));
    }

    public function edit($id)
    {
        if ($id)
        {
            $category = Category::query()->findOrFail($id);
            if ($category)
                return view('backend.categories.edit', compact('category'));
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if ($id = $request->id)
        {
            $category = Category::query()->findOrFail($id);
            if ($category)
            {
                $data = $request->only([
                    'cate_name',
                    'cate_code',
                    'show_home',
                    'order',
                ]);
                if (!$request->show_home) {
                    $data['show_home'] = 0;
                }
                $category->update($data);

                return redirect(route('admin.categories.list'));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if ($id = $request->id)
        {
            Category::findOrFail($id);

            if (Category::destroy($id))
            {
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
            $categorie = Admin::find($id);
            if ($categorie)
            {
                $categorie->update([
                    'status' => !$categorie->status
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
}
