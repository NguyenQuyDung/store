<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientIndexController extends Controller
{
    //
    public function index(){
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
        $list_sliders = Slider::first();
        $sliders = Slider::where('id','>',1)->get();
        $categorys = Category::where('parent_id',0)->get();
        $menus = Menu::where('parent_id',0)->get();
        $List_of_featured_products = Product::where('view_count','>',10)->limit(4)->get();
        $new_products = Product::orderBy('id','DESC')->paginate(8);
        return view('clients.index', compact('list_sliders','sliders','favouriteProduct','favouriteProductCount', 'categorys','menus','List_of_featured_products','new_products'));
    }
}
