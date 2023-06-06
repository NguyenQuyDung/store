<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Menu;
use App\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactCientController extends Controller
{
    //
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
        $List_of_featured_products = Product::where('view_count', '>', 10)->limit(4)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $menus = Menu::where('parent_id', 0)->get();
        return view('clients.contact.index', compact('categorys', 'menus', 'List_of_featured_products', 'favouriteProductCount', 'favouriteProduct'));
    }
    public function introducing()
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
        $menus = Menu::where('parent_id', 0)->get();
        return view('clients.introduce.index', compact('categorys', 'menus', 'favouriteProduct', 'favouriteProductCount'));
    }
    public function send(Request $request)
    {
        $data = $request->all();
       $contact =  Contact::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'address' => $data['address'],
                'industry' => $data['industry'],
                'information' => $data['message']
            ]
        );
        return $contact;
    }
}
