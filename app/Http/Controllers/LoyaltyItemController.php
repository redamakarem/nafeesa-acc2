<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreLoyaltyItemRequest;
use App\Http\Requests\UpdateLoyaltyItemRequest;

class LoyaltyItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finished_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loyalty-items.index');
    }
    
    public function create()
    {
        abort_if(Gate::denies('finished_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.loyalty-items.create');
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
