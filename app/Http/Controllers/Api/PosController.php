<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use DB;
use Illuminate\Http\Request;
class PosController extends Controller
{
    public function get_product($id){

    	$product=DB::table('products')
                ->where('category_id',$id)
                ->where('product_quantity','>','0')
                ->get();
        return response()->json($product);
    }

    public function stock_product(){
    	$products = Product::with(['category','supplier'])->where('product_quantity','>','0')->get();
        return response()->json($products);
    }
}
