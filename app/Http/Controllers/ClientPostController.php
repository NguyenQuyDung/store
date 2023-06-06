<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryPost;
use App\Menu;
use App\Post;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPostController extends Controller
{
    //
    public function show_data($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
    public function searchChildrenPost($data, $id, &$child)
    {
        foreach ($data as $item) {
            if ($item['parent_id'] == $id) {
                $child[] = $item['id'];
                $this->searchChildrenPost($data, $item['id'], $child);
            }
        }
    }
    public function index()
    {
        if (Auth::check()) {
            $userID = Auth::user()->id;
            $favouriteProduct = Product::whereHas('Favorite', function ($query) use ($userID) {
                $query->where('user_id', $userID);
            })->paginate(6);
            $favouriteProductCount = Product::whereHas('Favorite', function ($query) use ($userID) {
                $query->where('user_id', $userID);
            })->count();
        } else {
            $favouriteProduct = "";
            $favouriteProductCount = "";
        }
        $categorys = Category::where('parent_id', 0)->get();
        $category_posts = CategoryPost::where('parent_id', 0)->get();
        foreach ($category_posts as $category) {
            $child[] = $category->id;
            $post_catelog_list = CategoryPost::all();
            $this->searchChildrenPost($post_catelog_list, $category->id, $child);
            $list_of_post[$category->id] = Post::whereIn('category_id', $child)->orderBy('id', 'DESC')->paginate(6);
            unset($child);
        }
        $menus = Menu::where('parent_id', 0)->get();
        $posts_fature = Post::orderBy('view', 'DESC')->paginate(3);
        return view('clients.post.index', compact('favouriteProductCount','favouriteProduct','categorys', 'category_posts', 'menus', 'list_of_post', 'posts_fature'));
    }
    public function detail(Request $request, $name){
        if (Auth::check()) {
            $userID = Auth::user()->id;
            $favouriteProduct = Product::whereHas('Favorite', function ($query) use ($userID) {
                $query->where('user_id', $userID);
            })->paginate(6);
            $favouriteProductCount = Product::whereHas('Favorite', function ($query) use ($userID) {
                $query->where('user_id', $userID);
            })->count();
        } else {
            $favouriteProduct = "";
            $favouriteProductCount = "";
        }
        $categorys = Category::where('parent_id', 0)->get();
        $menus = Menu::where('parent_id', 0)->get();
        $detail_post = Post::where('slug', $name)->first();
        $detail_post->view = $detail_post->view + 1;
        $detail_post->save();
        return view('clients.post.post_detail', compact('categorys','detail_post','menus','favouriteProduct','favouriteProductCount'));
    }
}
