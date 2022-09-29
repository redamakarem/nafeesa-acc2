@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    Top Products
                </h6>

                @can('raw_material_create')
                    <a class="btn btn-indigo" href="{{ route('admin.raw-materials.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.rawMaterial.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('reports.top-products',[$result])

    </div>
</div>
@endsection