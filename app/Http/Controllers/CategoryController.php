<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Components\Recusive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;
use Whoops\Run;

class CategoryController extends Controller
{

  private $category;
  public function __construct(Category $category)
  {
    $this->category = $category;
  }
  public function create()
  {
    $htmlOption = $this->getCategory($parentId='');

    return view('admin.category.add-product-category', compact('htmlOption'));
  }

  public function add(Request $request)
  {
    $request->validate(
      [
        'name' => 'required',
      ],
      [
        'required' => ':attribute không được để trống !'
      ],
      [
        'name' => 'Tên danh mục',
      ],
    );

    Category::create(
      [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'parent_id' => $request->parent_id
      ]
    );
    return redirect()->route('categories.index')->with('status', 'Bạn đã thêm danh mục sản phẩm thành công !');
  }
  public function index(Request $request)
  {
    $status = $request->input('status');
    $list_act = [
      'delete' => 'Xóa Tạm Thời',
      'public' => 'Công Khai',
      'pending' => 'Chờ Duyệt'
    ];
    if ($status == 'active') {
      $list_act = [
        'delete' => 'Xóa Tạm Thời',
        'public' => 'Công Khai',
        'pending' => 'Chờ Duyệt'
      ];
      $list_categories = Category::where(['status' => 'Công Khai'])->paginate(5);
    } elseif ($status == 'trash') {
      $list_act = [
        'restore' => 'Khôi Phục',
        'forceDelete' => 'Xóa Vĩnh Viễn',
      ];
      $list_categories = Category::onlyTrashed()->paginate(5);
    } elseif ($status == 'pending') {
      $list_act = [
        'public' => 'Công Khai',
        'delete' => 'Xóa Tạm Thời',
        'forceDelete' => 'Xóa Vĩnh Viễn',
      ];
      $list_categories = Category::where(['status' => 'Chờ Duyệt'])->paginate(5);
    } elseif ($status == 'public') {
      $list_act = [
        'delete' => 'Xóa Tạm Thời',
        'pending' => 'Chờ Duyệt'
      ];
      $list_categories = Category::where(['status' => 'Công Khai'])->paginate(5);
    } else {
      $list_categories = Category::paginate(5);
    }
    $count_public = Category::where(['status' => 'Công Khai'])->count();
    $count_Pending = Category::where(['status' => 'Chờ Duyệt'])->count();
    $count_trash = Category::onlyTrashed()->count();
    $count = Category::count();
    return view('admin.category.index-product-category', compact(
      'list_categories',
      'count',
      'list_act',
      'count_public',
      'count_Pending',
      'count_trash'
    ))->with('i',(request()->input('page',1) -1)*5);
  }
  public function action_cat(Request $request)
  {
    $list_check = $request->input('list_check');
    if (!empty($list_check)) {
      $act = $request->input('act');
      if ($act == 'delete') {
        Category::destroy($list_check);
        return redirect()->route('categories.index')->with('status', 'Bạn đã xóa bản ghi thành công !');
      }
      if ($act == 'restore') {
        Category::withTrashed()->whereIn('id', $list_check)->restore();
        return redirect()->route('categories.index')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
      }
      if ($act == 'forceDelete') {
        Category::withTrashed()
          ->whereIn('id', $list_check)
          ->forceDelete();
        return redirect()->route('categories.index')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
      }
      if ($act == 'pending') {
        Category::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
        return redirect()->route('categories.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
      }
      if ($act == 'public') {
        Category::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
        return redirect()->route('categories.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
      }
    }
  }
  public function getCategory($parentId)
  {
    $data = $this->category->all();
    $requsive = new Recusive($data);
    $htmlOption = $requsive->categoryRecusive($parentId);
    return $htmlOption;
  }
  public function edt_cat(Request $request, $id)
  {
    $id_cat =  Category::find($id);
    $htmlOption = $this->getCategory($id_cat->parent_id);
    return view('admin.category.edit-category', compact('id_cat', 'htmlOption'));
  }
  public function update_cat(Request $request, $id)
  {
    $request->validate(
      [
        'name' => 'required'

      ],
      [
        'required' => ':attribute không được để trống !'
      ],
      [
        'name' => 'Tên danh mục',
      ],
    );
    Category::where('id', $id)->update(
      [
        'name' => $request->input('name'),
        'slug' => Str::slug($request->name),
        'user_create' => Auth::user()->name
      ]
    );
    return redirect()->route('categories.index')->with('status', 'Cập nhật danh mục sản phẩm thành công !');
  }

  public function delete_cat($id)
  {
    $id = Category::find($id);
    $id->delete();
    return redirect()->route('categories.index')->with('status', 'Bạn đã xóa danh mục sản phẩm thành công !');
  }
}
