<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\SemiFinished;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SemiFinishedController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('semi_finished_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.semi-finished.index');
    }

    public function create()
    {
        abort_if(Gate::denies('semi_finished_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.semi-finished.create');
    }

    public function edit(SemiFinished $semiFinished)
    {
        abort_if(Gate::denies('semi_finished_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $semiFinished->load(['rawMaterials','rawMaterials.unit']);
//        $rms= RawMaterial::get()->map(function($rm) use ($semiFinished) {
//            $rm->value = data_get($semiFinished->rawMaterials->firstWhere('id', $rm->id), 'pivot.amount') ?? null;
//            $this->raw_materials[$rm->id] =$rm->value;
//            return $rm;
//        });

        return view('admin.semi-finished.edit', compact('semiFinished'));
    }

    public function show(SemiFinished $semiFinished)
    {
        abort_if(Gate::denies('semi_finished_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $semiFinished->load(['rawMaterials','semiFinished','rawMaterials.unit','labor']);

        return view('admin.semi-finished.show', compact('semiFinished'));
    }
}
