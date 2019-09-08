<?php


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/customer','Api\CustomerController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');

//salary route
Route::Post('/paid/salary/{id}','Api\SalaryController@paySalary');
Route::Get('/all/salary','Api\SalaryController@all_salary');
Route::Get('/view/salary/{month}','Api\SalaryController@view_salary');
Route::Get('/edit/salary/{id}','Api\SalaryController@edit_salary');
Route::Post('/update/salary/{id}','Api\SalaryController@update_salary');

Route::Post('/stock/update/{id}','Api\StockController@stock_update');
//pos route
Route::Get('/getting/product/{id}','Api\PosController@get_product');
Route::Get('/stock/product','Api\PosController@stock_product');

//cart route
Route::Get('/cart/add/{id}','Api\CartController@add_cart');
Route::Get('/cart/product','Api\CartController@cart_product');
Route::Get('/cart/delete/{id}','Api\CartController@delete_cart');
Route::Get('/cart/increment/{id}','Api\CartController@increment_cart');
Route::Get('/cart/decrement/{id}','Api\CartController@decrement_cart');
Route::Get('/get/vat','Api\CartController@get_vat');

//order route
Route::Post('/orderdone','Api\CartController@orderDone');
Route::Get('/today/order','Api\OrderController@today_order');
Route::Get('/all/order','Api\OrderController@all_order');
Route::Get('/order/{id}','Api\OrderController@orderById');
Route::Get('/order/details/{id}','Api\OrderController@orderDetails');
Route::Post('/search/date','Api\OrderController@searchByDate');
Route::Post('/search/month','Api\OrderController@searchByMonth');

//home route
Route::Get('/today/sell','Api\OrderController@today_sell');
Route::Get('/today/income','Api\OrderController@today_income');
Route::Get('/today/due','Api\OrderController@today_due');
Route::Get('/today/expense','Api\OrderController@today_expense');
Route::Get('/stockout','Api\OrderController@stockout');
Route::Get('/category-count','Api\OrderController@category_count');
Route::Get('/product-count','Api\OrderController@product_count');
Route::Get('/employee-count','Api\OrderController@employee_count');
Route::Get('/supplier-count','Api\OrderController@supplier_count');
Route::Get('/customer-count','Api\OrderController@customer_count');