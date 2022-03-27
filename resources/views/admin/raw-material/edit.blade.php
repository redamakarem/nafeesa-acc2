@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.rawMaterial.title_singular') }}:
                    {{ trans('cruds.rawMaterial.fields.id') }}
                    {{ $rawMaterial->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('raw-material.edit', [$rawMaterial])
        </div>
    </div>
</div>
@endsection