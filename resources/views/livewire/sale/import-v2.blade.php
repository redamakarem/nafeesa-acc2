<form wire:submit.prevent="submit" class="pt-3">
    <div class="form-group">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </div>
    
   
    <div class="form-group {{ $errors->has('selected_date') ? 'invalid' : '' }}">
        <label class="form-label required" for="date">{{ trans('cruds.sale.fields.date') }}</label>
        <x-date-picker class="form-control" required wire:model="selected_date" id="date" name="date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('selected_date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('selected_branch') ? 'invalid' : '' }}">
        <label class="form-label required" for="branch">{{ trans('cruds.sale.fields.branch') }}</label>
        <x-select-list class="form-control" required id="branch" name="branch" :options="$this->branches" wire:model="selected_branch" />
        <div class="validation-message">
            {{ $errors->first('selected_branch') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.branch_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.title_en') ? 'invalid' : '' }}">
        <div class="flex">
            <div class="mb-3 w-96">
                <label for="formFile" class="form-label inline-block mb-2 text-gray-700">Sales Import</label>
                <input class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                  rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" wire:model="file">
            </div>
        </div>
        <div wire:loading>

            Processing Import

        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit" wire:loading.attr="disabled">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
