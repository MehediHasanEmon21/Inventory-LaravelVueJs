<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return response()->json($customers);
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
        ]);

        $image = $request->image;
        $slug = str_slug($request->name);

        if ($image) {
           $position = strpos($image, ';');
           $sub = substr($image, 0, $position);
           $ext = explode('/', $sub)[1];

           $name = $slug.'-'.time().'.'.$ext;
           $img = Image::make($image)->resize(240,200);
           $upload_path = 'backend/customer/';
           $image_path = $upload_path.$name;
           $img->save($image_path);
        }else{
            $image_path = 'default.png';
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->image = $image_path;
        $customer->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
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
        ]);

        $image = $request->new_image;
        $slug = str_slug($request->name);

        $customer = Customer::find($id);

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = $slug.'-'.time().'.'.$ext;

            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/customer/';
            $image_path = $upload_path.$name;
            $success = $img->save($image_path);
            if ($success) {
                $customer->image = $image_path;
                $cus = DB::table('customers')->where('id',$id)->first();
                $cus_img = $cus->image;
                if (file_exists($cus_img)) {
                    unlink($cus_img);
                }
            }
        }else{
            $old_image = $request->image;
            $customer->image = $old_image;
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $img_path = $customer->image;
        if (file_exists($img_path)) {
           unlink($img_path);
           $customer->delete();
        }else{
            $customer->delete();
        }
    }
}
