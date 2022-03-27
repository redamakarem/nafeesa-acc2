<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('raw_material_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="RawMaterial" format="csv" />
                <livewire:excel-export model="RawMaterial" format="xlsx" />
                <livewire:excel-export model="RawMaterial" format="pdf" />
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
                        <th>
                            {{ trans('cruds.rawMaterial.fields.code') }}
                            @include('components.table.sort', ['field' => 'code'])
                        </th>
{{--                        <th class="w-28">--}}
{{--                            {{ trans('cruds.rawMaterial.fields.id') }}--}}
{{--                            @include('components.table.sort', ['field' => 'id'])--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.rawMaterial.fields.name_en') }}
                            @include('components.table.sort', ['field' => 'name_en'])
                        </th>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.name_ar') }}
                            @include('components.table.sort', ['field' => 'name_ar'])
                        </th>

{{--                        <th>--}}
{{--                            {{ trans('cruds.rawMaterial.fields.product_code') }}--}}
{{--                            @include('components.table.sort', ['field' => 'product_code'])--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.rawMaterial.fields.avg_cost') }}
                            @include('components.table.sort', ['field' => 'avg_cost'])
                        </th>
                        <th>
                            {{ trans('cruds.rawMaterial.fields.unit') }}
                            @include('components.table.sort', ['field' => 'unit.name_en'])
                        </th><th>
                            {{ trans('cruds.rawMaterial.fields.updated_at') }}
                            @include('components.table.sort', ['field' => 'updated_at'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rawMaterials as $rawMaterial)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $rawMaterial->id }}" wire:model="selected">
                            </td>
{{--                            <td>--}}
{{--                                {{ $rawMaterial->id }}--}}
{{--                            </td>--}}
                            <td>
                                {{ $rawMaterial->code }}
                            </td>
                            <td>
                                {{ $rawMaterial->name_en }}
                            </td>
                            <td>
                                {{ $rawMaterial->name_ar }}
                            </td>

{{--                            <td>--}}
{{--                                {{ $rawMaterial->product_code }}--}}
{{--                            </td>--}}
                            <td>
                                {{ $rawMaterial->avg_cost }}
                            </td>
                            <td>
                                @if($rawMaterial->unit)
                                    <span class="badge badge-relationship">{{ $rawMaterial->unit->name_en ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $rawMaterial->updated_at }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('raw_material_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.raw-materials.show', $rawMaterial) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('raw_material_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.raw-materials.edit', $rawMaterial) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('raw_material_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $rawMaterial->id }})" wire:loading.attr="disabled">
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
            {{ $rawMaterials->links() }}
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
