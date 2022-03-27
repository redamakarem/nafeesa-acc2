@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.finished.title_singular') }}:
                    {{ trans('cruds.finished.fields.id') }}
                    {{ $finished->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('finished.edit', [$finished])
        </div>
    </div>
</div>
@endsection