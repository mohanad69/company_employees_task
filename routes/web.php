<?php

use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    return view('admin.home');
});
Route::resource('companies','Admin\CompanyController');
Route::get('get_companies_datatable','Admin\CompanyController@companiesDataTable')->name('companies.datatable');
Route::resource('employees','Admin\EmployeeController');
Route::get('get_employees_datatable','Admin\EmployeeController@employeesDataTable')->name('employees.datatable');