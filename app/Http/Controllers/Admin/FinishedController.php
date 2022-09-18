<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Finished;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class FinishedController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finished_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.finished.index');
    }
    public function per_unit()
    {
        abort_if(Gate::denies('finished_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.finished.per-unit');
    }

    public function create()
    {
        abort_if(Gate::denies('finished_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.finished.create');
    }

    public function edit(Finished $finished)
    {
        abort_if(Gate::denies('finished_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.finished.edit', compact('finished'));
    }

    public function show(Finished $finished)
    {
        abort_if(Gate::denies('finished_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finished->load('rawMaterials', 'semiFinished', 'labor');

        return view('admin.finished.show', compact('finished'));
    }

    public function update_costs($id)
    {
        $sales = Sales::isSales()->where('item_id',203)->get();

foreach ($sales as $sale){
            $sale->costs = $sale->item->cost_per_unit * $sale->qty;
            $sale->profit = $sale->selling_price - $sale->costs;
            $sale->weekday = Carbon::parse($sale->date)->dayOfWeek;
            $sale->save();
        }
        return redirect(route('admin.finisheds.index'));

    }
}
