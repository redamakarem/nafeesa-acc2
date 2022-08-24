@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('global.create') }}
                        {{ trans('cruds.sale.title') }}
                    </h6>
                </div>
            </div>

            <div class="card-body">
                @livewire('sale.import-v2')
            </div>
        </div>
    </div>
@endsection
