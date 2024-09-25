<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Testcontroller;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test',[Testcontroller::class,'index']);
Route::get('/create',[Testcontroller::class,'create']);

//one to many relation
Route::get('/userorderindex',[Testcontroller::class,'userorderindex']);
Route::get('/orderuserindex',[Testcontroller::class,'orderuserindex']);
Route::get('/storewitheloquent',[Testcontroller::class,'storewitheloquent']);

//many to many relation
Route::get('/userwithrole',[Testcontroller::class,'userwithrole']);
Route::get('/rolewithuser',[Testcontroller::class,'rolewithuser']);
Route::get('/addrole',[Testcontroller::class,'addrole']);
Route::get('/detachrole',[Testcontroller::class,'detachrole']);
Route::get('/syncrole',[Testcontroller::class,'syncrole']);
