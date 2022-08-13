<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('sale_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
{{--                <livewire:excel-export model="Sale" format="csv" />--}}
{{--                <livewire:excel-export model="Sale" format="xlsx" />--}}
                <button wire:click="export" class="btn btn-secondary disabled:opacity-50 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                    <i wire:loading class="fas fa-spinner fa-spin"></i>
                    Export
                </button>
{{--                <livewire:excel-export model="Sale" format="pdf" />--}}
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>


    {{-- <div class="card-controls">
        <div class="w-full">
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">From Date</label>
                <x-date-picker class="form-control" required wire:model="start_date" id="start_date" name="date" picker="date" />
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">To Date</label>
                <x-date-picker class="form-control" required wire:model="end_date" id="end_date" name="date" picker="date" />
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">Branches</label>
                <x-select-list class="form-control" id="branch_filters" name="branch_filters" wire:model="branch_filters" :options="$this->listsForFields['branch_filters']" multiple />
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
            <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
                <label class="form-label required" for="date">Weekday</label>
                <x-select-list class="form-control" id="weekday_filters" name="weekday_filters" wire:model="weekday_filters" :options="$this->listsForFields['weekdays']" multiple />
                <div class="validation-message">
                    {{ $errors->first('sale.date') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.sale.fields.date_helper') }}
                </div>
            </div>
            <div class="form-group">
                <label class="form-label required" for="from_id">From ID</label>
                <input type="text" id="from_id" wire:model.defer="from_id">
            </div>
            <div class="form-group">
                <label class="form-label required" for="date">To ID</label>
                <input type="text" id="to_id" wire:model.defer="to_id">
            </div>
            <div class="form-group">
                <label class="form-label required" for="date">Total Sales</label>
                <div>{{$total_sales}}</div>
            </div>
            <div class="form-group">
                <label class="form-label required" for="date">Total Costs</label>
                <div>{{$total_costs}}</div>
            </div>
            <div class="form-group">
                <label class="form-label required" for="date">Total Profit</label>
                <div>{{$total_profit}}</div>
            </div>
        </div>
    </div> --}}

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
                        {{ trans('cruds.sale.fields.qty') }}
                        @include('components.table.sort', ['field' => 'qty'])
                    </th>
                    <th>
                        {{ trans('cruds.sale.fields.costs') }}
                        @include('components.table.sort', ['field' => 'costs'])
                    </th>
                    <th>
                        {{ trans('cruds.sale.fields.sale_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.sale.fields.profit') }}
                        @include('components.table.sort', ['field' => 'profit'])
                    </th>
                    <th>
                        {{ trans('cruds.sale.fields.date') }}
                        @include('components.table.sort', ['field' => 'date'])
                    </th>
                    <th>
                        {{ trans('cruds.sale.fields.branch') }}
                        @include('components.table.sort', ['field' => 'branch.title_en'])
                    </th>
                    <th>
                        {{ trans('cruds.sale.fields.transaction_type') }}
                        @include('components.table.sort', ['field' => 'transaction_type.name_en'])
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($others as $other)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $other->id }}" wire:model="selected">
                        </td>
                        <td>
                            <a href="{{route('admin.finisheds.show',$other->item->id)}}">{{ $other->item->item_code }}</a>
                        </td>
                        <td>
                            @if($other->item)
                                <span class="badge badge-relationship">{{ $other->item->name_en ?? '' }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $other->qty }}
                        </td>
                        <td>
                            <div x-data="{ open: false }">
                                <button class="badge badge-relationship" @click="open = true">{{ number_format($other->costs,3) }}</button>

                                <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center" style="background-color: rgba(0,0,0,.5);" x-show="open">
                                    <div class="text-left bg-white h-auto p-4 md:max-w-xl md:p-6 lg:p-8 shadow-xl rounded mx-2 md:mx-0" @click.away="open = false">
                                        <h2 class="text-2xl">Costs Details</h2>
                                        <ul class="list-decimal m-4">
                                            <li>Raw Materials: {{($other->item->total_raw_materials_cost/$other->item->kilos_per_dough) * $other->qty}}</li>
                                            <li>Labor: {{($other->item->labor_costs/$other->item->kilos_per_dough) * $other->qty}}</li>
                                            <li>Semi Finished: {{($other->item->semi_finished_quantity_total/$other->item->kilos_per_dough) * $other->qty}}</li>
                                            <li>AMOH: {{$other->item->shared_costs}}</li>
                                            <li>Related Costs: {{$other->item->total_related_costs}}</li>
                                        </ul>
                                        <div class="flex justify-center mt-8">
                                            <button class="bg-gray-700 text-white px-4 py-2 rounded no-outline focus:shadow-outline select-none" @click="open = false">Close</button>
                                        </div>
                                    </div>
                                </div>


                            </div>




                        </td>
                        <td>
                            {{ number_format($other->selling_price,3) }}
                        </td>
                        <td>
                            {{ number_format($other->profit,3) }}
                        </td>
                        <td>
                            {{ $other->date }}
                        </td>
                        <td>
                            @if($other->branch)
                                <span class="badge badge-relationship">{{ $other->branch->title_en ?? '' }}</span>
                            @endif
                        </td>
                        <td>
                            @if($other->transaction_type)
                                <span class="badge badge-relationship">{{ $other->type->name_en ?? '' }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex justify-end">
                                @can('sale_show')
                                    <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.sales.show', $other) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('sale_edit')
                                    <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.sales.edit', $other) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('sale_delete')
                                    <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $other->id }})" wire:loading.attr="disabled">
                                        {{ trans('global.delete') }}
                                    </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
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
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $others->links() }}
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
