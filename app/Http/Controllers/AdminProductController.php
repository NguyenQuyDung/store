<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{
    //
    private $productImage;
    private $category;
    private $tag;
    private $product;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
    }
    public function index(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa Tạm Thời',
            'public' => 'Còn Hàng',
            'pending' => 'Hết Hàng'
        ];
        if ($status == 'active') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
                'public' => 'Còn Hàng',
                'pending' => 'Hết Hàng'
            ];
            $list_products = Product::where(['statusactive' => 'Còn Hàng'])->orderBy('id', 'DESC')->paginate(5);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_products = Product::onlyTrashed()->orderBy('id', 'DESC')->paginate(5);
        } elseif ($status == 'pending') {
            $list_act = [
                'public' => 'Còn Hàng',
                'delete' => 'Xóa Tạm Thời',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_products = Product::where(['statusactive' => 'Hết Hàng'])->orderBy('id', 'DESC')->paginate(5);
        } elseif ($status == 'public') {
            $list_act = [
                'public' => 'Còn Hàng',
                'pending' => 'Hết Hàng'
            ];
            $list_products = Product::where(['statusactive' => 'Còn Hàng'])->orderBy('id', 'DESC')->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $list_products = Product::where('name', 'LIKE', "%{$keyword}%")->orderBy('id', 'DESC')->paginate(4);
        }
        $count_public = Product::where(['statusactive' => 'Còn Hàng'])->count();
        $count_Pending = Product::where(['statusactive' => 'Hết Hàng'])->count();
        $count_trash = Product::onlyTrashed()->count();
        $count = Product::count();
        return view('admin.products.index', compact('list_products', 'list_act', 'count_public', 'count_Pending', 'count_trash', 'count'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function action_product(Request $request)
    {
        $list_check = $request->input('list_check');
        if (!empty($list_check)) {
            $act = $request->input('act');
            if ($act == 'delete') {
                Product::destroy($list_check);
                return redirect()->route('products.index')->with('status', 'Bạn đã xóa bản ghi thành công !');
            }
            if ($act == 'restore') {
                Product::withTrashed()->whereIn('id', $list_check)->restore();
                return redirect()->route('products.index')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
            }
            if ($act == 'forceDelete') {
                Product::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('products.index')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
            }
            if ($act == 'pending') {
                Product::whereIn('id', $list_check)->update(['statusactive' => 'Hết Hàng']);
                return redirect()->route('products.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
            if ($act == 'public') {
                Product::whereIn('id', $list_check)->update(['statusactive' => 'Còn Hàng']);
                return redirect()->route('products.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
        }
    }
    public function add()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.products.add', compact('htmlOption'));
    }
    public function getCategory($parentId)
    {
        $data = $this->category->all();
        $requsive = new Recusive($data);
        $htmlOption = $requsive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function add_new(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'price_old' => 'required',
                'image_product_path' => 'required',
                'intro' => 'required',
                'detail' => 'required',
                'image_path' => 'required',
                'parent_id' => 'required',
                'tag_name' => 'required'
            ],
            [
                'required' => ' :attribute không được để trống !'
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá sản phẩm',
                'price_old' => 'Giá cũ sản phẩm',
                'image_product_path' => 'Ảnh sản phẩm',
                'intro' => 'Mô tả sản phẩm',
                'detail' => 'Nội dung chi tiết sản phẩm',
                'image_path' => 'Ảnh chi tiết sản phẩm',
                'parent_id' => 'Danh mục sản phẩm',
                'tag_name' => 'Tên tag'
            ]
        );
        if ($request->hasFile('image_product_path')) {
            $images_product = $request->image_product_path;
            $name = $images_product->getClientOriginalName();
            $images_product = $images_product->move('public/template-website/upload', $name);
        }
        $user_create = Auth::user()->name;
        $dataProductCreate = [
            'user_create' => $user_create,
            'name' => $request->name,
            'price' => $request->price,
            'price_old' => $request->price_old,
            'fature_image_path' => $images_product,
            'content' => $request->intro,
            'content_detail' => $request->detail,
            'user_id' => Auth::user()->id,
            'category_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
            'status' => 'Còn Hàng'
        ];
        $product = $this->product->create($dataProductCreate);
        $files = array();
        if ($request->hasFile('image_path')) {
            foreach ($request->image_path as $file) {
                $name = md5(rand(10, 100));
                $text = strtolower($file->getClientOriginalExtension());
                $image_full_name = $name . '.' . $text;
                $upload_path = 'public/template-website/upload/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                $files[] = $image_url;
            }
        }
        foreach ($files as $fi) {
            ProductImage::create([
                'image_path' => $fi,
                'product_id' => $product->id
            ]);
        }
        foreach ($request->tag_name as $tagItem) {
            $tagInstance = Tag::firstOrCreate(['name' => $tagItem]);
            $tagIds[] = $tagInstance->id;
        }
        $product->Tags()->attach($tagIds);
        return redirect()->route('products.index')->with('status', 'Bạn đã thêm sản phẩm thành công !');
    }
    public function edit(Request $request, $id)
    {
        $find_id = Product::find($id);
        $htmlOption = $this->getCategory($find_id->category_id);
        return view('admin.products.edit', compact('find_id', 'htmlOption'));
    }
    public function delete($id)
    {
        $find_id = Product::find($id);
        $find_id->delete();
        return redirect()->route('products.index')->with('stauts', 'Bạn đã xóa bản ghi thành công !');
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'price_old' => 'required',
                'image_product_path' => 'required',
                'intro' => 'required',
                'detail' => 'required',
                'image_path' => 'required',
                'parent_id' => 'required',
                'tag_name' => 'required'
            ],
            [
                'required' => ' :attribute không được để trống !'
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá sản phẩm',
                'price_old' => 'Giá cũ sản phẩm',
                'image_product_path' => 'Ảnh sản phẩm',
                'intro' => 'Mô tả sản phẩm',
                'detail' => 'Nội dung chi tiết sản phẩm',
                'image_path' => 'Ảnh chi tiết sản phẩm',
                'parent_id' => 'Danh mục sản phẩm',
                'tag_name' => 'Tên tag'
            ]
        );
        if ($request->hasFile('image_product_path')) {
            $images_product = $request->image_product_path;
            $name = $images_product->getClientOriginalName();
            $images_product = $images_product->move('public/template-website/upload', $name);
        }
        $user_create = Auth::user()->name;
        $dataProductUpdate = [
            'user_create' => $user_create,
            'name' => $request->name,
            'price' => $request->price,
            'price_old' => $request->price_old,
            'fature_image_path' => $images_product,
            'content' => $request->intro,
            'content_detail' => $request->detail,
            'user_id' => Auth::user()->id,
            'category_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
            'status' => 'Còn Hàng'
        ];
        $this->product->find($id)->update($dataProductUpdate);
        $product = $this->product->find($id);
        $files = array();
        if ($request->hasFile('image_path')) {
            foreach ($request->image_path as $file) {
                $name = md5(rand(10, 100));
                $text = strtolower($file->getClientOriginalExtension());
                $image_full_name = $name . '.' . $text;
                $upload_path = 'public/template-website/upload/';
                $image_url = $upload_path . $image_full_name;
                $file->move($upload_path, $image_full_name);
                $files[] = $image_url;
            }
        }
        $this->productImage->where('product_id', $id)->forceDelete();
        foreach ($files as $img_path) {
            $product->ProductImage()->create([
                'image_path' => $img_path,
                'product_id' => $product
            ]);
        }
        foreach ($request->tag_name as $tagItem) {
            $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
            $tagIds[] = $tagInstance->id;
        }
        $product->Tags()->sync($tagIds);
        return redirect()->route('products.index')->with('status', 'Bạn đã cập nhật sản phẩm thành công !');
    }
}
