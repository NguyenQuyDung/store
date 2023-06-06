<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Customer;
use App\District;
use App\Favorite;
use App\Mail\CheckOut;
use App\Menu;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Province;
use App\RepLyComment;
use App\UserFavorite;
use App\Ward;
use Illuminate\Support\Str;
use Carbon\Doctrine\CarbonType;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ClientProductController extends Controller
{
    #----------------------------------------------------#
    #practice on recursion by getting a list of products-#
    #----------------------------------------------------#
    public function show_data($data)
    {
        echo "<prev>";
        print_r($data);
        echo "</prev>";
    }
    public function searchChildren($data, $id, &$child)
    {
        foreach ($data as $item) {
            if ($item['parent_id'] == $id) {
                $child[] = $item['id'];
                $this->searchChildren($data, $item['id'], $child);
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
        $List_of_featured_products = Product::where('view_count', '>', 10)->orderBy('id', 'DESC')->get();
        $categorys = Category::where('parent_id', 0)->get();
        // get product list by recursion
        foreach ($categorys as $category) {
            $child[] = $category->id;
            $product_catelog_list = Category::all();
            $this->searchChildren($product_catelog_list, $category->id, $child);
            $list_of_product[$category->id] = Product::whereIn('category_id', $child)->orderBy('id', 'DESC')->paginate(3);
            unset($child);
        }
        $menus = Menu::where('parent_id', 0)->get();
        return view('clients.product.shop', compact('categorys', 'menus', 'favouriteProductCount', 'favouriteProduct', 'list_of_product', 'List_of_featured_products'));
    }
    public function product(Request $request, $slug)
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
        $List_of_featured_products = Product::where('view_count', '>', 10)->orderBy('id', 'DESC')->get();
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $count_total_list_product = Product::count();
        $list_of_product = Category::where('slug', $slug)->first();
        $this_cat_id = $list_of_product->id;
        $data = Category::all();
        $child[] = $this_cat_id;
        $this_cat_name = $list_of_product->name;
        $this->searchChildren($data, $this_cat_id, $child);
        $list_product = Product::whereIn('category_id', $child)->orderBy('id', 'DESC')->paginate(9);
        $all = Product::whereIn('category_id', $child);
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'price_asc') {
                $list_product = $all->orderBy('price', 'ASC')->paginate(9)->appends(request()->query());
            } elseif ($sort_by == 'price_desc') {
                $list_product = $all->orderBy('price', 'DESC')->paginate(9)->appends(request()->query());
            } elseif ($sort_by == 'name_desc') {
                $list_product = $all->orderBy('name', 'DESC')->paginate(9)->appends(request()->query());
            } elseif ($sort_by == 'name_asc') {
                $list_product = $all->orderBy('name', 'ASC')->paginate(9)->appends(request()->query());
            }
        }
        // lọc giá sản phẩm 
        $price = $request->price;
        if ($price == 'price-1') {
            $list_product = $all->where(
                [
                    ['price', '>=', 500],
                    ['price', '<=', 10000000]
                ]
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-2') {
            $list_product = $all->where(
                [
                    ['price', '>=', 15000000],
                    ['price', '<=', 30000000]
                ]
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-3') {
            $list_product = $all->where(
                [
                    ['price', '>=', 35000000],
                    ['price', '<=', 60000000]
                ]
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-4') {
            $list_product = $all->where(
                [
                    ['price', '>=', 65000000],
                    ['price', '<=', 90000000]
                ]
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-5') {
            $list_product = $all->where(
                'price',
                '<',
                90000000
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-6') {
            $list_product = $all->where(
                'price',
                '>',
                90000000
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-7') {
            $list_product = $all->where(
                'price',
                '<',
                500000
            )->paginate(9)->appends(request()->query());
        } elseif ($price == 'price-8') {
            $list_product = $all->where(
                'price',
                '>',
                90000000
            )->paginate(9)->appends(request()->query());
        }
        // tìm kiếm sản phẩm theo thương hiệu
        if ($request->input('band')) {
            $band = $request->input('band');
            $list_product =  $all->where('name', 'LIKE', "%{$band}%")->paginate(9)->appends(request()->query());
        }
        $band = $request->input('band');
        return view(
            'clients.product.product',
            compact('count_total_list_product', 'favouriteProductCount', 'band', 'list_product', 'this_cat_name', 'categorys', 'menus', 'list_of_product', 'List_of_featured_products')
        );
    }
    public function detail(Request $request, $nameProduct)
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
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $product = Product::where('slug', $nameProduct)->first();
        // dd($product);
        //    foreach(){

        //    }
        // $h = Category::all();
        $rating = Comment::where('product_id', $product->id)->avg('rating');
        // làm tròn số sao trung bình
        $rating = round($rating);
        $comments = Comment::where(
            [
                'status' => 1,
                'product_id' => $product->id
            ]
        )->paginate(10);
        $replyComments = RepLyComment::where('id_product', $product->id)->get();
        $demo = Product::where('category_id', $product->category_id)->get();
        // dd($demo);
        return view('clients.product.detail', compact('product', 'rating', 'replyComments', 'comments', 'favouriteProduct', 'menus', 'categorys', 'demo', 'favouriteProduct', 'favouriteProductCount'));
    }
    public function search_Product(Request $request)
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
        $List_of_featured_products = Product::where('view_count', '>', 10)->orderBy('id', 'DESC')->get();
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $query = " ";
        if ($request->input('query')) {
            $query = $request->input('query');
        }elseif($request->input('query') == ""){
            return redirect()->route('index')->with('status', 'Bạn Cần Nhập Thông Tin Tìm Kiếm Mới Có Thể Thực Thi Thao Tác Này !');

        }
        // if ($request->input('query')) {
        //     $query = $request->input('query');
        // } elseif ($request->input('query') == "") {
        //     return redirect()->route('index')->with('status', 'Bạn Cần Nhập Thông Tin Tìm Kiếm Mới Có Thể Thực Thi Thao Tác Này !');
        // }
        // $search_products = $request->input('keyword');
        // $search_title = Product_cat::where('name', 'LIKE', "%{$keyword}%")->get();
        // $search_product = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        $results = Product::where('name', 'LIKE', "%{$query}%")->paginate(6);
        $list_product = Product::where('name', 'LIKE', "%{$query}%")->orderBy('id', 'DESC')->paginate(9);
        return view('clients.product.search_product', compact('results','List_of_featured_products', 'favouriteProduct', 'favouriteProductCount', 'query', 'list_product', 'categorys', 'menus'));
    }
    public function cart(Request $request)
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
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        return view('clients.cart.cart', compact('menus', 'categorys', 'favouriteProduct', 'favouriteProductCount'));
    }
    public function addTocart(Request $request, $slug)
    {
        $products = Product::where('slug', $slug)->first();
        if ($request->input('qty')) {
            $qty = $request->input('qty');
        } else {
            $qty = 1;
        }
        Cart::add(
            [
                'id' => $products->id,
                'name' => $products->name,
                'price' => $products->price,
                'qty' => $qty,
                'options' => [
                    'fature_image_path' => $products->fature_image_path
                ],
            ]
        );
        //return Redirect::route('cart', [$slug])->with();
        return redirect('gio-hang.html')->with('status', 'Thêm Sản Phẩm Vào Giỏ Hàng Thành Công !')->with(['products' => $products]);
    }
    public function add(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::find($request->productId);
            $response['cart'] = Cart::add(
                [
                    'id' => $products->id,
                    'name' => $products->name,
                    'price' => $products->price,
                    'qty' => 1,
                    'options' => [
                        'fature_image_path' => $products->fature_image_path
                    ],
                ]
            );
            $response['count'] = Cart::count();

            return $response;
        }
        return back();
    }
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $response['cart'] = Cart::remove($request->rowId);
            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            $response['subtotal'] = Cart::subtotal();
            return $response;
        }
        return back();
    }
    public function destroy()
    {
        Cart::destroy();
    }
    public function cartUpdate(Request $request)
    {
        $qty = $request->qty;
        $id = $request->id;
        Cart::update($id, $qty);
        foreach (Cart::content() as $row) {
            if ($row->rowId == $id) {
                $sub_total = $row->total;
            }
        }
        $sub_total = number_format($sub_total, 0, '', '.') . "VNĐ";
        $result = array(
            'num' => Cart::count(),
            'sub_total' => $sub_total,
            'total_price' => Cart::total()
        );
        return $result;
    }
    public function addFavoriteProduct(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::find($id);
            if (!$product) return response(['messages' => 'Sản phẩm không tồn tại !']);
            $messages = 'Bạn đã yêu thích sản phẩm thành công !';
            try {
                DB::table('favorites')
                    ->insert(
                        [
                            'product_id' => $id,
                            'user_id' => Auth::user()->id
                        ]
                    );
            } catch (\Exception $e) {
                $messages = 'Sản phẩm này đã được yêu thích !';
            }
            return response(['messages' => $messages]);
        }
    }
    public function showFavouriteProduct(Request $request)
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
        // dd($favouriteProduct);
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        return view('clients.product.favouriteProduct', compact('menus', 'categorys', 'favouriteProduct', 'favouriteProductCount'));
    }
    public function deleteFavouriteProduct(Request $request, $id)
    {
        $chooseDelete = Favorite::where('product_id', $id)->delete();
        //  $chooseDelete->destroy();
        return redirect()->route('show_favourite_product')->with('status', 'Xóa Sản Phẩm Yêu Thích Thành Công !');
    }
    public function BackFavouriteProduct(Request $request, $id)
    {
        $chooseDelete = Favorite::where('product_id', $id)->delete();
        //  $chooseDelete->destroy();
        return redirect()->route('show_favourite_product')->with('status', 'Thu Hồi Sản Phẩm Yêu Thích Thành Công !');
    }
    public function searchAjax(Request $request)
    {
        $value = $request->_text;
        $result = Product::where('name', 'LIKE', "%{$value}%")->get();
        $output = "";
        foreach ($result as $key => $item) {
            $output .= '
            <ul style="z-index:2; display:flex; margin:10px 20px;">
    <li style="list-style:none;"><a href="' . url('chi-tiet-san-pham', $item->slug) . '" class="d-flex text-decoration-none">
    <img height="50" src="' . url($item->fature_image_path) . '" alt="">
   <div class="ml-2">
   <p class="product-name mb-0" style="color: #bdb62a;
   font-weight: 500;
   font-size: 15px;
   -webkit-line-clamp: 2;">' . $item->name . '</p>
   <p class="item-price" style="color: #f22; font-weight: 400;">' . number_format($item['price'], 0, ",", ".") . '</p></div>
    </a></li>
</ul>
           ';
        }
        echo $output;
    }
    public function search(Request $request)
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
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $List_of_featured_products = Product::where('view_count', '>', 10)->orderBy('id', 'DESC')->get();
        $query = " ";
        if ($request->input('query')) {
            $query = $request->input('query');
        } elseif ($request->input('query') == "") {
            return redirect()->route('index')->with('status', 'Bạn Cần Nhập Thông Tin Tìm Kiếm Mới Có Thể Thực Thi Thao Tác Này !');
        }
        // $search_products = $request->input('keyword');
        // $search_title = Product_cat::where('name', 'LIKE', "%{$keyword}%")->get();
        // $search_product = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        $results = Product::where('name', 'LIKE', "%{$query}%")->paginate(6);
        // if ($request->input('query')) {
        //     $query = $request->input('query');
        //     $results = Product::where('name', 'LIKE', "%{$query}%")->paginate(6);
        // }

        return view('clients.product.search', compact('favouriteProduct', 'favouriteProductCount', 'results', 'query', 'menus', 'categorys', 'List_of_featured_products'));
    }
    public function checkout(Request $request)
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
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        $countries = Province::all();
        //dd($countries);
        return view('clients.cart.checkout', compact('countries', 'menus', 'categorys', 'favouriteProduct', 'favouriteProductCount'));
    }
    public function fetchState(Request $request)
    {
        $data['states'] = District::where("_province_id", $request->country_id)
            ->get(['_name', 'id']);

        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = Ward::where("_district_id", $request->state_id)
            ->get(["_name", "id"]);
        return response()->json($data);
    }
    public function sendComment(Request $request)
    {
        $data = $request->all();
        $comment =  Comment::create(
            [
                'product_id' => $data['product_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'comment' => $data['message'],
                'status' => 0,
                'rating' => $data['rating'],
            ]
        );
        return $comment;
    }
    public function order(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required',
                'email' => 'required',
                'city' => 'required',
                'phone_number' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'payment' => 'required'
               
            ],
            [
                'required' => ' :attribute không được để trống !'
            ],
            [
                'fullname' => 'Tên',
                'email' => 'Email',
                'city' => 'Thành phố',
                'phone_number' => 'Số điện thoại',
                'district' => 'Quận huyện',
                'ward' => 'Phường xã',
                'payment' => 'Phương thức thanh toán'
            ]
        );
        $email = $request->email;
        $fullname = $request->fullname;
        $phoneNumber = $request->phone_number;
        $note = $request->note;
        $payment = $request->payment;
        $countries = Province::where('id', $request->city)->first();
        $district = District::where('id', $request->district)->first();
        $ward = Ward::where('id', $request->ward)->first();
        $cityy = "Xã $ward->_name - Huyện $district->_name - Thành Phố $countries->_name";
        //  dd($cityy);
        $info_cart = Cart::content();
        $sub_total = 0;
        foreach (Cart::content() as $item) {
            $sub_total += $item->subtotal;
            $id = $item->id;
            $nameProduc = $item->name;
            $qty = $item->qty;
        }
        $time = time();
        $date = date('Y-m-d');
        $total = Cart::total();
        $code_order = "HUST-" . Str::random(8);
        $insertOrder = Customer::create(
            [
                'name' => $fullname,
                'gender' => '',
                'email' => $email,
                'address' => $cityy,
                'phone_number' => $phoneNumber,
                'note' => $note,
                'code' => $code_order,
                'nameProduct' => $nameProduc,
                'total' => $sub_total + $sub_total,
                'qty' => $qty,
                'status' => 'Đang Xử Lý'
            ]
        );
        $Order_product = Cart::content();
        $dataOrderDetail = array();
        foreach ($Order_product as $key => $value) {
            $dataOrderDetail['id_customer'] = $insertOrder->id;
            $dataOrderDetail['date_order'] = $date;
            $dataOrderDetail['total'] = $sub_total + $sub_total;
            $dataOrderDetail['payment'] = $payment;
            $dataOrderDetail['note'] = $note;
            $dataOrderDetail['nameProduct'] = $value->name;
            $dataOrderDetail['subtotal'] = $sub_total;
            $dataOrderDetail['qty'] = $value->qty;
            $dataOrderDetail['images'] = $value->options->fature_image_path;
            $dataOrderDetail['status'] = "Đang Xử Lý";
            $dataOrderDetail['price'] = $value->price;
            $dataOrderDetail['code'] = $code_order;
            $info = Order::create($dataOrderDetail);
            // return $info;
        }
        // thông tin gửi mail
        OrderDetail::create(
            [
                'id_order' => $insertOrder->id,
                'id_poduct' => $info->id
            ]
        );
        $cart = Cart::content();
        $data = [
            'fullname' => $fullname,
            'phone' => $phoneNumber,
            'address' => $cityy,
            'email' => $email,
            'order' => $cart,
            'code' => $code_order,
            'cart' => $cart,
            'total' => Cart::total()
        ];
        Mail::to($email)->send(new CheckOut($data));
        Cart::destroy();
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
        $menus = Menu::where('parent_id', 0)->get();
        $categorys = Category::where('parent_id', 0)->get();
        return view('clients.checkout.thankYou', compact('data', 'menus', 'categorys', 'favouriteProduct', 'favouriteProductCount'));
    }
}
