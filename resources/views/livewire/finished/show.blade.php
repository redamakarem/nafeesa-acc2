<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.finished.title_singular') }}:
                    {{ trans('cruds.finished.fields.id') }}
                    {{ $finished->item_code }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <div class="flex">
                    <div class="w-1/2">
                        <table class="table table-view">
                            <tbody class="bg-white">
                            @if($finished->getFirstMediaUrl('finished_images')!=null)
                            <tr>
                                <th>
                                    Image
                                </th>
                                <td>
                                    <img src="{{$finished->getFirstMediaUrl('finished_images')}}" alt="">
                                </td>
                            </tr>
                            <tr>
                                @endif
                                <th>
                                    {{ trans('cruds.finished.fields.id') }}
                                </th>
                                <td>
                                    {{ $finished->item_code }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.name_en') }}
                                </th>
                                <td>
                                    {{ $finished->name_en }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.name_ar') }}
                                </th>
                                <td>
                                    {{ $finished->name_ar }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.labour_time') }}
                                </th>
                                <td>
                                    {{ $finished->total_labor_hours }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.kilos_per_dough') }}
                                </th>
                                <td>
                                    {{ $finished->kilos_per_dough }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.raw_materials') }}
                                </th>
                                <td>
                                    @foreach($finished->rawMaterials as $key => $entry)
                                        <span class="badge badge-relationship">{{ $entry->name_en }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.semi_finished') }}
                                </th>
                                <td>
                                    @foreach($finished->semiFinished as $key => $entry)
                                        <span class="badge badge-relationship">{{ $entry->name_en }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.finished.fields.labor') }}
                                </th>
                                <td>
                                    @foreach($finished->labor as $key => $entry)
                                        <span class="badge badge-relationship">{{ $entry->title_en }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Inputs per KG
                                </th>
                                <td>
                                    {{ $finished->inputs_per_kg }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Outputs per KG
                                </th>
                                <td>
                                    {{ $finished->outputs_per_kg }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Production loss percentage
                                </th>
                                <td>
                                    {{ $finished->production_loss_percentage }} %
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Cost per KG
                                </th>
                                <td>
                                    {{ $finished->cost_per_kg }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Production Per Hour
                                </th>
                                <td>
                                    {{ $finished->production_per_hour }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
{{--                    <div class="w-1/2 flex justify-content-center">--}}
{{--                        <div class="flex flex-col justify-center w-48">--}}
{{--                            <img class="" src="{{$finished->getFirstMediaUrl('finished_images')}}" alt="">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

        @if($finished->rawMaterials->count() >0)
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
                                        @foreach($finished->rawMaterials as $key=>$rawMaterial)
                                            <tr>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left"><a href="{{route('admin.raw-materials.show',$rawMaterial)}}">{{$rawMaterial->code}}</a></div>
                                                </td>
                                                {{--                                            <td class="p-2 whitespace-nowrap">--}}
                                                {{--                                                <div class="text-left">{{$rawMaterial->product_code}}</div>--}}
                                                {{--                                            </td>--}}
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">{{$rawMaterial->name_en}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-center font-medium text-green-500">{{$rawMaterial->unit->name_en}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="tbl-amount text-center font-medium text-green-500">{{$rawMaterial->pivot->amount}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-center font-medium text-green-500">{{$rawMaterial->avg_cost}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="tbl-total text-center font-medium text-green-500">{{$rawMaterial->pivot->amount * $rawMaterial->avg_cost }}</div>
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
                                                <div class="tbl-total-result text-center font-medium text-green-500">{{$finished->totalRawMaterialsCost}}</div>
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


            @if($finished->semiFinished->count() >0)
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
                                                <div class="font-semibold text-left">Cost Per Unit</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Quantity</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Quantity Cost</div>
                                            </th>
{{--                                            <th class="p-2 whitespace-nowrap">--}}
{{--                                                <div class="font-semibold text-left">AMOH</div>--}}
{{--                                            </th>--}}


                                        </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                        @foreach($finished->semiFinished as $key=>$semi)
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
                                                    <div class="text-left">{{$semi->new_total_cost}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->pivot->amount}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$semi->quantity_cost}}</div>
                                                </td>
{{--                                                <td class="p-2 whitespace-nowrap">--}}
{{--                                                    <div class="text-left">{{$semi->shared_costs}}</div>--}}
{{--                                                </td>--}}

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
                                                <div class="text-left font-medium text-green-500">{{$finished->semi_finished_quantity_total}}</div>
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

            @if($finished->labor->count() >0)
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
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Total Cost</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Hourly Rate</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Labor Time</div>
                                            </th>
                                            <th class="p-2 whitespace-nowrap">
                                                <div class="font-semibold text-left">Labor Cost</div>
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                        @foreach($finished->labor as $key=>$labor)
                                            <tr>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$labor->title_en}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$labor->title_ar}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left">{{$labor->pivot->workers}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">{{$labor->total_cost}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">{{$labor->cost_per_hour}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">{{$labor->pivot->labor_time}}</div>
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <div class="text-left font-medium text-green-500">{{$labor->pivot->labor_time * $labor->cost_per_hour}}</div>
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
                                                <div class="text-left font-medium text-green-500">{{$finished->salaries_total}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500">-</div>
                                            </td>
                                            {{--                                        <td class="p-2 whitespace-nowrap">--}}
                                            {{--                                            <div class="text-left font-medium text-green-500">-</div>--}}
                                            {{--                                        </td>--}}
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500">{{$finished->labor->sum('pivot.labor_time')}}</div>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <div class="text-left font-medium text-green-500">{{$finished->labor_costs}}</div>
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
                                            <div class="text-left">Freight</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->freight}}</div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Loyalty</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->loyalty}}</div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Transport</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->transport}}</div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Other</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->other}}</div>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">Total</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->total_related_costs}}</div>
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
                                            <div class="font-semibold text-left">Related Costs</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Total</div>
                                        </th>
                                        <th class="p-2 whitespace-nowrap">
                                            <div class="font-semibold text-left">Cost Per Unit</div>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-gray-100">
                                    <tr>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->total_raw_materials_cost}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->labor_costs}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->semi_finished_quantity_total}}</div>
                                        </td>

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->shared_costs}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->total_related_costs}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->finals_total}}</div>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-left">{{$finished->cost_per_unit}}</div>
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
                @can('finished_edit')
                    <a href="{{ route('admin.finisheds.edit', $finished) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.finisheds.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
