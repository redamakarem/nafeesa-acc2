<form wire:submit.prevent="submit" class="pt-3">


   
    <div class="form-group {{ $errors->has('loyaltyItem.item_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="unit">{{ trans('cruds.rawMaterial.fields.unit') }}</label>
        <x-select-list class="form-control" required id="unit" name="unit" :options="$this->listsForFields['finished_items']" wire:model="loyaltyItem.item_id" />
        <div class="validation-message">
            {{ $errors->first('loyaltyItem.item_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.rawMaterial.fields.unit_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.raw-materials.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
