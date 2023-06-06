<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\SendUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    //
    public function index()
    {
        $list_contact = Contact::paginate(12);
        return view('admin.pages.contacts', compact('list_contact'));
    }
    public function index_contact_us($id)
    {
        $contact = Contact::find($id);
        return view('admin.pages.contact-us', compact('contact'));
    }
    public function sendmail(Request $request)
    {
        //dd($request->all());
        $mail = $request->email;
        $info = $request->info;
        $phone = $request->phone;
        $address = $request->address;
        $industry = $request->industry;
        $name = $request->name;
        $data = [
            'info' => $info,
            'phone' => $phone,
            'address' => $address,
            'industry' => $industry,
            'name' => $name,
            'email' => $mail
        ];
        Mail::to($mail)->send(new SendUser($data));
        return redirect()->route('contacts.index')->with('status', 'Gửi Mail Phản Hồi Khách Hàng Thành Công !');
    }
}
