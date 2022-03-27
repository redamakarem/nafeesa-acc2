<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('fixedAsset.title_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="title_en">{{ trans('cruds.fixedAsset.fields.title_en') }}</label>
        <input class="form-control" type="text" name="title_en" id="title_en" required wire:model.defer="fixedAsset.title_en">
        <div class="validation-message">
            {{ $errors->first('fixedAsset.title_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.fixedAsset.fields.title_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('fixedAsset.title_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="title_ar">{{ trans('cruds.fixedAsset.fields.title_ar') }}</label>
        <input class="form-control" type="text" name="title_ar" id="title_ar" required wire:model.defer="fixedAsset.title_ar">
        <div class="validation-message">
            {{ $errors->first('fixedAsset.title_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.fixedAsset.fields.title_ar_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branches') ? 'invalid' : '' }}">
        <label class="form-label required" for="branches">{{ trans('cruds.fixedAsset.fields.branches') }}</label>
        <x-select-list class="form-control" required id="branches" name="branches" wire:model="branches" :options="$this->listsForFields['branches']" multiple />
        <div class="validation-message">
            {{ $errors->first('branches') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.fixedAsset.fields.branches_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.fixed-assets.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
