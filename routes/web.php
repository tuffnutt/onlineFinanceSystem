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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

Route::post('/loans/loadcenter', 'LoansController@loadcenter')->name('loans.loadcenter');
Route::post('/loans/deactivate', 'LoansController@deactivate')->name('loans.deactivate');
Route::post('/loans/repayment', 'LoansController@repayment')->name('loans.repayment');
Route::get('/loans/loanUpdate', 'LoansController@loanUpdate')->name('loans.loanUpdate');

Route::post('/customers/loadcenterinsupdate', 'CustomersController@loadcenterinsupdate')->name('customers.loadcenterinsupdate');
Route::post('/customers/insuarancerepayment', 'CustomersController@insuarancerepayment')->name('customers.insuarancerepayment');
Route::get('/customers/insUpdate', 'CustomersController@insUpdate')->name('customers.insUpdate');

Route::post('/customers/loadcenterinsuarance', 'CustomersController@loadcenterinsuarance')->name('customers.loadcenterinsuarance');
Route::post('/customers/inswithdraw', 'CustomersController@inswithdraw')->name('customers.inswithdraw');
Route::get('/customers/insuaranceWithdraw', 'CustomersController@insuaranceWithdraw')->name('customers.insuaranceWithdraw');

Route::post('/customers/loadcentersavings', 'CustomersController@loadcentersavings')->name('customers.loadcentersavings');
Route::post('/customers/withdraw', 'CustomersController@withdraw')->name('customers.withdraw');
Route::get('/customers/savingsWithdraw', 'CustomersController@savingsWithdraw')->name('customers.savingsWithdraw');


Route::post('/reports/displayreport', 'ReportsController@displayReport')->name('reports.displayReport');
Route::get('/reports/create', 'ReportsController@create')->name('reports.create');

Route::post('/reports/repayment', 'ReportsController@repayment')->name('reports.repayment');
Route::get('/reports/showrepayment', 'ReportsController@showrepayment')->name('reports.showrepayment');

Route::post('/reports/attendence', 'ReportsController@attendence')->name('reports.attendence');
Route::get('/reports/showattendence', 'ReportsController@showattendence')->name('reports.showattendence');

Route::post('/reports/loanDetail', 'ReportsController@loanDetail')->name('reports.loanDetail');
Route::get('/reports/showloanDetail', 'ReportsController@showloanDetail')->name('reports.showloanDetail');

Route::post('/reports/advancedLoanDetail', 'ReportsController@advancedLoanDetail')->name('reports.advancedLoanDetail');
Route::get('/reports/showadvancedLoanDetail', 'ReportsController@showadvancedLoanDetail')->name('reports.showadvancedLoanDetail');

Route::post('/reports/loanSummary', 'ReportsController@loanSummary')->name('reports.loanSummary');
Route::get('/reports/showloanSummary', 'ReportsController@showloanSummary')->name('reports.showloanSummary');

Route::post('/reports/defaltLoan', 'ReportsController@defaltLoan')->name('reports.defaltLoan');
Route::get('/reports/showdefaltLoan', 'ReportsController@showdefaltLoan')->name('reports.showdefaltLoan');

Route::post('/reports/collection', 'ReportsController@collection')->name('reports.collection');
Route::get('/reports/showcollection', 'ReportsController@showcollection')->name('reports.showcollection');

Route::post('/reports/payment', 'ReportsController@payment')->name('reports.payment');
Route::get('/reports/showpayment', 'ReportsController@showpayment')->name('reports.showpayment');


Route::resource('branches','BranchesController');
Route::resource('centers','CentersController');
Route::resource('comments','CommentsController');
Route::resource('customers','CustomersController');
Route::resource('groups','GroupsController');
Route::resource('historyofloans','HistoryOfLoansController');
Route::resource('installments','InstallmentsController');
Route::resource('loans','LoansController');
Route::resource('payments','PaymentsController');
Route::resource('roles','RolesController');
Route::resource('transactions','TransactionsController');
Route::resource('users','UsersController');
Route::resource('reports','ReportsController');
