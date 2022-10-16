<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('semi_finished_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="SemiFinished" format="csv" />
                <livewire:excel-export model="SemiFinished" format="xlsx" />
                <livewire:excel-export model="SemiFinished" format="pdf" />
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
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.semiFinished.fields.item_code') }}
                            @include('components.table.sort', ['field' => 'item_code'])
                        </th>
                        <th>
                            {{ trans('cruds.semiFinished.fields.name_en') }}
                            @include('components.table.sort', ['field' => 'name_en'])
                        </th>
                        <th>
                            {{ trans('cruds.semiFinished.fields.name_ar') }}
                            @include('components.table.sort', ['field' => 'name_ar'])
                        </th>

                        <th>
                            {{ trans('cruds.unit.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.semiFinished.fields.raw_materials') }}
                        </th>
                        <th>
                            {{ trans('cruds.semiFinished.fields.semi_finished') }}
                        </th>
                        <th>
                            {{ trans('cruds.semiFinished.fields.kilos_per_dough') }}
                            @include('components.table.sort', ['field' => 'kilos_per_dough'])
                        </th>
                        <th>
                            {{ trans('cruds.semiFinished.fields.cost_per_unit') }}
                            @include('components.table.sort', ['field' => 'cost_per_unit'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semiFinisheds as $semiFinished)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $semiFinished->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $semiFinished->item_code }}
                            </td>
                            <td>
                                {{ $semiFinished->name_en }}
                            </td>
                            <td>
                                {{ $semiFinished->name_ar }}
                            </td>
                            <td>
                                <span class="badge badge-relationship">{{ $semiFinished->unit->name_en }}</span>
                            </td>
                            <td>
{{--                                {{dd($semiFinished->rawMaterials())}}--}}
                                @foreach($semiFinished->rawMaterials as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach($semiFinished->semiFinished as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->name_en }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $semiFinished->kilos_per_dough }}
                            </td>
                            <td>
                                KD {{ $semiFinished->finals_total }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('semi_finished_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.semi-finisheds.show', $semiFinished) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('semi_finished_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.semi-finisheds.edit', $semiFinished) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('semi_finished_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $semiFinished->id }})" wire:loading.attr="disabled">
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
            {{ $semiFinisheds->links() }}
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
