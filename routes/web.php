<?php

use App\Http\Controllers\Admin\BEPCController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\FinishedController;
use App\Http\Controllers\Admin\FixedAssetController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LaborController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RawMaterialController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\SemiFinishedController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::mediaLibrary();

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Raw Materials
    Route::resource('raw-materials', RawMaterialController::class, ['except' => ['store', 'update', 'destroy']]);

    // Unit
    Route::resource('units', UnitController::class, ['except' => ['store', 'update', 'destroy']]);

    // Semi Finished
    Route::resource('semi-finisheds', SemiFinishedController::class, ['except' => ['store', 'update', 'destroy']]);

    // Labor
    Route::resource('labors', LaborController::class, ['except' => ['store', 'update', 'destroy']]);

//    Finished

    Route::resource('finisheds', FinishedController::class, ['except' => ['store', 'update', 'destroy']]);

    // Fixed Assets
    Route::resource('fixed-assets', FixedAssetController::class, ['except' => ['store', 'update', 'destroy']]);


    // Settings
    Route::resource('settings', SettingController::class, ['except' => ['store', 'update', 'destroy']]);

    // Branch
    Route::resource('branches', BranchController::class, ['except' => ['store', 'update', 'destroy']]);

    // BEPC
    Route::get('bepc',[BEPCController::class,'show'])->name('bepc.show');
    Route::get('bepc/edit',[BEPCController::class,'edit'])->name('bepc.edit');;
    Route::get('bepc/create',[BEPCController::class,'create'])->name('bepc.create');;

    //    Imports
    Route::get('import/raw-materials', [\App\Http\Controllers\Admin\ImportController::class,'rawMaterials'])
        ->name('admin.import.raw-materials');
    Route::get('import/sales', [\App\Http\Controllers\Admin\ImportController::class,'sales'])
        ->name('admin.import.sales');

    // Sales
    Route::get('sales/losses',[SalesController::class,'losses'])->name('admin.sales.losses');
    Route::resource('sales', SalesController::class, ['except' => ['store', 'update', 'destroy']]);

});




Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});

Route::get('dates',function (){

    return Carbon::parse('2021-12-01')->dayOfWeek;
});
Route::get('update-sales',function (){

    foreach (\App\Models\Sales::all() as $sale){
        $sale->costs = $sale->item->cost_per_unit * $sale->qty;
        $sale->profit = $sale->selling_price - $sale->costs;
        $sale->weekday = Carbon::parse($sale->date)->dayOfWeek;
        $sale->save();
    }
    return "Done";
});

