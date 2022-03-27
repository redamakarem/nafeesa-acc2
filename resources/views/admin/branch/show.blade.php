@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('global.view') }}
                        {{ trans('cruds.branch.title_singular') }}:
                        {{ trans('cruds.branch.fields.id') }}
                        {{ $branch->id }}
                    </h6>
                </div>
            </div>

            <div class="card-body">
                <div class="pt-3">
                    <table class="table table-view">
                        <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.branch.fields.id') }}
                            </th>
                            <td>
                                {{ $branch->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branch.fields.title_en') }}
                            </th>
                            <td>
                                {{ $branch->title_en }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branch.fields.title_ar') }}
                            </th>
                            <td>
                                {{ $branch->title_ar }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branch.fields.shifts') }}
                            </th>
                            <td>
                                {{ $branch->shifts }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branch.fields.labor_count') }}
                            </th>
                            <td>
                                {{ $branch->labor_count }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branch.fields.total_manhours') }}
                            </th>
                            <td>
                                {{ $branch->total_manhours }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    @can('branch_edit')
                        <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-indigo mr-2">
                            {{ trans('global.edit') }}
                        </a>
                    @endcan
                    <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">
                        {{ trans('global.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
