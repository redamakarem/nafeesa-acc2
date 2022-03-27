<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Labor;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaborController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('labor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.labor.index');
    }

    public function create()
    {
        abort_if(Gate::denies('labor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.labor.create');
    }

    public function edit(Labor $labor)
    {
        abort_if(Gate::denies('labor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.labor.edit', compact('labor'));
    }

    public function show(Labor $labor)
    {
        abort_if(Gate::denies('labor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.labor.show', compact('labor'));
    }
}
