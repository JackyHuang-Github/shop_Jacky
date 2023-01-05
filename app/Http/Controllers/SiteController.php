<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Contact;
use App\Models\Element;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        $sliders = Element::where('page','index')->where('position','slider')->orderBy('sort','asc')->get();
        $arrivals = Item::where('cgy_id',2)->where('enabled',true)->orderBy('sort','asc')->get();
        $images = Element::where('page','index')->where('position','images')->orderBy('sort','asc')->take(4)->get();
        $new_product_top = Element::where('page','index')->where('position','new_product_top')->orderBy('sort','asc')->first();
        $new_products =  Item::where('cgy_id',1)->where('enabled',true)->orderBy('sort','asc')->get();
        $items_row3 = Element::where('page','index')->where('position','row3')->orderBy('sort','asc')->take(3)->get();
        return view('index',compact('sliders','arrivals','images','new_product_top','new_products','items_row3'));
    }

    public function shop(){
        $items_new_product = Item::where('cgy_id',1)->where('enabled',true)->orderBy('sort','asc')->get();
        $items_works = Item::where('cgy_id',2)->where('enabled',true)->orderBy('sort','asc')->get();
        $items_teach = Item::where('cgy_id',3)->where('enabled',true)->orderBy('sort','asc')->get();
        return view('shop',compact('items_new_product','items_works','items_teach'));
    }

    public function productDetail(Item $item){
        return view('product-detail',compact('item'));
    }

    public function blog(){
        return view('blog');
    }

    public function blogDetail(){
        return view('blog-detail');
    }

    public function contact(){
        return view('contact');
    }

    //儲存聯絡單
    public function storeContact(Request $request){
        $contact = Contact::create($request->only('subject','email','message','mobile'));
        if ($contact){
            print('儲存成功');
        }else{
            print('儲存失敗');
        }
        return redirect('/admin/contacts');
    }

}
