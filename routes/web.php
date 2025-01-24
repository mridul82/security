<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\SalaryController;
use App\Http\Controllers\Employee\AdvancePaymentController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Inventory\InventoryController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/register', function () {
    return view('admin.auth');
});
Route::post('/register', [AuthController::class, 'doRegister']);

// Route::get('/', [AuthController::class, 'auth']);
Route::get('/', [AuthController::class, 'login'])->name('login');
// Route::post('/register', [AuthController::class, 'doRegister']);
Route::post('/login', [AuthController::class, 'doLogin']);

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');


    Route::get('/logout',  [AuthController::class, 'logout']);

    //Users managment
    Route::get('/users', [UserController::class, 'index'])->name('admin-users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin-users-create');
    Route::post('/users', [UserController::class, 'store'])->name('admin-users-store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin-users-edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin-users-update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin-users-destroy');

    // employee managment
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('/employees/{id}/show', [EmployeeController::class, 'show'])->name('employees.show');

    //salary management
    Route::get('employees/{employee}/salaries', [SalaryController::class, 'index'])
        ->name('employees.salaries.index');
    Route::post('employees/{employee}/salaries', [SalaryController::class, 'store'])
        ->name('employees.salaries.store');
    Route::post('employees/{employee}/salaries/process-monthly', [SalaryController::class, 'processMonthly'])
        ->name('employees.salaries.process-monthly');
    Route::get('salary', [SalaryController::class, 'salaries'])
        ->name('employees.salaries');

    //advance payment management
    Route::get('employees/{employee}/advances', [AdvancePaymentController::class, 'index'])
        ->name('employees.advances.index');
    Route::post('employees/{employee}/advances', [AdvancePaymentController::class, 'store'])
        ->name('employees.advances.store');
    Route::put('employees/{employee}/advances/{advance}', [AdvancePaymentController::class, 'update'])
        ->name('employees.advances.update');
    Route::delete('employees/{employee}/advances/{advance}', [AdvancePaymentController::class, 'destroy'])
        ->name('employees.advances.destroy');

    //client management
    Route::get('clients', [ClientController::class, 'index'])
        ->name('clients.index');
    Route::get('clients/create', [ClientController::class, 'create'])
        ->name('clients.create');
    Route::post('clients', [ClientController::class, 'store'])

        ->name('clients.store');
    Route::get('clients/{client}', [ClientController::class, 'show'])
        ->name('clients.show');
    Route::get('clients/{client}/edit', [ClientController::class, 'edit'])
        ->name('clients.edit');
    Route::put('clients/{client}', [ClientController::class, 'update'])
        ->name('clients.update');
    Route::delete('clients/{client}', [ClientController::class, 'destroy'])
        ->name('clients.destroy');


    //inventory management
    // Existing inventory routes
    Route::get('/inventory/categories', [InventoryController::class, 'categories'])->name('inventory.categories');
    Route::post('/inventory/add-category', [InventoryController::class, 'addCategory'])->name('inventory.add-category');
    Route::post('/inventory/add-sub-category', [InventoryController::class, 'addSubCategory'])->name('inventory.add-sub-category');

// New inventory product routes
    Route::get('/inventory/products', [InventoryController::class, 'products'])->name('inventory.products');
    Route::post('/inventory/add-product', [InventoryController::class, 'addProduct'])->name('inventory.add-product');
    Route::post('/inventory/issue-stock', [InventoryController::class, 'issueStock'])->name('inventory.issue-stock');

   



});



Route::group(['prefix'=>'sub-admin', 'middleware'=>'auth'], function(){
    Route::get('/dashboard', [SubAdminDashboardController::class, 'index'])->name('sub-admin-dashboard');
   

    Route::get('/logout',  [AuthController::class, 'logout']);
});
