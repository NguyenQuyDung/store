<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Product;
use App\RepLyComment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    //
    public function index()
    {
        $list_comments = Comment::orderBy('id', 'DESC')->paginate(10);
        return view('admin.comment.index', compact('list_comments'));
    }
    public function delete($id)
    {
    }
    public function detailComment($id)
    {
        $infordetailComment = Comment::find($id);
        $product = Product::where('id', $infordetailComment->product_id)->first();
        //dd($product);
        $reply = RepLyComment::where('comment_id', $id)->get();
       
        //dd($reply);
        return view('admin.comment.detail', compact('infordetailComment', 'product', 'reply'));
    }
    public function replyComment(Request $request)
    {
        $data = $request->all();
        RepLyComment::create(
            [
                'id_product' => $data['product_id'],
                'comment_id' => $data['comment_id'],
                'name' => 'Hust',
                'reply_comment' => $data['reply'],
            ]
        );
        return redirect('comment')->with('status', 'Phản hồi thành công !');
    }
    public function action($id)
    {
        $id = Comment::find($id);
        //dd($id);
        Comment::where('id', $id->id)->update(
            [
                'product_id' => $id->product_id,
                'name' => $id->name,
                'email' => $id->email,
                'comment' => $id->comment,
                'status' => 1,
                'rating' => $id->rating,
            ]
        );
        return redirect('comment')->with('status', 'Duyệt đánh giá sản phẩm thành công !');
    }
    public function wating($id)
    {
        $id = Comment::find($id);
        //dd($id);
        Comment::where('id', $id->id)->update(
            [
                'product_id' => $id->product_id,
                'name' => $id->name,
                'email' => $id->email,
                'comment' => $id->comment,
                'status' => 0,
                'rating' => $id->rating,
            ]
        );
        return redirect('comment')->with('status', 'Chuyển trạng thái đánh giá sản phẩm thành công !');
    }
}
