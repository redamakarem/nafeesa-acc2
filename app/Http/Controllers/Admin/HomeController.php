<?php

namespace App\Http\Controllers\Admin;

use App\Models\Finished;
use App\Models\RawMaterial;
use App\Models\Sales;
use App\Models\SemiFinished;

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

        return view('admin.home',compact('data'));
    }
}
