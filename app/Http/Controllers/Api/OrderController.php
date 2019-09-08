<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Employee;
use App\Model\Expense;
use App\Model\Order;
use App\Model\OrderDetails;
use App\Model\Product;
use App\Model\Supplier;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    public function today_order(){
    	$data = date('d/m/Y');
    	$orders = Order::with(['customer'])->orderBy('id','DESC')->where('order_date',$data)->get();
    	// $orders = DB::table('orders')
    	// 		 ->join('customers','orders.customer_id','customers.id')
    	// 		 ->select('orders.*','customers.name','customers.phone')
    	// 		 ->get();
    	return response()->json($orders);
    }

    public function all_order(){
        $orders = Order::with(['customer'])->orderBy('id','DESC')->get();
        return response()->json($orders);
    }

    public function orderById($id){
    	$order = Order::with(['customer'])->find($id);
    	return response()->json($order);
    }

    public function orderDetails($id){
    	$order_details = OrderDetails::with(['product','order'])->where('order_id',$id)->get();
    	return response()->json($order_details);
    }

    public function searchByDate(Request $request){
        $order_date = $request->date;
        $new_date = new DateTime($order_date);
        $format_date = $new_date->format('d/m/Y');

        $orders = Order::with(['customer'])->where('order_date',$format_date)->get();
        return response()->json($orders);
    }

    public function searchByMonth(Request $request){
        $month = $request->month;
        $orders = Order::with(['customer'])->where('order_month',$month)->get();
        return response()->json($orders);
    }

    public function today_sell(){
        $date = date('d/m/Y');
        $sell_amount = Order::where('order_date',$date)->sum('total');
        return response()->json($sell_amount);
    }

    public function today_income(){
        $date = date('d/m/Y');
        $income_amount = Order::where('order_date',$date)->sum('pay');
        return response()->json($income_amount);
    }

    public function today_due(){
        $date = date('d/m/Y');
        $due_amount = Order::where('order_date',$date)->sum('due');
        return response()->json($due_amount);
    }

    public function today_expense(){
        $date = date('d/m/Y');
        $expense_amount = Expense::where('expense_date',$date)->sum('amount');
        return response()->json($expense_amount);
    }

    public function stockout(){
        $stockout_products = Product::where('product_quantity','<','1')->get();
        return response()->json($stockout_products);
    }

    public function category_count(){
        $category = Category::latest()->get()->count();
        return response()->json($category);
    }

    public function product_count(){
        $product = Product::latest()->get()->count();
        return response()->json($product);
    }

    public function supplier_count(){
        $supplier = Supplier::latest()->get()->count();
        return response()->json($supplier);
    }

    public function employee_count(){
        $employee = Employee::latest()->get()->count();
        return response()->json($employee);
    }

    public function customer_count(){
        $customer = Customer::latest()->get()->count();
        return response()->json($customer);
    }
}
