<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function paySalary(Request $request,$id){

    	$validateData = $request->validate([
    		'salary'=> 'required',
    		'salary_month'=> 'required',

    	]);

        $month = $request->salary_month;
        $check = DB::table('salaries')->where('salary_month',$month)->where('employee_id',$id)->select('salary_month','employee_id')->first();


        if ($check) {
            $new = 'Salary Already Paid';
           return response($new);
        }else {
            $salary = new Salary();
            $salary->employee_id = $id;
            $salary->amount = $request->salary;
            $salary->salary_date = date('d/m/Y');
            $salary->salary_month = $request->salary_month;
            $salary->salary_year = date('Y');
            $salary->save();
        }

    	
    }

    public function all_salary(){
    	$salaries_month = Salary::select('salary_month')->groupBy('salary_month')->get();
    	return response()->json($salaries_month);
    }

    public function view_salary($month){
        // $emp_salaries = Salary::with(['employee'])->where('salary_month',$month)->get();
        $emp_salaries = DB::table('salaries')
                        ->join('employees','salaries.employee_id','employees.id')
                        ->select('salaries.*','employees.name','employees.image')
                        ->where('salaries.salary_month',$month)
                        ->get();
        return response()->json($emp_salaries);
    }

    public function edit_salary($id){
        $view=DB::table('salaries')
            ->join('employees','salaries.employee_id','employees.id')
            ->select('employees.name','employees.email','salaries.*')
            ->where('salaries.id',$id)
            ->first();
        return response()->json($view); 
    }

    public function update_salary(Request $request, $id){
        $validateData = $request->validate([
            'amount'=> 'required',
            'salary_month'=> 'required',

        ]);

        $salary = Salary::find($id);
        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->amount;
        $salary->salary_month = $request->salary_month;
        $salary->save();
    }
}
