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

    public function top_products($type = 'quantity', $count = 5)
    {
        $result = null;
        if ($type == 'price') {
            $result = DB::table('sales')
                ->select('item_id', 'name_ar', DB::raw('sum(selling_price) as total_price'))
                ->join('finisheds', 'item_id', '=', 'finisheds.id')
                ->groupBy('item_id')
                ->orderBy('total_price', 'desc')
                ->get()->take($count);
        } elseif ($type == 'profit') {
            $result = DB::table('sales')
                ->select('item_id', 'name_ar', DB::raw('sum(profit) as total_profit'))
                ->join('finisheds', 'item_id', '=', 'finisheds.id')
                ->groupBy('item_id')
                ->orderBy('total_profit', 'desc')
                ->get()->take($count);
        } else {
            $result = DB::table('sales')
                ->select('item_id', 'name_ar', DB::raw('count(item_id) as total_sales'))
                ->join('finisheds', 'item_id', '=', 'finisheds.id')
                ->groupBy('item_id')
                ->orderBy('total_sales', 'desc')
                ->get()->take($count);
        }
        return view('admin.reports.top-products',compact('result'));
    }
}
