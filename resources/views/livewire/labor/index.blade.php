<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('labor_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Labor" format="csv" />
                <livewire:excel-export model="Labor" format="xlsx" />
                <livewire:excel-export model="Labor" format="pdf" />
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
                        {{ trans('cruds.labor.fields.id') }}
                        @include('components.table.sort', ['field' => 'id'])
                    </th>
                    <th>
                        {{ trans('cruds.labor.fields.title_en') }}
                        @include('components.table.sort', ['field' => 'title_en'])
                    </th>
                    <th>
                        {{ trans('cruds.labor.fields.title_ar') }}
                        @include('components.table.sort', ['field' => 'title_ar'])
                    </th>
                    <th>
                        {{ trans('cruds.labor.fields.basic_salary') }}
                        @include('components.table.sort', ['field' => 'basic_salary'])
                    </th>
                    <th>
                        {{ trans('cruds.labor.fields.total_cost') }}
                        @include('components.table.sort', ['field' => 'total_cost'])
                    </th>
                    <th>
                        {{ trans('cruds.labor.fields.hourly_rate') }}
                        @include('components.table.sort', ['field' => 'hourly_rate'])
                    </th>
                    <th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($labors as $labor)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $labor->id }}" wire:model="selected">
                        </td>
                        <td>
                            {{ $labor->id }}
                        </td>
                        <td>
                            {{ $labor->title_en }}
                        </td>
                        <td>
                            {{ $labor->title_ar }}
                        </td>
                        <td>
                            {{ $labor->basic_salary }}
                        </td>
                        <td>
                            {{ $labor->total_cost }}
                        </td>
                        <td>
                            {{ $labor->cost_per_hour }}
                        </td>
                        <td>
                            <div class="flex justify-end">
                                @can('labor_show')
                                    <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.labors.show', $labor) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('labor_edit')
                                    <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.labors.edit', $labor) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('labor_delete')
                                    <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $labor->id }})" wire:loading.attr="disabled">
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
            {{ $labors->links() }}
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
