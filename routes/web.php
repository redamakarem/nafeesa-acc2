<?php

use Carbon\Carbon;
use App\Models\Sales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BEPCController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaborController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FinishedController;
use App\Http\Controllers\Admin\FixedAssetController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Admin\RawMaterialController;
use App\Http\Controllers\Admin\SemiFinishedController;
use App\Http\Controllers\LoyaltyItemController;
use App\Http\Controllers\ReportsController;

Route::mediaLibrary();

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    Route::get('config/separate-sales',function(){
        Sales::isSales()->isZeroSalePrice()->whereNotIn('item_id',[27])->update(['transaction_type' =>3]);
        return 'Done';
    });

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

    // Loyalty items
    Route::resource('loyalty-items', LoyaltyItemController::class, ['only' => ['index','create', 'delete']]);

    // Semi Finished
    Route::resource('semi-finisheds', SemiFinishedController::class, ['except' => ['store', 'update', 'destroy']]);

    // Labor
    Route::resource('labors', LaborController::class, ['except' => ['store', 'update', 'destroy']]);

//    Finished
    Route::get('update-costs/{id}',[FinishedController::class,'update_costs'])->name('finished.update-costs');
    Route::get('per-unit',[FinishedController::class,'per_unit'])->name('finished.per-unit');
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
    Route::get('import/sales-new', [\App\Http\Controllers\Admin\ImportController::class,'sales_new'])
        ->name('admin.import.sales-new');

    // Sales
    Route::get('sales/losses',[SalesController::class,'losses'])->name('admin.sales.losses');
    Route::get('sales/loss-items',[SalesController::class,'lossItems'])->name('admin.sales.lossItems');
    Route::get('sales/other',[SalesController::class,'other'])->name('admin.sales.other');
    Route::resource('sales', SalesController::class, ['except' => ['store', 'update', 'destroy']]);


    // Reports
    
    Route::get('reports/pps',[SalesController::class,'by_product'])->name('reports.pps');
    Route::get('reports/sales-by-date',[SalesController::class,'by_date'])->name('reports.sales-by-date');
    Route::get('reports/sales-by-branch',[ReportsController::class,'sales_by_branch'])->name('reports.sales-by-branch');
    Route::get('reports/top-products/{count}',[ReportsController::class,'top_products'])->name('top-products');


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
    \App\Models\Sales::all()->chunk(200,function($sales){
        foreach ($sales as $sale){
            $sale->costs = $sale->item->cost_per_unit * $sale->qty;
            $sale->profit = $sale->selling_price - $sale->costs;
            $sale->weekday = Carbon::parse($sale->date)->dayOfWeek;
            $sale->save();
        }
    });
    
    return "Done";
});

