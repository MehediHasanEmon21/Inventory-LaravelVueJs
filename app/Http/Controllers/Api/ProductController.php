<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category','supplier'])->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        $image = $request->image;
        $slug = str_slug($request->product_name);

        if ($image) {
           $position = strpos($image, ';');
           $sub = substr($image, 0, $position);
           $ext = explode('/', $sub)[1];

           $name = $slug.'-'.time().'.'.$ext;
           $img = Image::make($image)->resize(240,200);
           $upload_path = 'backend/product/';
           $image_path = $upload_path.$name;
           $img->save($image_path);

        }else{
            $image_path = 'default.png';
        }

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->image = $image_path;
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'root' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required',
        ]);

        $product = Product::find($id);

        if ($request->new_image) {

            $position = strpos($request->new_image, ';');
            $sub = substr($request->new_image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = str_slug($request->name)."-".time().".".$ext;

            $image = Image::make($request->new_image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success = $image->save($image_url);
            if ($success) {
                $product->image = $image_url;
                $pro = DB::table('products')->where('id',$id)->first();
                $img_path = $pro->image;
                if ($img_path) {
                    unlink($img_path);
                }
            }
        }else{
            $old_photo = $request->image;
            $product->image = $old_photo;
        }

        $product->category_id = $request->category_id;
        $product->supplier_id = $request->supplier_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->root = $request->root;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->buying_date = $request->buying_date;
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image) {
           unlink($product->image);
           $product->delete();
        }else{
            $product->delete();
        }
    }
}
