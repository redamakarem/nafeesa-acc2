<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FixedAsset;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FixedAssetController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fixed_asset_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fixed-asset.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fixed_asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fixed-asset.create');
    }

    public function edit(FixedAsset $fixedAsset)
    {
        abort_if(Gate::denies('fixed_asset_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fixed-asset.edit', compact('fixedAsset'));
    }

    public function show(FixedAsset $fixedAsset)
    {
        abort_if(Gate::denies('fixed_asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fixed-asset.show', compact('fixedAsset'));
    }
}
