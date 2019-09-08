<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return response()->json($suppliers);
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'shop_name' => 'required',
        ]);

        $image = $request->image;
        $slug = str_slug($request->name);

        if ($image) {
           $position = strpos($image, ';');
           $sub = substr($image, 0, $position);
           $ext = explode('/', $sub)[1];

           $name = $slug.'-'.time().'.'.$ext;
           $img = Image::make($image)->resize(240,200);
           $upload_path = 'backend/supplier/';
           $image_path = $upload_path.$name;
           $img->save($image_path);
        }else{
            $image_path = 'default.png';
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shop_name = $request->shop_name;
        $supplier->image = $image_path;
        $supplier->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'shop_name' => 'required',
        ]);

        $image = $request->new_image;
        $slug = str_slug($request->name);

        $supplier = Supplier::find($id);

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = $slug.'-'.time().'.'.$ext;

            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/supplier/';
            $image_path = $upload_path.$name;
            $success = $img->save($image_path);
            if ($success) {
                $supplier->image = $image_path;
                $emp = DB::table('suppliers')->where('id',$id)->first();
                $emp_img = $emp->image;
                if (file_exists($emp_img)) {
                    unlink($emp_img);
                }
            }
        }else{
            $old_image = $request->image;
            $supplier->image = $old_image;
        }

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->shop_name = $request->shop_name;
        $supplier->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $img_path = $supplier->image;
        if (file_exists($img_path)) {
           unlink($img_path);
           $supplier->delete();
        }else{
            $supplier->delete();
        }
    }
}
