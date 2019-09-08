<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();
        return response()->json($employees);
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
            'salary' => 'required',
            'nid' => 'required',
            'joining_date' => 'required',
        ]);

            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;

        if ($request->image) {

            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name =time().".".$ext;

            \Image::make($request->image)->resize(240,200)->save(public_path('backend/employee/').$name);

            // $image = Image::make(base64_decode($request->image))->resize(240,200);
            // $upload_path = 'backend/employee//';
            // $image_url = $upload_path.$name;
            // $image->save($image_url);

            $employee->image = 'backend/employee/'.$name;
            $employee->save();

        }else{
            $employee->image = 'default.png';
            $employee->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
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
            'salary' => 'required',
            'nid' => 'required',
            'joining_date' => 'required',
        ]);

        $employee = Employee::find($id);

        if ($request->new_image) {

            $position = strpos($request->new_image, ';');
            $sub = substr($request->new_image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name =time().".".$ext;

            \Image::make($request->new_image)->resize(240,200)->save(public_path('backend/employee/').$name);

            if ($name) {
                $employee->image = 'backend/employee/'.$name;
                $emp = DB::table('employees')->where('id',$id)->first();
                $img_path = $emp->image;
                if ($img_path) {
                    unlink($img_path);
                }
            }
        }else{
            $old_photo = $request->image;
            $employee->image = $old_photo;
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $employee->nid = $request->nid;
        $employee->joining_date = $request->joining_date;
        $employee->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if ($employee->image) {
           unlink($employee->image);
           $employee->delete();
        }else{
            $employee->delete();
        }
    }
}
