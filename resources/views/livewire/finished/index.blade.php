<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('finished_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Finished" format="csv" />
                <livewire:excel-export model="Finished" format="xlsx" />
                <livewire:excel-export model="Finished" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
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
                        <th class="w-28">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.finished.fields.item_code') }}
                            @include('components.table.sort', ['field' => 'item_code'])
                        </th>
                        <th>
                            {{ trans('cruds.finished.fields.name_en') }}
                            @include('components.table.sort', ['field' => 'name_en'])
                        </th>
                        <th>
                            {{ trans('cruds.finished.fields.name_ar') }}
                            @include('components.table.sort', ['field' => 'name_ar'])
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.finished.fields.labour_time') }}--}}
{{--                            @include('components.table.sort', ['field' => 'labour_time'])--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.finished.costs') }}
                        </th>
                        <th>
                            {{ trans('cruds.finished.fields.sale_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.unit.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.finished.fields.kilos_per_dough') }}
                            @include('components.table.sort', ['field' => 'kilos_per_dough'])
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.finished.fields.raw_materials') }}--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.finished.fields.semi_finished') }}--}}
{{--                        </th>--}}
{{--                        <th>--}}
{{--                            {{ trans('cruds.finished.fields.labor') }}--}}
{{--                        </th>--}}
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($finisheds as $finished)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $finished->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $finished->item_code }}
                            </td>
                            <td>
                                {{ $finished->name_en }}
                            </td>
                            <td>
                                {{ $finished->name_ar }}
                            </td>
{{--                            <td>--}}
{{--                                {{ $finished->labour_time }}--}}
{{--                            </td>--}}
                            <td>
                                {{ number_format($finished->finals_total,3) }}
                            </td>
                            <td>
                                {{ $finished->sale_price }}
                            </td>
                            <td>
                                <span class="badge badge-relationship">{{ $finished->unit->name_en }}</span>
                            </td>
                            <td>
                                {{ $finished->kilos_per_dough }}
                            </td>
{{--                            <td>--}}
{{--                                @foreach($finished->rawMaterials as $key => $entry)--}}
{{--                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                @foreach($finished->semiFinished as $key => $entry)--}}
{{--                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                {{$finished->cost_per_unit}}--}}
{{--                            </td>--}}
                            <td>
                                <div class="flex justify-end">
                                    @can('finished_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.finisheds.show', $finished) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('finished_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.finisheds.edit', $finished) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('finished_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $finished->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                    @can('finished_edit')
                                    <a class="btn btn-sm bg-black text-white mr-2" href="{{ route('admin.finished.update-costs', $finished->id) }}">
                                        Costs
                                    </a>
                                @endcan
                                    @can('finished_edit')
                                    <a class="btn btn-sm bg-black text-white mr-2" href="{{ route('admin.finished.edit-new', $finished->id) }}">
                                        NE
                                    </a>
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
            {{ $finisheds->links() }}
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
