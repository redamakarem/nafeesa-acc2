@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        Breakeven Point Calculator
                    </h6>
                </div>
            </div>

            <div class="card-body">
                @livewire('break-even-point-calculator.show')
            </div>
        </div>
    </div>
@endsection
