<?php

use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route to take signature later on in case order is placed before without client present


//Route to get secure signature files
Route::get('/signatures/{file}', [ function ($file) {
  $path = storage_path('signatures/'.$file);
  if (file_exists($path)) {
    return response()->file($path, array('Content-Type' =>     'image/jpeg'));
  }
  abort(404);
}])->middleware('auth');

Route::get('signature/{orderid}','OrderController@signature');
Route::post('signature/{orderid}','OrderController@storeSignature');


//Route::get('oneoffcompletedate','OrderController@oneOffCompleteDate');


/*
Route::get('symlink',function() {
    Artisan::call('storage:link');
}); */


//All AJAX routes here 

Route::get('/ajax-cust',function(){


	$cust_id = Request::get('cust_id');

	$customer = App\Customer::findorfail($cust_id);

	return response()->json($customer);

});


/*
Route::get('/etemp', function () {

	//$order = App\Order::findorfail(1);
	//$customer = App\Customer::find($order->customer_id);
	//$message = [];

   //return view('emails.invoice',compact('order','customer','message'));

	$doc_type = 'INVOICE';
	return view('emails.receipt',compact('doc_type'));

}); */


/*
Route::get('/date', function () {
    $order = App\Order::find(1);

    $date = DateTime::createFromFormat('j/m/Y',$order->booking_date)->format('D j M Y');

    dd($date);
});
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/label', function () {
    return view('labels.label');
});


/*
Route::get('/email', function () {
    return view('quote.untitled');
});
*/



// Route::get('importcustomers','CustomerController@importCustomers');


Route::get('email','UserController@sendEmailReminder');


// Proper Routes start here 

//Invoice preview and Invoice Email

Route::get('/invpreview/{id}/{reminder}','OrderController@invPreview');
Route::get('/invprint/{id}/{reminder}','OrderController@invPrint');
Route::get('/invemail/{id}/{reminder}','OrderController@invEmail');
Route::get('/invpdf/{id}','OrderController@invPdf');

//Receipt preview and receipt email

Route::get('/recpreview/{id}','OrderController@recPreview');
Route::get('/recprint/{id}','OrderController@recPrint');
Route::get('/recemail/{id}','OrderController@recEmail');


//Route::auth();


// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


//Route::get('/home', 'HomeController@index');
Route::get('/home', 'OrderController@index');
Route::get('/settings', 'SettingController@index');
Route::post('/settings/{id}', 'SettingController@update');

//Customers

Route::get('/customer', 'CustomerController@index');
Route::get('/customer/create', 'CustomerController@create');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/{id}', 'CustomerController@show')->name('customer.show');
Route::get('/customer/{id}/edit', 'CustomerController@edit')->name('customer.edit');
Route::put('/customer/{id}', 'CustomerController@update');
Route::delete('/customer/{id}', 'CustomerController@destroy');
Route::get('/customer/{id}/deleteconfirm', 'CustomerController@deleteconfirm');
Route::get('custreports','CustomerController@custReports');
Route::get('exportcustomers','CustomerController@exportCustomers');
Route::get('exportconstituents','CustomerController@exportconstituents');
Route::get('exportcustnewsletteronly','CustomerController@exportcustnewsletteronly'); 
Route::get('exportsearchresult','CustomerController@ExportSearchResult');
Route::get('custsearch1/{id}','CustomerController@search1');
Route::get('custsearch/{id}','CustomerController@search');
Route::post('custsearchresult','CustomerController@searchResult');


//pre order booking routes 

Route::resource('booking', 'BookingController');
Route::resource('allbookings', 'BookingController@allbookings');


//Orders

Route::get('/order/{orderid}/{p}/confirmCompleteDate','OrderController@confirmCompleteDate');
Route::post('/order/{orderid}/{p}/updateCompleteDate','OrderController@updateCompleteDate');

Route::get('/order','OrderController@index');
Route::get('/order/create','OrderController@create');
Route::post('/order','OrderController@store');
Route::get('/order/{order}','OrderController@show');
Route::get('/order/create','OrderController@create');
Route::get('/order/{order}/edit/{from}','OrderController@edit')->name('orderedit');
Route::put('/order/{order}','OrderController@update');
Route::delete('/order/{order}','OrderController@destroy');

Route::get('/order/{custid}/neworder','OrderController@neworder');
Route::post('/order/{custid}/store','OrderController@store');
Route::post('/order/{quoteid}/createfromquote','OrderController@createOrderFromQuote');
Route::get('ordreport','OrderController@OrderReport'); 
Route::post('ordreport','OrderController@OrderReportSummary');
Route::get('/orderreportexport/{booking_date_from}/{booking_date_to}','OrderController@OrderReportExport');
Route::get('/order/{order}/deviceFixedNotifPreview','OrderController@DeviceFixedNotifPreview');
Route::get('/order/{order}/deviceFixedNotifEmail','OrderController@DeviceFixedNotifEmail');
//get order signature
Route::get('/order/{order}/getSignature','OrderController@getSignature');

//print label
Route::get('/printlabel/{order}','OrderController@PrintLabel');

//Device Testing Routes

Route::get('/devicetest/{orderid}/view','OrderController@testView');
Route::get('/devicetest/{orderid}/create','OrderController@testCreate');
Route::post('/devicetest/{orderid}/update','OrderController@testUpdate');
Route::get('devicetest/{orderid}/preview','OrderController@testPreview');
Route::get('devicetest/{orderid}/email','OrderController@testEmail');
Route::get('devicetest/{orderid}/print','OrderController@testPrint');


//Commission Report 
//This link will display date range to extract orline table
Route::get('commissionreport','OrderController@CommissionReport');

//Commission Report Extract 
//This link will display a list all order lines within selected date range from date range view
Route::post('commissionreportextract','OrderController@CommissionReportExtract');

 
//Order Print and Email
Route::get('/order/{orderid}/emailpreview','OrderController@emailpreview')->name('emailPreview');
Route::get('order/{orderid}/email','OrderController@email');
Route::get('order/{orderid}/print','OrderController@print');


//Order Lines orlines

Route::get('orlinesSearch','OrlineController@search');
Route::post('orlinesSearch','OrlineController@index');
Route::post('/orline/{orderid}','OrlineController@store');
Route::get('/orline/{id}/delete','OrlineController@destroy');
Route::post('/orline/{id}/update','OrlineController@update');

//users
Route::resource('user', 'UserController');
Route::get('user/{id}/changePassword','UserController@changePassword');
Route::put('user/{id}/changePassword','UserController@updatePassword');

//Role CRUD routes..

Route::get('roles', 'RoleController@index');
Route::post('roles', 'RoleController@store');
Route::get('role/create','RoleController@create');
Route::get('role/{id}/edit','RoleController@edit');
Route::get('role/{id}/deleteConfirm','RoleController@delete');
Route::put('role/{id}','RoleController@update');
Route::delete('role/{id}','RoleController@destroy');

//Permission CRUD routes...
Route::get('permissions','PermissionController@index');
Route::post('permissions','PermissionController@store');
Route::get('permission/create','PermissionController@create');
Route::get('permission/{id}/edit','PermissionController@edit');
Route::get('permission/{id}/deleteConfirm','PermissionController@delete');
Route::put('permission/{id}','PermissionController@update');
Route::delete('permission/{id}','PermissionController@destroy');

//Quote Routes
//rout for quote lists
Route::get('quote','QuoteController@index');
//route for creating new quote
Route::get('quote/{custid}/{from}/create','QuoteController@create');
//route for storing new quote
Route::post('quote/{custid}/store','QuoteController@store');
//router for updating new quote
Route::get('quote/{id}/edit','QuoteController@edit');
Route::post('quote/{id}/update','QuoteController@update');
Route::get('quote/{id}/editdetail','QuoteController@editDetail');
Route::get('quote/{quoteid}/emailpreview','QuoteController@emailpreview');
Route::get('quote/{quoteid}/email','QuoteController@email');
Route::get('quote/{quoteid}/print','QuoteController@print');
Route::get('quote/{quoteid}/deleteconfirm','QuoteController@deleteConfirm');

//Route::post('quote/{quoteid}/delete','QuoteController@delete');

Route::get('quote/{quoteid}/delete','QuoteController@delete');

Route::get('quote/{quoteid}/convorder','QuoteController@convertToOrder');
Route::get('quote/{quoteid}/copy','QuoteController@copy');
Route::get('quote/{custid}/{from}/back','QuoteController@goBack');

Route::get('quote/{quoteid}/delete','QuoteController@delete');

//Quote Line Routes
Route::get('qline/{quoteid}/create','QlineController@create');
Route::post('qline/{quoteid}/store','QlineController@store');
Route::get('qline/{qlineid}/edit','QlineController@edit');
Route::post('qline/{qlineid}/update','QlineController@update');
Route::get('qline/{qlineid}/delete','QlineController@delete');
Route::get('qline/{qlineid}/image','QlineController@image');
Route::post('qline/{qlineid}/imageupload','QlineController@imageUpload');
Route::get('qline/{qlineid}/removeimage','QlineController@removeImage');
Route::get('qline/{qlineid}/getimage','QlineController@getImage');


//Payment 

Route::post('payment/{orderid}','PaymentController@store');
Route::get('payment/{id}/delete','PaymentController@delete');


//Secure Signature files - This route will be secure 

//Suppliers Routes here 

Route::get('/suppliers','SupplierController@index')->name('suppliers.index');
Route::get('/suppliers/create','SupplierController@create')->name('suppliers.create');
Route::post('/suppliers','SupplierController@store')->name('suppliers.store');
Route::get('/suppliers/{supplier}','SupplierController@show')->name('suppliers.show');
Route::get('/suppliers/{supplier}/edit','SupplierController@edit')->name('suppliers.edit');
Route::put('/suppliers/{supplier}','SupplierController@update')->name('suppliers.update');
Route::get('/suppliers/{supplier}/delete','SupplierController@destroy')->name('suppliers.destroy');

//Images Routes 

Route::get('image/{id}','ImageController@getImage');



