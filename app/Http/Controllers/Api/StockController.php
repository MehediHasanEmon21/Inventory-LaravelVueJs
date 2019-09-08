<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stock_update(Request $request, $id){
    	$validateData = $request->validate([
    		'product_quantity' => 'required',
    	]);

    	$product = Product::find($id);
    	$product->product_quantity = $request->product_quantity;
    	$product->save();

    }
}
