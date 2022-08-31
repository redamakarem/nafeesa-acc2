<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Sale;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sale.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sale.create');
    }

    public function edit(Sales $sale)
    {
        abort_if(Gate::denies('sale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sale.edit', compact('sale'));
    }

    public function show(Sales $sale)
    {
        abort_if(Gate::denies('sale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sale->load('item', 'branch');

        return view('admin.sale.show', compact('sale'));
    }

    public function losses()
    {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.sale.losses');
    }
    public function by_product()
    {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.sale.by-product');
    }

    public function lossItems()
    {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.sale.loss-items');
    }

    public function other()
    {
        abort_if(Gate::denies('sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.sale.other');
    }
}
