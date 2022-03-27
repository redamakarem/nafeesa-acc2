@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.fixedAsset.title_singular') }}:
                    {{ trans('cruds.fixedAsset.fields.id') }}
                    {{ $fixedAsset->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('fixed-asset.edit', [$fixedAsset])
        </div>
    </div>
</div>
@endsection