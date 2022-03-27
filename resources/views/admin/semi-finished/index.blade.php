@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.semiFinished.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('semi_finished_create')
                    <a class="btn btn-indigo" href="{{ route('admin.semi-finisheds.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.semiFinished.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('semi-finished.index')

    </div>
</div>
@endsection