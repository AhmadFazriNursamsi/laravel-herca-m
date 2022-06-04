<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\DivisionsController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function(){
   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/users', [UsersController::class, 'index'])->name('users');
   Route::get('/users/create', [UsersController::class, 'create']);
   Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
   Route::post('/users/store', [UsersController::class, 'store']);
   Route::post('/users/update/{id}', [UsersController::class, 'update']);
   Route::post('/users/delete/{id}', [ApisController::class, 'apideleteuserbyid']);
   
   Route::get('/division', [DivisionsController::class, 'index']);
   Route::get('/api/divi/getdata', [ApisController::class, 'apigetdatadivi']);
   Route::get('/division/create', [DivisionsController::class, 'create']);
   Route::post('/division/store', [ApisController::class, 'store']);
   Route::post('/division/delete/{devision_name}', [ApisController::class, 'destroy']);
   Route::get('/division/detail/{division_name}', [ApisController::class, 'detail']);
   
   // Route::post('/division', [DivisionsController::class, 'store']);
   
   // Route::post('/division', [DivisionsController::class, 'store']);
   
   // Route::get('/division/create/', [DivisionsController::class, 'create']);
   
   Route::get('/api/users/getdata', [ApisController::class, 'apigetdatauser']);
   Route::get('/api/getdivision', [ApisController::class, 'apigetdivisi']);
   Route::get('/api/getrole', [ApisController::class, 'apigetrole']);

   //root baru 

    Route::get('ajax-crud-datatable', [DataTableAjaxCRUDController::class, 'index']);
    Route::post('store-company', [DataTableAjaxCRUDController::class, 'store']);
    Route::post('edit-company', [DataTableAjaxCRUDController::class, 'edit']);
    Route::post('delete-company', [DataTableAjaxCRUDController::class, 'destroy']);

});

require __DIR__.'/auth.php';
