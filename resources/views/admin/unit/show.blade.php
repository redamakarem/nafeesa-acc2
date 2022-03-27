@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.unit.title_singular') }}:
                    {{ trans('cruds.unit.fields.id') }}
                    {{ $unit->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.unit.fields.id') }}
                            </th>
                            <td>
                                {{ $unit->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.unit.fields.name_en') }}
                            </th>
                            <td>
                                {{ $unit->name_en }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.unit.fields.name_ar') }}
                            </th>
                            <td>
                                {{ $unit->name_ar }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('unit_edit')
                    <a href="{{ route('admin.units.edit', $unit) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.units.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection