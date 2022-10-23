<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Carbon\Carbon;
use App\Models\Labor;
use App\Models\Sales;
use App\Models\Finished;
use App\Models\LoyaltyItem;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Validation\Rule;

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
    public function edit_new(Finished $finished)
    {
        abort_if(Gate::denies('finished_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $finished->load(['rawMaterials','rawMaterials.unit','labor','semiFinished']);
        $rms= RawMaterial::get()->map(function($rm) use ($finished) {
            $rm->value = data_get($finished->rawMaterials->firstWhere('id', $rm->id), 'pivot.amount') ?? null;
            if($rm->value!==null){
                $this->raw_materials[$rm->id] =$rm->value;
            }
            return $rm;
        });

        $lbs= Labor::orderBy('id','ASC')->get()->map(function($lb) use ($finished) {
            $lb->value = data_get($finished->labor->firstWhere('id', $lb->id), 'pivot.workers') ?? null;
            $lb->labor_time = data_get($finished->labor->firstWhere('id', $lb->id), 'pivot.labor_time') ?? null;
            if($lb->value!==null){
                $this->labor[$lb->id]['workers'] =$lb->value;
            }
            if($lb->labor_time!==null){
                $this->labor[$lb->id]['labor_time'] =$lb->labor_time;
            }
            return $lb;
        });

        $sfs= SemiFinished::get()->map(function($sf) use ($finished) {
            $sf->value = data_get($finished->semiFinished->firstWhere('id', $sf->id), 'pivot.amount') ?? null;
            if($sf->value!==null){
                $this->semi_finished[$sf->id] =$sf->value;
            }
            return $sf;
        });

        $units = Unit::all();


        return view('admin.finished.edit-new', compact(['finished','rms','lbs','sfs','units']));
    }

    public function store_new(Request $request, Finished $finished)
    {
        $validated_data = $request->validate([
            'item_code' =>['required'],
            'name_en' =>['required'],
            'name_ar' =>['required'],
            'kilos_per_dough' =>['required'],
            'sale_price' =>['required'],
            'freight' =>['required'],
            'other' =>['required'],
            'unit' =>['required','exists:units,id'],
        ]);
        
        $finished->update($validated_data);
        $finished->semiFinished()->sync($this->mapSemiFinished($request['sfs']??[]));
        $finished->rawMaterials()->sync($this->mapRawMaterials($request['rms']??[]));
        return redirect(route('admin.finisheds.index'));
    }

    public function show(Finished $finished)
    {
        abort_if(Gate::denies('finished_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finished->load('rawMaterials', 'semiFinished', 'labor');

        return view('admin.finished.show', compact('finished'));
    }

    public function update_costs($id)
    {
        $sales = Sales::isSales()->where('item_id',$id)->get();

foreach ($sales as $sale){
            $sale->costs = $sale->item->cost_per_unit * $sale->qty;
            $sale->profit = $sale->selling_price - $sale->costs;
            $sale->weekday = Carbon::parse($sale->date)->dayOfWeek;
            $sale->save();
        }
        $loyalty_whitelist = LoyaltyItem::all()->pluck('item_id')->flatten()->toArray();
        
        if(!in_array(intval($id),$loyalty_whitelist)){
            $finished_item = Finished::findOrfail($id);
            $finished_item->loyalty = $finished_item->sale_price * 0.03;
            
            $finished_item->save();
        }
        return redirect(route('admin.finisheds.index'));

    }


    private function mapSemiFinished($semiFinished)
    {
        $semiFinished = array_filter($semiFinished, function($a) { return ($a !== 0); });
        $semiFinished = array_filter($semiFinished);
        $result= collect($semiFinished)->map(function ($i) {
            if ($i !=null && $i>0 && $i!='0' && $i !=''){
            return ['amount' => $i];
            }
        });

        return $result;
    }
    private function mapRawMaterials($rawMaterials)
    {
        $rawMaterials = array_filter($rawMaterials, function($a) { return ($a !== 0); });
        $rawMaterials = array_filter($rawMaterials);
        $result= collect($rawMaterials)->map(function ($i) {
            if ($i !=null && $i>0 && $i!='0' && $i !=''){
            return ['amount' => $i];
            }
        });

        return $result;
    }
}
