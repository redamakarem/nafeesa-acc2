@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.rawMaterial.title_singular') }}:
                    {{ trans('cruds.rawMaterial.fields.id') }}
                    {{ $rawMaterial->code }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.rawMaterial.fields.id') }}
                            </th>
                            <td>
                                {{ $rawMaterial->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.rawMaterial.fields.name_en') }}
                            </th>
                            <td>
                                {{ $rawMaterial->name_en }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.rawMaterial.fields.name_ar') }}
                            </th>
                            <td>
                                {{ $rawMaterial->name_ar }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.rawMaterial.fields.code') }}
                            </th>
                            <td>
                                {{ $rawMaterial->code }}
                            </td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.rawMaterial.fields.product_code') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $rawMaterial->product_code }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        <tr>
                            <th>
                                {{ trans('cruds.rawMaterial.fields.avg_cost') }}
                            </th>
                            <td>
                                {{ $rawMaterial->avg_cost }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.rawMaterial.fields.unit') }}
                            </th>
                            <td>
                                @if($rawMaterial->unit)
                                    <span class="badge badge-relationship">{{ $rawMaterial->unit->name_en ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('raw_material_edit')
                    <a href="{{ route('admin.raw-materials.edit', $rawMaterial) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.raw-materials.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
