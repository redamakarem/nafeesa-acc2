@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('global.view') }}
                        {{ trans('cruds.setting.title_singular') }}:
                        {{ trans('cruds.setting.fields.id') }}
                        {{ $setting->id }}
                    </h6>
                </div>
            </div>

            <div class="card-body">
                <div class="pt-3">
                    <table class="table table-view">
                        <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.setting.fields.id') }}
                            </th>
                            <td>
                                {{ $setting->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setting.fields.key') }}
                            </th>
                            <td>
                                {{ $setting->key }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setting.fields.value') }}
                            </th>
                            <td>
                                {{ $setting->value }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.setting.fields.type') }}
                            </th>
                            <td>
                                {{ $setting->type_label }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    @can('setting_edit')
                        <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-indigo mr-2">
                            {{ trans('global.edit') }}
                        </a>
                    @endcan
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
                        {{ trans('global.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
