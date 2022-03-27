@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.semiFinished.title_singular') }}:
                    {{ trans('cruds.semiFinished.fields.id') }}
                    {{ $semiFinished->item_code }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('semi-finished.edit', [$semiFinished])
        </div>
    </div>
</div>
@endsection
