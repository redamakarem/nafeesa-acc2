<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function sales_by_branch()
    {
        $sales_by_branch =
            DB::table('sales')
            ->select('title_en', DB::raw('SUM(selling_price) as total_sales'), DB::raw('SUM(costs) as total_costs'), DB::raw('SUM(profit) as total_profit'))
            ->groupBy('branch_id')
            ->join('branches', 'branch_id', '=', 'branches.id')
            ->get();
        return view('admin.reports.sales-by-branch', compact('sales_by_branch'));
    }

    public function top_products()
    {
        return view('admin.reports.top-products');
    }
}
