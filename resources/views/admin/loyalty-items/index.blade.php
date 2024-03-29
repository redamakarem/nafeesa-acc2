@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.finished.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('finished_create')
                    <a class="btn btn-indigo" href="{{ route('admin.loyalty-items.create') }}">
                        {{ trans('global.add') }} NON LOYALTY
                    </a>
                @endcan
            </div>
        </div>
        @livewire('loyalty-item.index')

    </div>
</div>
@endsection