<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GrpcClientController;

Route::get('/', function () { return view('home'); });
Route::get('/admin', function () { return view('admin'); })->name('admin');

Route::get('/city-a', function () { return view('branch/city-a'); })->name('city-a');
Route::get('/city-b', function () { return view('branch/city-b'); })->name('city-b');
Route::get('/city-c', function () { return view('branch/city-c'); })->name('city-c');
Route::get('/city-d', function () { return view('branch/city-d'); })->name('city-d');
Route::get('/city-e', function () { return view('branch/city-e'); })->name('city-e');

Route::get('/update-item/{id}', [GrpcClientController::class, 'showUpdateItemView']);

Route::post('/grpc/create-item', [GrpcClientController::class, 'createItem']);
Route::get('/grpc/read-item/{id}', [GrpcClientController::class, 'readItem']);
Route::post('/grpc/update-item/{id}', [GrpcClientController::class, 'updateItem']);
Route::get('/grpc/delete-item/{id}', [GrpcClientController::class, 'deleteItem']);
Route::get('/grpc/list-items', [GrpcClientController::class, 'listItems']);
