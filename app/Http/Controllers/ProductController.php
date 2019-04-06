<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProduct;
use App\Product;
use App\Http\Requests\ProductEditRequest;
use App\Http\Requests\ProductRequest;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use function Tinify\fromFile;
use function Tinify\setKey;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $products = Product::with('admin');

        if (Auth::guard('admin')->user()->type != 3 )
            $products->where('admin_id', Auth::guard('admin')->id());

        if ($search = $request->search)
        {
            $products->Where('name','like', '%'.$search.'%')
                    ->orWhere('message','like', '%'.$search.'%');
        }

        if ($sort = $request->sort)
        {
            $products->orderBy($sort, 'desc');
        }

        $page = 12;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'products' => $products->paginate($page),
            'queries' => $request->query(),
        ];

        if ($request->list_type == 'table') {
            Session::put('list_type', 'table');
        }elseif ($request->list_type == 'grid') {
            Session::put('list_type', 'grid');
        }

        if (Session::get('list_type') == 'table') {
            return view('backend.products.list-table')->with($viewData);
        }
        return view('backend.products.list')->with($viewData);
    }

    public function create()
    {
        if (!Auth::guard('admin')->user()->status)
            return redirect(route('admin.products.list'));

        $viewData = [
            'categories' => Category::all(),
        ];

        return view('backend.products.add')->with($viewData);
    }

    public function store(ProductRequest $request)
    {

        if (!Auth::guard('admin')->user()->status)
            return redirect(route('admin.products.list'));

        $data = $this->getDataForStore($request);

        $product_inserted = Product::create(array_merge($data));

        if ($request->categories) {
            $this->insertCategoryProduct($request->categories, $product_inserted);
        }

        return redirect(route('admin.products.list'));
    }


    public function edit($id)
    {
        if ($id)
        {
            $product = Product::with('categories')->find($id);

            if (!$product->canChange())
            {
                return redirect(route('admin.products.list'))->withErrors(['noPermission' => 'Bạn không có quyền thay đổi']);
            }
            $viewData = [
                'categories' => Category::all(),
                'product' => $product,
                'listIdCate' => $product->categories->pluck('category_id')->all(),
            ];

            if ($product)
                return view('backend.products.edit')->with($viewData);
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function update(ProductEditRequest $request)
    {

        if ($id = $request->id)
        {
            $product = Product::find($id);

            if (!$product->canChange())
            {
                return redirect(route('admin.products.list'))->withErrors(['noPermission' => 'Bạn không có quyền thay đổi']);
            }

            if ($product)
            {
                $data = $request->only([
                    'name',
                    'show',
                    'message',
                    'saleoff',
                    'price',
                    'quantity',
                    'image',
                ]);
                if (isset($data['show']))
                    $data['show'] = $data['show']==='on'? true : false;
                else
                    $data['show'] = false;

                if ($image = $request->image)
                {
                   \Illuminate\Support\Facades\File::delete(public_path('images').'\\'.$product->image);
                    $data['image'] = $this->processImage($image);
                }

                //Update category of Product
                $requestCate = $request->categories;
                $currentCate = array_column($product->categories->toArray(),'category_id');

                $deleteCate = array_diff($currentCate, $requestCate);
                $addCates = array_diff($requestCate, $currentCate);
                foreach ($addCates as  $addCate) {
                    CategoryProduct::query()->create([
                        'product_id' => $id,
                        'category_id' => $addCate,
                    ]);
                }

                CategoryProduct::query()->where('product_id', $id)
                    ->whereIn('category_id',$deleteCate)->delete();

                $product->update($data);

                return redirect(route('admin.products.edit', ['id' => $id]));
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        if ($id = $request->id)
        {
            \Illuminate\Support\Facades\File::delete(public_path('images').'\\'.Product::findOrFail($id)->image);
            if (Product::destroy($id))
                return response()->json([
                'status' => true,
            ]);
            return response()->json([
                'status' => false,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }

    public function changeShowStatus(Request $request)
    {

        if ($id = $request->id)
        {
            $product = Product::find($id);

            if (!$product->canChange())
            {
                return response()->json([
                    'status' => false,
                ]);
            }

            if ($product)
            {
                $product->update([
                    'show' => !$product->show
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

    private function processImage($image)
    {
        ini_set('memory_limit','256M');
        $name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)
            ->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->insert('img/watermark.png','top-right', 20,20)
            ->save(public_path('images').'/'.$name);

//        setKey("Zt8Tpdw4FvTBz2NVD505HQnzqXY6Fjyc");
//        fromFile(public_path('images').'/'.$name)->toFile(public_path('images').'/'.$name);
//            $image->move(public_path('images'), $name);
        return $name;
    }

    public function insertCategoryProduct($categories, $productId)
    {
        foreach ($categories as $category)
        {
            CategoryProduct::create([
                'product_id' => $productId->id,
                'category_id' => $category,
            ]);
        }
    }

    public function getDataForStore(Request $request)
    {
        $data = $request->only([
            'name',
            'show',
            'message',
            'saleoff',
            'price',
            'quantity',
        ]);

        $data['admin_id'] = Auth::guard('admin')->user()->id;

        if (isset($data['show']))
            $data['show'] = $data['show']==='on'? true : false;

        if ($image = $request->image)
        {
            $data['image'] = $this->processImage($image);
        }

        return $data;
    }

    public function listImages(Request $request)
    {
        $images = Product::query()->where('admin_id', Auth::guard('admin')->id())->select('image','id');

        $page = 12;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'images' => $images->paginate($page),
        ];
        return view('backend.products.images.list')->with($viewData);
    }

    public function compressImage(Request $request)
    {
        if ($id = $request->id)
        {
            $product = Product::query()->findOrFail($id);

            $this->cropAndWaterMarkImage('images/'.$product->image);

            $this->optimizeImage('images/'.$product->image);

//            setKey("Zt8Tpdw4FvTBz2NVD505HQnzqXY6Fjyc");
//            fromFile(public_path('images').'/'.$product->image)->toFile(public_path('images').'/'.$product->image);
//            $image->move(public_path('images'), $product->image);

            return response()->json([
                'status' => true,
                'data' => view('backend.products.images.tr')->with(['image'=> $product])->render(),
            ]);
        }
        return response()->json([
            'status' => false,
        ]);

    }

    public function compressAllImages()
    {
        $images = Product::query()->where('admin_id', Auth::guard('admin')->id())->select('image','id')->get();

        foreach ($images as $image)
        {
            $this->cropAndWaterMarkImage('images/'.$image->image);
            $this->optimizeImage('images/'.$image->image);
        }

        return response()->json([
            'status' => true,
        ]);
    }

    public function cropAndWaterMarkImage(string $image)
    {
        Image::make($image)
            ->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->insert('img/watermark.png','top-right', 20,20)
            ->save($image);
    }

    public function optimizeImage($image_file)
    {
        $img = imagecreatefromjpeg($image_file);

        imagejpeg($img,$image_file,50);

    }


}
