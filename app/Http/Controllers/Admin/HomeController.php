<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sales;
use App\Models\Finished;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $data=[];
        $data['transactions'] = Sales::all()->count();
        $data['total_sales'] = Sales::all()->sum('selling_price');
        $data['profit'] = Sales::all()->sum('profit');
        $data['costs'] = Sales::all()->sum('costs');

        $data['raw_materials'] = RawMaterial::all()->count();
        $data['semi_finished'] = SemiFinished::all()->count();
        $data['finished'] = Finished::all()->count();

        $data['most_selling_quantity'] = DB::table('sales')
        ->select('item_id','name_ar',DB::raw('count(item_id) as total_sales'))
        ->join('finisheds', 'item_id', '=', 'finisheds.id')
        ->groupBy('item_id')
        ->orderBy('total_sales','desc')
        ->get()->first();

        $data['most_selling_price'] = DB::table('sales')
        ->select('item_id','name_ar',DB::raw('sum(selling_price) as total_price'))
        ->join('finisheds', 'item_id', '=', 'finisheds.id')
        ->groupBy('item_id')
        ->orderBy('total_price','desc')
        ->get()->first();

        $data['most_selling_profit'] = DB::table('sales')
        ->select('item_id','name_ar',DB::raw('sum(profit) as total_profit'))
        ->join('finisheds', 'item_id', '=', 'finisheds.id')
        ->groupBy('item_id')
        ->orderBy('total_profit','desc')
        ->get()->first();

        return view('admin.home',compact('data'));
    }
}
