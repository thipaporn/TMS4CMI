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
    return view('index');
});

Route::get('/element', function () {
    return view('basic_elements');
});

Route::get('/blank', function () {
    return view('blank-page');
});

Route::get('/button', function () {
    return view('buttons');
});

Route::get('/chart', function () {
    return view('chartjs');
});

Route::get('/404', function () {
    return view('error-404');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/mdi', function () {
    return view('mdi');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/typography', function () {
    return view('typography');
});

/*--------------------------------------------------------------------*/

Route::get('/home', function () {
    return view('home');
});

Route::get('/queueManagementInput', function () {
    return view('queue-management/input');
});

Route::get('/queueManagement', function () {
    return view('queue-management/output');
});

Route::get('/codeGenerator', function () {
    return view('code-generator/input');
});
