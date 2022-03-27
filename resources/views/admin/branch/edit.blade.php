@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('global.edit') }}
                        {{ trans('cruds.branch.title_singular') }}:
                        {{ trans('cruds.branch.fields.id') }}
                        {{ $branch->id }}
                    </h6>
                </div>
            </div>

            <div class="card-body">
                @livewire('branch.edit', [$branch])
            </div>
        </div>
    </div>
@endsection
