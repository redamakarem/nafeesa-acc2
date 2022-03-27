<form wire:submit.prevent="submit" class="pt-3">
    <div class="form-group" {{$errors->any() ? 'invalid' : ''}}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group {{ $errors->has('rawMaterial.name_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.rawMaterial.fields.name_en') }}</label>
        <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="rawMaterial.name_en">
        <div class="validation-message">
            {{ $errors->first('rawMaterial.name_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.rawMaterial.fields.name_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('rawMaterial.name_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_ar">{{ trans('cruds.rawMaterial.fields.name_ar') }}</label>
        <input class="form-control" type="text" name="name_ar" id="name_ar" required wire:model.defer="rawMaterial.name_ar">
        <div class="validation-message">
            {{ $errors->first('rawMaterial.name_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.rawMaterial.fields.name_ar_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('rawMaterial.code') ? 'invalid' : '' }}">
        <label class="form-label required" for="code">{{ trans('cruds.rawMaterial.fields.code') }}</label>
        <input class="form-control" type="number" name="code" id="code" required wire:model.defer="rawMaterial.code" step="1">
        <div class="validation-message">
            {{ $errors->first('rawMaterial.code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.rawMaterial.fields.code_helper') }}
        </div>
    </div>
{{--    <div class="form-group {{ $errors->has('rawMaterial.product_code') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required" for="product_code">{{ trans('cruds.rawMaterial.fields.product_code') }}</label>--}}
{{--        <input class="form-control" type="text" name="product_code" id="product_code" required wire:model.defer="rawMaterial.product_code">--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('rawMaterial.product_code') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.rawMaterial.fields.product_code_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group {{ $errors->has('rawMaterial.avg_cost') ? 'invalid' : '' }}">
        <label class="form-label required" for="avg_cost">{{ trans('cruds.rawMaterial.fields.avg_cost') }}</label>
        <input class="form-control" type="number" name="avg_cost" id="avg_cost" required wire:model.defer="rawMaterial.avg_cost" step="0.001">
        <div class="validation-message">
            {{ $errors->first('rawMaterial.avg_cost') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.rawMaterial.fields.avg_cost_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('rawMaterial.unit_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="unit">{{ trans('cruds.rawMaterial.fields.unit') }}</label>
        <x-select-list class="form-control" required id="unit" name="unit" :options="$this->listsForFields['unit']" wire:model="rawMaterial.unit_id" />
        <div class="validation-message">
            {{ $errors->first('rawMaterial.unit_id') }}
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
