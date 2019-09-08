<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Extra;
use App\Model\OrderDetails;
use App\Model\Product;
use DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add_cart($id){

    	
    	$product = Product::where('id',$id)->first();

        $check = DB::table('carts')->where('pro_id',$id)->first();

        if ($check) {
            DB::table('carts')->where('pro_id',$id)->increment('pro_quantity');
            $cart_product = DB::table('carts')->where('pro_id',$id)->first();
            $sub_total = $cart_product->pro_quantity * $cart_product->pro_price;
            DB::table('carts')->where('pro_id',$id)->update(['sub_total'=>$sub_total]);
        }else{

            $cart = new Cart();

            $cart->pro_id = $id;
            $cart->pro_name = $product->product_name;
            $cart->pro_quantity = 1;
            $cart->pro_price = $product->selling_price;
            $cart->sub_total = $product->selling_price;

            $cart->save();
        }

    	
    }

    public function cart_product(){
    	$cart_products = Cart::all();
    	return response()->json($cart_products);
    }

    public function delete_cart($id){
    	$cart = Cart::find($id);
    	$cart->delete();
    }

    public function increment_cart($id){

        $quantity = Cart::where('id',$id)->increment('pro_quantity');
        $cart_product = Cart::find($id);
        $sub_total = $cart_product->pro_quantity * $cart_product->pro_price;
        DB::table('carts')->where('id',$id)->update(['sub_total'=>$sub_total]);

    }

    public function decrement_cart($id){
        $quantity = Cart::where('id',$id)->decrement('pro_quantity');
        $cart_product = Cart::find($id);
        $sub_total = $cart_product->pro_quantity * $cart_product->pro_price;
        DB::table('carts')->where('id',$id)->update(['sub_total'=>$sub_total]);
    }

    public function get_vat(){
        $vat=DB::table('extras')->first();
        return response()->json($vat);
    }

    public function orderDone(Request $request){
        $validateData = $request->validate([
            'customer_id' => 'required',
            'pay' => 'required',
            'due' => 'required',
            'payby' => 'required',
        ]);

        $data = array();

        $data['customer_id'] = $request->customer_id;
        $data['qty'] = $request->qty;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['payby'] = $request->payby;
        $data['order_date'] = date('d/m/Y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);

        $contents = Cart::all();
        $odata = array();
        foreach ($contents as $key => $content) {
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->pro_id;
            $odata['pro_quantity'] = $content->pro_quantity;
            $odata['pro_price'] = $content->pro_price;
            $odata['sub_total'] = $content->sub_total;
            DB::table('order_details')->insert($odata);

            DB::table('products')
                ->where('id',$content->pro_id)
                ->update(['product_quantity'=> DB::raw('product_quantity-'.$content->pro_quantity)]);
        }

        DB::table('carts')->delete();


    }
}
