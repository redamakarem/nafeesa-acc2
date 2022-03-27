@extends('layouts.admin')
@section('content')
{{--<div class="row">--}}
{{--    <div class="card bg-blueGray-100">--}}
{{--        <div class="card-header">--}}
{{--            <div class="card-header-container">--}}
{{--                <h6 class="card-title">--}}
{{--                    {{ trans('global.view') }}--}}
{{--                    {{ trans('cruds.finished.title_singular') }}:--}}
{{--                    {{ trans('cruds.finished.fields.id') }}--}}
{{--                    {{ $finished->id }}--}}
{{--                </h6>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="card-body">--}}
{{--            <div class="pt-3">--}}
{{--                <table class="table table-view">--}}
{{--                    <tbody class="bg-white">--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.id') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $finished->id }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.name_en') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $finished->name_en }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.name_ar') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $finished->name_ar }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.labour_time') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $finished->labour_time }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.kilos_per_dough') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $finished->kilos_per_dough }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.raw_materials') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                @foreach($finished->rawMaterials as $key => $entry)--}}
{{--                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.semi_finished') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                @foreach($finished->semiFinished as $key => $entry)--}}
{{--                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.finished.fields.labor') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                @foreach($finished->labor as $key => $entry)--}}
{{--                                    <span class="badge badge-relationship">{{ $entry->title_en }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                @can('finished_edit')--}}
{{--                    <a href="{{ route('admin.finisheds.edit', $finished) }}" class="btn btn-indigo mr-2">--}}
{{--                        {{ trans('global.edit') }}--}}
{{--                    </a>--}}
{{--                @endcan--}}
{{--                <a href="{{ route('admin.finisheds.index') }}" class="btn btn-secondary">--}}
{{--                    {{ trans('global.back') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@livewire('finished.show',[$finished])
@endsection
