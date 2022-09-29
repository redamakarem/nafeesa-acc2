<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.semiFinished.title_singular') }}:
                    {{ trans('cruds.semiFinished.fields.id') }}
                    {{ $semiFinished->item_code }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                    <tr>
                        <th>
                            {{ trans('cruds.semiFinished.fields.id') }}
                        </th>
                        <td>
                            {{ $semiFinished->item_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.semiFinished.fields.name_en') }}
                        </th>
                        <td>
                            {{ $semiFinished->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.semiFinished.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $semiFinished->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.semiFinished.fields.raw_materials') }}
                        </th>
                        <td>
                            @foreach($semiFinished->rawMaterials as $key => $entry)
                                <span class="badge badge-relationship">{{ $entry->name_en }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.semiFinished.fields.semi_finished') }}
                        </th>
                        <td>
                            @foreach($semiFinished->semiFinished as $key => $entry)
                                <span class="badge badge-relationship">{{ $entry->name_en }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.semiFinished.fields.kilos_per_dough') }}
                        </th>
                        <td>
                            {{ number_format($semiFinished->kilos_per_dough,3) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Inputs per KG
                        </th>
                        <td>
                            {{ number_format($semiFinished->inputs_per_kg,3) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Outputs per KG
                        </th>
                        <td>
                            {{ number_format($semiFinished->outputs_per_kg,3) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Production loss percentage
                        </th>
                        <td>
                            {{ number_format($semiFinished->production_loss_percentage,1) }} %
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Cost per KG
                        </th>
                        <td>
                            {{ number_format($semiFinished->cost_per_kg,3) }}
                        </td>
                    </tr>
{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            Production Per Hour--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            {{ $semiFinished->production_per_hour }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    <tr>
                        <th>
                            Factory Salaries
                        </th>
                        <td>
                            {{ number_format($semiFinished->factorySalariesCost,3) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Factory Unit Cost
                        </th>
                        <td>
                            {{ number_format($semiFinished->factoryUnitCosts,3) }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            New Total
                        </th>
                        <td>
                            {{ number_format( $semiFinished->finals_total/$semiFinished->kilos_per_dough,3 ) }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>




            @if($semiFinished->rawMaterials->count() >0)
            <!-- component -->
            <section class="antialiased bg-gray-100 text-gray-600 px-4 pt-8">
                <div class="flex flex-col justify-center">
                    <!-- Table -->
                    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Raw Materials</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Code</div>
                                        </th>
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-left">Product Code</div>--}}
{{--                                        </th>--}}
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Name</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">Unit</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">Quantity</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">Avg Cost</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-center">Total Cost</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                    @foreach($semiFinished->rawMaterials as $key=>$rawMaterial)
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500"><a href="{{route('admin.raw-materials.show',$rawMaterial)}}">{{$rawMaterial->code}}</a></div>
                                            </td>
{{--                                            <td class="p-2 whitespace-nowrap">--}}
{{--                                                <div class="text-left">{{$rawMaterial->product_code}}</div>--}}
{{--                                            </td>--}}
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{$rawMaterial->name_en}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-center">{{$rawMaterial->unit->name_en}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="tbl-amount text-center">{{$rawMaterial->pivot->amount}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-center">{{$rawMaterial->avg_cost}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="tbl-total text-center">{{$rawMaterial->pivot->amount * $rawMaterial->avg_cost }}</div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="p-2 whitespace-nowrap" colspan="2">
                                            <div class="text-center font-medium text-green-500">Total</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-green-500">-</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="tbl-amount-result text-center font-medium text-green-500">-</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-center font-medium text-green-500">-</div>
                                        </td>
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-center font-medium text-green-500">-</div>--}}
{{--                                        </td>--}}
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="tbl-total-result text-center font-medium text-green-500">{{$semiFinished->totalRawMaterialsCost}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                @endif

            {{--            Semi Finished--}}
            @if($semiFinished->semiFinished->count() >0)
                <section class="antialiased bg-gray-100 text-gray-600 px-4 pt-8">
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                            <header class="px-5 py-4 border-b border-gray-100">
                                <h2 class="font-semibold text-gray-800">Semi Finished</h2>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full">
                                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                        <tr>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Code</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">English Title</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Arabic Title</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Quantity</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Cost per unit</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Quantity Cost</div>
                                            </th>



                                        </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                        @foreach($semiFinished->semiFinished as $key=>$semi)
                                            <tr>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500"><a href="{{route('admin.semi-finisheds.show',$semi)}}">{{$semi->item_code}}</a></div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->name_en}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->name_ar}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->pivot->amount}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->new_total_cost}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->new_total_cost * $semi->pivot->amount}}</div>
                                                </td>


                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="p-2 whitespace-nowrap" colspan="3">
                                                <div class="text-center font-medium text-green-500">Total</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500">-</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500">-</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500">{{$semiFinished->semi_finished_quantity_total}}</div>
                                            </td>



                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            @endif

{{--Labors Section--}}

            @if($semiFinished->labor->count() >0)
            <section class="antialiased bg-gray-100 text-gray-600 px-4 pt-8">
                <div class="flex flex-col justify-center">
                    <!-- Table -->
                    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Labor</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">English Title</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Arabic Title</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Count</div>
                                        </th>
{{--                                        <th class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="font-semibold text-left">Total Cost</div>--}}
{{--                                        </th>--}}
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Hourly Rate</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Total Labor Time</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Labor Cost</div>
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                    @foreach($semiFinished->labor as $key=>$labor)
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left"><a href="{{route('admin.labors.show',$labor)}}">{{$labor->title_en}}</a></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left"><a href="{{route('admin.labors.show',$labor)}}">{{$labor->title_ar}}</a></div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{$labor->pivot->workers}}</div>
                                            </td>
{{--                                            <td class="p-2 whitespace-nowrap">--}}
{{--                                                <div class="text-left font-medium text-green-500">{{$labor->total_cost}}</div>--}}
{{--                                            </td>--}}
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{$labor->cost_per_hour}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{$labor->total_labor_time}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{$labor->labor_cost}}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="p-2 whitespace-nowrap" colspan="2">
                                            <div class="text-center font-medium text-green-500">Total</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-green-500">-</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-green-500">-</div>
                                        </td>
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-left font-medium text-green-500">-</div>--}}
{{--                                        </td>--}}
{{--                                        <td class="p-2 whitespace-nowrap">--}}
{{--                                            <div class="text-left font-medium text-green-500">-</div>--}}
{{--                                        </td>--}}
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-green-500">{{$semiFinished->total_labor_time}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left font-medium text-green-500">{{$semiFinished->labor_costs}}</div>
                                        </td>


                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif





            {{--Related Costs--}}
            <section class="antialiased bg-gray-100 text-gray-600 px-4 pt-8">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Related Costs</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Title</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Amount</div>
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Transport</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$semiFinished->transport}}</div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Other</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$semiFinished->other}}</div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Total</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$semiFinished->total_related_costs}}</div>
                                        </td>


                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{--Final calculations--}}
            <section class="antialiased bg-gray-100 text-gray-600 px-4 pt-8">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        <header class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-800">Final calculations</h2>
                        </header>
                        <div class="p-3">
                            <div class="overflow-x-auto">
                                <table class="table-auto w-full">
                                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Raw Materials</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Labor</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Semi Finished</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">AMOH</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Total</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                        <tr>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{number_format($semiFinished->total_raw_materials_cost,3)}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{number_format($semiFinished->labor_costs,3)}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{number_format($semiFinished->semi_finished_quantity_total,3)}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{number_format($semiFinished->shared_costs,3)}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left">{{number_format($semiFinished->finals_total,3)}}</div>
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="form-group">
                @can('semi_finished_edit')
                    <a href="{{ route('admin.semi-finisheds.edit', $semiFinished) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.semi-finisheds.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>


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

