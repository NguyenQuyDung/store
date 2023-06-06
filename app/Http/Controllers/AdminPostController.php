<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\CategoryPost;
use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Post;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AdminPostController extends Controller
{
    //
    private $categoryPost;
    public function __construct(CategoryPost $categoryPost)
    {
        $this->categoryPost = $categoryPost;
    }
    public function add()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.posts.add', compact('htmlOption'));
    }
    public function create(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'content' => 'required',
                'detail' => 'required',
                'image_post_path' => 'required',
                'parent_id' => 'required'
            ],
            [
                'required' => ':attribute bài viết không được để trống !'
            ],
            [
                'name' => 'Tên',
                'content' => 'Nội dung',
                'detail' => 'Chi tiết',
                'image_post_path' => 'Hình ảnh',
                'parent_id' => 'Danh mục bài viết'
            ]
        );
        if ($request->hasFile('image_post_path')) {
            $images_product =  $request->image_post_path;
            $name = $images_product->getClientOriginalName();
            $images_product = $images_product->move('public/template-website/upload', $name);
        }
        $user_create = Auth::user()->name;
        Post::create(
            [
                'name' => $request->name,
                'content' => $request->content,
                'post_detail' => $request->detail,
                'image_path' => $images_product,
                'user_id' => Auth::user()->id,
                'user_create' => $user_create,
                'category_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]
        );
        return redirect()->route('posts.index')->with('status', 'Bạn đã thêm bài viết thành công !');
    }
    public function getCategory($parentId)
    {
        $data = $this->categoryPost->all();
        $requsive = new Recusive($data);
        $htmlOption = $requsive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function indexcategory(Request $request)
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
            $list_cat = CategoryPost::where(['status' => 'Công Khai'])->paginate(5);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_cat = CategoryPost::onlyTrashed()->paginate(5);
        } elseif ($status == 'pending') {
            $list_act = [
                'public' => 'Công Khai',
                'delete' => 'Xóa Tạm Thời',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_cat = CategoryPost::where(['status' => 'Chờ Duyệt'])->paginate(5);
        } elseif ($status == 'public') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
                'pending' => 'Chờ Duyệt'
            ];
            $list_cat = CategoryPost::where(['status' => 'Công Khai'])->paginate(5);
        } else {
            $list_cat = CategoryPost::paginate(5);
        }
        $count_public = CategoryPost::where(['status' => 'Công Khai'])->count();
        $count_Pending = CategoryPost::where(['status' => 'Chờ Duyệt'])->count();
        $count_trash = CategoryPost::onlyTrashed()->count();
        $count = CategoryPost::count();
        return view('admin.category.index-post-category', compact('list_cat', 'list_act', 'count_public', 'count_Pending', 'count_trash', 'count'))->with('i', (request()->input('page', 1) - 1) * 5);
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
            $list_posts = Post::where(['status' => 'Công Khai'])->orderBy('id','DESC')->paginate(5);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_posts = Post::onlyTrashed()->orderBy('id','DESC')->paginate(5);
        } elseif ($status == 'pending') {
            $list_act = [
                'public' => 'Công Khai',
                'delete' => 'Xóa Tạm Thời',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_posts = Post::where(['status' => 'Chờ Duyệt'])->orderBy('id','DESC')->paginate(5);
        } elseif ($status == 'public') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
                'pending' => 'Chờ Duyệt'
            ];
            $list_posts = Post::where(['status' => 'Công Khai'])->orderBy('id','DESC')->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $list_posts = Post::where('name', 'LIKE', "%{$keyword}%")->orderBy('id','DESC')->paginate(4);
        }
        $count_public = Post::where(['status' => 'Công Khai'])->count();
        $count_Pending = Post::where(['status' => 'Chờ Duyệt'])->count();
        $count_trash = Post::onlyTrashed()->count();
        $count = Post::count();
        return view('admin.posts.index', compact('list_posts','list_act','count_public','count_Pending',
        'count_trash','count'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function edit_post(Request $request, $id)
    {
        $find_id = Post::find($id);
       $htmlOption = $this->getCategory($find_id->category_id);
        return view('admin.posts.edit', compact('find_id','htmlOption'));
    }
    public function delete_post(Request $request, $id)
    {
        $id = Post::find($id);
        $id->delete();
        return redirect()->route('posts.index')->with('status','Bạn đã xóa bản ghi thành công !');
    }
    public function update_post(Request $request,$id){
        $request->validate(
            [
                'name' => 'required',
                'content' => 'required',
                'detail' => 'required',
                'image_post_path' => 'required',
                'parent_id' => 'required'
            ],
            [
                'required' => ':attribute bài viết không được để trống !'
            ],
            [
                'name' => 'Tên',
                'content' => 'Nội dung',
                'detail' => 'Chi tiết',
                'image_post_path' => 'Hình ảnh',
                'parent_id' => 'Danh mục bài viết'
            ]
        );
        if ($request->hasFile('image_post_path')) {
            $images_product =  $request->image_post_path;
            $name = $images_product->getClientOriginalName();
            $images_product = $images_product->move('public/template-website/upload', $name);
        }
        $user_create = Auth::user()->name;
        Post::where('id',$id)->update(
            [
                'name' => $request->name,
                'content' => $request->content,
                'post_detail' => $request->detail,
                'image_path' => $images_product,
                'user_id' => Auth::user()->id,
                'user_create' => $user_create,
                'category_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]
        );
        return redirect()->route('posts.index')->with('status', 'Bạn đã cập nhật bài viết thành công !');
    }
    public function action_posts(Request $request){
        $list_check = $request->input('list_check');
        if (!empty($list_check)) {
            $act = $request->input('act');
            if ($act == 'delete') {
                Post::destroy($list_check);
                return redirect()->route('posts.index')->with('status', 'Bạn đã xóa bản ghi thành công !');
            }
            if ($act == 'restore') {
                Post::withTrashed()->whereIn('id', $list_check)->restore();
                return redirect()->route('posts.index')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
            }
            if ($act == 'forceDelete') {
                Post::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('posts.index')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
            }
            if ($act == 'pending') {
                Post::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
                return redirect()->route('posts.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
            if ($act == 'public') {
                Post::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
                return redirect()->route('posts.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
        }
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'required' => ':attribute danh mục không được để trống !'
            ],
            [
                'name' => 'Tên'
            ]
        );
        CategoryPost::create([
            'name' => $request->name,
            'user_create' => Auth::user()->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('posts.indexcategory')->with('status', 'Bạn đã thêm danh mục bài viết thành công !');
    }
    public function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if (!empty($list_check)) {
            $act = $request->input('act');
            if ($act == 'delete') {
                CategoryPost::destroy($list_check);
                return redirect()->route('posts.indexcategory')->with('status', 'Bạn đã xóa bản ghi thành công !');
            }
            if ($act == 'restore') {
                CategoryPost::withTrashed()->whereIn('id', $list_check)->restore();
                return redirect()->route('posts.indexcategory')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
            }
            if ($act == 'forceDelete') {
                CategoryPost::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('posts.indexcategory')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
            }
            if ($act == 'pending') {
                CategoryPost::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
                return redirect()->route('posts.indexcategory')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
            if ($act == 'public') {
                CategoryPost::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
                return redirect()->route('posts.indexcategory')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
        }
    }
    public function deletecat(Request $request, $id)
    {
        $id = CategoryPost::find($id);
        $id->delete();
        return redirect()->route('posts.indexcategory')->with('status', 'Bạn đã xóa danh mục bài viết thành công !');
    }
    public function editcat(Request $request, $id)
    {
        $id_cat = CategoryPost::find($id);
        $htmlOption = $this->getCategory($id_cat->parent_id);
        return view('admin.category.edit-cat-post', compact('id_cat', 'htmlOption'));
    }
    public function updatecat(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'required' => ':attribute danh mục không được để trống !'
            ],
            [
                'name' => 'Tên'
            ]
        );
        CategoryPost::where('id', $id)->update([
            'name' => $request->name,
            'user_create' => Auth::user()->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('posts.indexcategory')->with('status', 'Cập nhật danh mục bài viết thành công !');
    }
}
