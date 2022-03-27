@extends('layouts.admin')
@section('content')
{{--<div class="row">--}}
{{--    <div class="card bg-blueGray-100">--}}
{{--        <div class="card-header">--}}
{{--            <div class="card-header-container">--}}
{{--                <h6 class="card-title">--}}
{{--                    {{ trans('global.view') }}--}}
{{--                    {{ trans('cruds.semiFinished.title_singular') }}:--}}
{{--                    {{ trans('cruds.semiFinished.fields.id') }}--}}
{{--                    {{ $semiFinished->id }}--}}
{{--                </h6>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="card-body">--}}
{{--            <div class="pt-3">--}}
{{--                <table class="table table-view">--}}
{{--                    <tbody class="bg-white">--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.semiFinished.fields.id') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $semiFinished->id }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.semiFinished.fields.name_en') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $semiFinished->name_en }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.semiFinished.fields.name_ar') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $semiFinished->name_ar }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.semiFinished.fields.raw_materials') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                @foreach($semiFinished->rawMaterials as $key => $entry)--}}
{{--                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <th>--}}
{{--                                {{ trans('cruds.semiFinished.fields.kilos_per_dough') }}--}}
{{--                            </th>--}}
{{--                            <td>--}}
{{--                                {{ $semiFinished->kilos_per_dough }}--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}




{{--            <!-- component -->--}}
{{--            <section class="antialiased bg-gray-100 text-gray-600 h-screen px-4 pt-8">--}}
{{--                <div class="flex flex-col justify-center h-full">--}}
{{--                    <!-- Table -->--}}
{{--                    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">--}}
{{--                        <header class="px-5 py-4 border-b border-gray-100">--}}
{{--                            <h2 class="font-semibold text-gray-800">Raw Materials</h2>--}}
{{--                        </header>--}}
{{--                        <div class="p-3">--}}
{{--                            <div class="overflow-x-auto">--}}
{{--                                <table class="table-auto w-full">--}}
{{--                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">--}}
{{--                                    <tr>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-left">Code</div>--}}
{{--                                        </th>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-left">Product Code</div>--}}
{{--                                        </th>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-left">Name</div>--}}
{{--                                        </th>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-center">Unit</div>--}}
{{--                                        </th>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-center">Amount</div>--}}
{{--                                        </th>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-center">Avg Cost</div>--}}
{{--                                        </th>--}}
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-center">Total Cost</div>--}}
{{--                                        </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody class="text-sm divide-y divide-gray-100">--}}
{{--                                    @foreach($semiFinished->rawMaterials as $key=>$rawMaterial)--}}
{{--                                    <tr>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-left">{{$rawMaterial->code}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-left">{{$rawMaterial->product_code}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-left font-medium text-green-500">{{$rawMaterial->name_en}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-center font-medium text-green-500">{{$rawMaterial->unit->name_en}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="tbl-amount text-center font-medium text-green-500">{{$rawMaterial->pivot->amount}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-center font-medium text-green-500">{{$rawMaterial->avg_cost}}</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="tbl-total text-center font-medium text-green-500">{{$rawMaterial->pivot->amount * $rawMaterial->avg_cost }}</div>--}}
{{--                                        </td>--}}

{{--                                    </tr>--}}
{{--                                    @endforeach--}}
{{--                                    <tr>--}}
{{--                                        <td class="p-2 whitespace-nowrap" colspan="2">--}}
{{--                                            <div class="text-center font-medium text-green-500">Total</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-left font-medium text-green-500">-</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-center font-medium text-green-500">-</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="tbl-amount-result text-center font-medium text-green-500">Amount</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-center font-medium text-green-500">-</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="tbl-total-result text-center font-medium text-green-500">Total</div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}

{{--            <div class="form-group">--}}
{{--                @can('semi_finished_edit')--}}
{{--                    <a href="{{ route('admin.semi-finisheds.edit', $semiFinished) }}" class="btn btn-indigo mr-2">--}}
{{--                        {{ trans('global.edit') }}--}}
{{--                    </a>--}}
{{--                @endcan--}}
{{--                <a href="{{ route('admin.semi-finisheds.index') }}" class="btn btn-secondary">--}}
{{--                    {{ trans('global.back') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@livewire('semi-finished.show',[$semiFinished])
@endsection
@push('scripts')
    <script>

        // function calc_total(){
        //     var amount_sum = 0;
        //     var total_sum = 0;
        //     jQuery(".tbl-amount").each(function(){
        //         amount_sum += parseFloat(jQuery(this).text());
        //     });
        //     jQuery('.tbl-amount-result').text(amount_sum);
        //
        //     jQuery(".tbl-total").each(function(){
        //         total_sum += parseFloat(jQuery(this).text());
        //     });
        //     jQuery('.tbl-total-result').text(total_sum);
        // }
        //
        // jQuery(document).ready(function () {
        //     calc_total();
        // })
    </script>
@endpush
