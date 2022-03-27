<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('unit.name_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.unit.fields.name_en') }}</label>
        <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="unit.name_en">
        <div class="validation-message">
            {{ $errors->first('unit.name_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.unit.fields.name_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('unit.name_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_ar">{{ trans('cruds.unit.fields.name_ar') }}</label>
        <input class="form-control" type="text" name="name_ar" id="name_ar" required wire:model.defer="unit.name_ar">
        <div class="validation-message">
            {{ $errors->first('unit.name_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.unit.fields.name_ar_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.units.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>