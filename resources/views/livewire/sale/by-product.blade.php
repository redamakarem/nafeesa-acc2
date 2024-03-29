<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach ($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('sale_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button"
                    wire:click="confirm('deleteSelected')" wire:loading.attr="disabled"
                    {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if (file_exists(app_path('Http/Livewire/ExcelExport.php')))
                {{-- <livewire:excel-export model="Sale" format="csv" /> --}}
                {{-- <livewire:excel-export model="Sale" format="xlsx" /> --}}
                <button wire:click="export" class="btn btn-secondary disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled">
                    <i wire:loading class="fas fa-spinner fa-spin"></i>
                    Export
                </button>
                {{-- <livewire:excel-export model="Sale" format="pdf" /> --}}
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>

    <div class="card-controls">
        <div class="w-full">
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">From Date</label>
                <x-date-picker class="form-control" required wire:model="start_date" id="start_date" name="date"
                    picker="date" mode="single"/>
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">To Date</label>
                <x-date-picker class="form-control" required wire:model="end_date" id="end_date" name="date"
                    picker="date" mode="single"/>
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
            </div>
            <div class="form-group">
                <button wire:click="test">TEST</button>
            </div>
        </div>
    </div>



    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="">
                            Item ID
                            @include('components.table.sort', ['field' => 'item_id'])
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.item') }}
                            @include('components.table.sort', ['field' => 'item.name_en'])
                        </th>
                        <th>
                            Unit
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.qty') }}
                            @include('components.table.sort', ['field' => 'qty'])
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.costs') }}
                            @include('components.table.sort', ['field' => 'costs'])
                        </th>
                        <th>RM</th>
                        <th>LB</th>
                        <th>SF</th>
                        <th>MO</th>
                        <th>RC</th>
                        <th>
                            {{ trans('cruds.sale.fields.sale_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.profit') }}
                            @include('components.table.sort', ['field' => 'profit'])
                        </th>
                        
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    {{-- @if ($sale->pps_count($start_date,$end_date)>0) --}}
                        
                    
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $sale->id }}" wire:model="selected">
                            </td>
                            <td>
                                <a
                                    href="{{ route('admin.finisheds.show', $sale->id) }}">{{ $sale->item_code }}</a>
                            </td>
                            <td>
                                @if ($sale)
                                    <span class="badge badge-relationship">{{ $sale->name_en ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($sale->unit)
                                    <span class="badge badge-relationship">{{ $sale->unit->name_en ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $sale->pps_count($start_date,$end_date) }}
                            </td>
                            <td>


                                <div x-data="{ open: false }">
                                    <button class="badge badge-relationship"
                                        @click="open = true">{{ number_format((($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date)) + 
                                           (($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date)) +
                                           (($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date)) + 
                                           (($sale->shared_costs * $sale->pps_count($start_date,$end_date)) + 
                                           ($sale->total_related_costs * $sale->pps_count($start_date,$end_date)) ), 3) }}</button>

                                    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center"
                                        style="background-color: rgba(0,0,0,.5);" x-show="open">
                                        <div class="text-left bg-white h-auto p-4 md:max-w-xl md:p-6 lg:p-8 shadow-xl rounded mx-2 md:mx-0"
                                            @click.away="open = false">
                                            <h2 class="text-2xl">Costs Details</h2>
                                            <ul class="list-decimal m-4">
                                                <li>Raw Materials:
                                                    {{ number_format(($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date),3) }}
                                                </li>
                                                <li>Labor:
                                                    {{ number_format(($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date),3) }}
                                                </li>
                                                <li>Semi Finished:
                                                    {{ number_format(($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date),3) }}
                                                </li>
                                                <li>AMOH: {{ number_format($sale->shared_costs * $sale->pps_count($start_date,$end_date),3) }}</li>
                                                <li>Related Costs:
                                                    {{ number_format($sale->total_related_costs * $sale->pps_count($start_date,$end_date),3) }}</li>
                                            </ul>
                                            <div class="flex justify-center mt-8">
                                                <button
                                                    class="bg-gray-700 text-white px-4 py-2 rounded no-outline focus:shadow-outline select-none"
                                                    @click="open = false">Close</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>




                            </td>
                            <td>{{ number_format(($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date),3) }}</td>
                            <td>{{ number_format(($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date),3) }}</td>
                            <td>{{ number_format(($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($start_date,$end_date),3) }}</td>
                            <td>{{ number_format($sale->shared_costs * $sale->pps_count($start_date,$end_date),3) }}</td>
                            <td>{{ number_format($sale->total_related_costs * $sale->pps_count($start_date,$end_date),3) }}</td>
                             <td>
                                {{ $sale->pps_sales($start_date,$end_date) }}
                            </td>
                            <td>
                                {{ number_format($sale->pps_sales($start_date,$end_date) - ($sale->cost_per_unit * $sale->pps_count($start_date,$end_date)), 3) }}
                            </td> 
                            
                            {{-- <td>
                            <div class="flex justify-end">
                                @can('sale_show')
                                    <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.sales.show', $sale) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('sale_edit')
                                    <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.sales.edit', $sale) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('sale_delete')
                                    <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $sale->id }})" wire:loading.attr="disabled">
                                        {{ trans('global.delete') }}
                                    </button>
                                @endcan
                            </div>
                        </td> --}}
                        </tr>
                        {{-- @endif --}}
                    @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if ($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $sales->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
            if (!confirm("{{ trans('global.areYouSure') }}")) {
                return
            }
            @this[e.callback](...e.argv)
        })
    </script>
@endpush
