@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.fixedAsset.title_singular') }}:
                    {{ trans('cruds.fixedAsset.fields.id') }}
                    {{ $fixedAsset->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.id') }}
                            </th>
                            <td>
                                {{ $fixedAsset->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.hawally') }}
                            </th>
                            <td>
                                {{ $fixedAsset->hawally }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.oquila') }}
                            </th>
                            <td>
                                {{ $fixedAsset->oquila }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.salmiya') }}
                            </th>
                            <td>
                                {{ $fixedAsset->salmiya }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.jahra') }}
                            </th>
                            <td>
                                {{ $fixedAsset->jahra }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.ardiya') }}
                            </th>
                            <td>
                                {{ $fixedAsset->ardiya }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.fixedAsset.fields.qurain') }}
                            </th>
                            <td>
                                {{ $fixedAsset->qurain }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('fixed_asset_edit')
                    <a href="{{ route('admin.fixed-assets.edit', $fixedAsset) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.fixed-assets.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection