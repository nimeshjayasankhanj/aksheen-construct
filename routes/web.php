<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/signin', function () {
    return view('signin');
})->middleware('guest');

Route::post('/loginMy', 'SecurityController@signin')->name('loginMy');

Route::group(['middleware' => 'auth', 'prefix' => ''], function () {

    Route::get('/', function () {
        return view('index', ['title' => 'dashboard']);
    })->name('/');

    //categories
    Route::get('/brand', 'BrandsController@index')->name('brand');
    Route::post('/saveBrand', 'BrandsController@save')->name('saveBrand');
    Route::post('/editBrand', 'BrandsController@edit')->name('editBrand');

    //products
    Route::get('/products', 'ProductsController@index')->name('products');
    Route::post('/saveProduct', 'ProductsController@store')->name('saveProduct');

    //Supplier
    Route::get('/suppliers', 'SupplierController@suppliersIndex')->name('suppliers');
    Route::post('/saveSupplier', 'SupplierController@store')->name('saveSupplier');
    Route::post('viewSupplier', 'SupplierController@viewTableData')->name('viewSupplier');
    Route::post('getSupplierById', 'SupplierController@getById')->name('getSupplierById');
    Route::post('updateSupplier', 'SupplierController@update')->name('updateSupplier');

    //GRN
    Route::get('/add-grn', 'GRNController@addGrnIndex')->name('add-grn');
    Route::post('/getProductById', 'GRNController@getProductById')->name('getProductById');
    Route::post('/getGrnTempTableData', 'GRNController@getGrnTempTableData')->name('getGrnTempTableData');
    Route::post('/saveTempGrn', 'GRNController@saveTempGrn')->name('saveTempGrn');
    Route::post('/getGRNByID', 'GRNController@getGRNByID')->name('getGRNByID');
    Route::post('/getVGrnByID', 'GRNController@getVGrnByID')->name('getVGrnByID');
    Route::post('/updateTempItem', 'GRNController@updateTempItem')->name('updateTempItem');
    Route::post('/deleteTempItem', 'GRNController@deleteTempItem')->name('deleteTempItem');
    Route::post('/saveGrn', 'GRNController@store')->name('saveGrn');
    Route::get('/grn-history', 'GRNController@grnHistoryIndex')->name('grn-history');
    Route::post('/getMoreByGrnID', 'GRNController@getMoreByGrnID')->name('getMoreByGrnID');

    //plans
    Route::get('/plans', 'PlanController@plansIndex')->name('plans');
    Route::post('/savePlan', 'PlanController@store')->name('savePlan');
    Route::post('/editPlan', 'PlanController@update')->name('editPlan');


    //constructions
    Route::get('/make-a-construction', 'ConstructionController@makeConstIndex')->name('make-a-construction');
    Route::post('/viewPlanImg', 'ConstructionController@viewPlanImg')->name('viewPlanImg');
    Route::get('/pending-constructions', 'ConstructionController@pendingConstructionsIndex')->name('pending-constructions');
    Route::post('/approvedConstruction', 'ConstructionController@approvedConstruction')->name('approvedConstruction');
    Route::get('/on-going-constructions', 'ConstructionController@onGoingIndex')->name('on-going-constructions');
    Route::post('/saveConEmployee', 'ConstructionController@saveConEmployee')->name('saveConEmployee');
    Route::post('/viewEmployees', 'ConstructionController@viewEmployees')->name('viewEmployees');
    Route::post('/deleteEmployee', 'ConstructionController@deleteEmployee')->name('deleteEmployee');
    Route::post('/savePayment', 'ConstructionController@savePayment')->name('savePayment');
    Route::post('/paymentHistory', 'ConstructionController@paymentHistory')->name('paymentHistory');
    Route::get('/completed-constructions', 'ConstructionController@completedConstructionsIndex')->name('completed-constructions');
    Route::post('/completedConstruction', 'ConstructionController@completedConstruction')->name('completedConstruction');

    //customers
    Route::get('/customers', 'CustomerController@customersIndex')->name('customers');
    Route::post('/saveCustomer', 'CustomerController@store')->name('saveCustomer');
    Route::post('/getCustomerById', 'CustomerController@getById')->name('getCustomerById');
    Route::post('/updateCustomer', 'CustomerController@update')->name('updateCustomer');
    Route::post('/viewCustomer', 'CustomerController@viewCustomer')->name('viewCustomer');

    //employee
    Route::get('/employees', 'EmployeeController@employeesIndex')->name('employees');
    Route::post('/saveEmployee', 'EmployeeController@store')->name('saveEmployee');
    Route::post('/getEmployeeById', 'EmployeeController@getById')->name('getEmployeeById');
    Route::post('/updateEmployee', 'EmployeeController@update')->name('updateEmployee');
    Route::post('/viewEmployee', 'EmployeeController@viewEmployee')->name('viewEmployee');



});
