<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RawMaterialController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('raw_material_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.raw-material.index');
    }

    public function create()
    {
        abort_if(Gate::denies('raw_material_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.raw-material.create');
    }

    public function edit(RawMaterial $rawMaterial)
    {
        abort_if(Gate::denies('raw_material_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.raw-material.edit', compact('rawMaterial'));
    }

    public function show(RawMaterial $rawMaterial)
    {
        abort_if(Gate::denies('raw_material_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rawMaterial->load('unit');

        return view('admin.raw-material.show', compact('rawMaterial'));
    }
}
