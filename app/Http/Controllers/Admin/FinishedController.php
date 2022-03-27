<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finished;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinishedController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finished_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.finished.index');
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
}
