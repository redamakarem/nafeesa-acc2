<div>
    <div class="card-controls">
        <div class="w-full">
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">From Date</label>
                <x-date-picker class="form-control" required wire:model="selected_dates" id="selected_dates" name="selected_dates" picker="date" mode="multiple" />
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">Items</label>
                <x-select-list class="form-control" id="finished_filters" name="finished_filters" wire:model="finished_filters" :options="$this->listsForFields['finished']" multiple />
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
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
                        </th>
                        <th>
                            {{ trans('cruds.sale.fields.item') }}
                        </th>
                        @foreach ($da as $item)
                            <th>{{$item}}</th>
                        @endforeach
                        
                        
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    @if ($sale->pps_count($start_date,$end_date)>0)
                        
                    
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
                            
                            @foreach ($da as $item)
                            <td>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Q</th>
                                        <th>S</th>
                                        <th>C</th>
                                        <th>P</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $sale->pps_count($item,$item) }}</td>
                                        <td>{{ $sale->pps_sales($item,$item) }}</td>
                                        <td>{{ number_format((($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($item,$item)) + 
                                            (($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($item,$item)) +
                                            (($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($item,$item)) + 
                                            (($sale->shared_costs * $sale->pps_count($item,$item)) + 
                                            ($sale->total_related_costs * $sale->pps_count($item,$item)) ), 3) }}</td>
                                            <td>{{ number_format($sale->pps_sales($item,$item) - ($sale->cost_per_unit * $sale->pps_count($item,$item)), 3) }}</td>
                                    </tr>
                                </thead>
                            </table>
                        </td>
                                {{-- <p>Q:{{ $sale->pps_count($item,$item) }}</p>
                                <p>S:{{ $sale->pps_sales($item,$item) }}</p>
                                <p>C:{{ number_format((($sale->total_raw_materials_cost / $sale->kilos_per_dough) * $sale->pps_count($item,$item)) + 
                                    (($sale->labor_costs / $sale->kilos_per_dough) * $sale->pps_count($item,$item)) +
                                    (($sale->semi_finished_quantity_total / $sale->kilos_per_dough) * $sale->pps_count($item,$item)) + 
                                    (($sale->shared_costs * $sale->pps_count($item,$item)) + 
                                    ($sale->total_related_costs * $sale->pps_count($item,$item)) ), 3) }}</p>
                                    <p>P: {{ number_format($sale->pps_sales($item,$item) - ($sale->cost_per_unit * $sale->pps_count($item,$item)), 3) }}</p> --}}
                            
                        @endforeach

                    
                            
                            
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
                        @endif
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