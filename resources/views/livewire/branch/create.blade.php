<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('branch.title_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="title_en">{{ trans('cruds.branch.fields.title_en') }}</label>
        <input class="form-control" type="text" name="title_en" id="title_en" required wire:model.defer="branch.title_en">
        <div class="validation-message">
            {{ $errors->first('branch.title_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branch.fields.title_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branch.title_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="title_ar">{{ trans('cruds.branch.fields.title_ar') }}</label>
        <input class="form-control" type="text" name="title_ar" id="title_ar" required wire:model.defer="branch.title_ar">
        <div class="validation-message">
            {{ $errors->first('branch.title_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branch.fields.title_ar_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branch.shifts') ? 'invalid' : '' }}">
        <label class="form-label required" for="shifts">{{ trans('cruds.branch.fields.shifts') }}</label>
        <input class="form-control" type="number" name="shifts" id="shifts" required wire:model.defer="branch.shifts" step="1">
        <div class="validation-message">
            {{ $errors->first('branch.shifts') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branch.fields.shifts_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branch.labor_count') ? 'invalid' : '' }}">
        <label class="form-label" for="labor_count">{{ trans('cruds.branch.fields.labor_count') }}</label>
        <input class="form-control" type="number" name="labor_count" id="labor_count" wire:model.defer="branch.labor_count" step="1">
        <div class="validation-message">
            {{ $errors->first('branch.labor_count') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branch.fields.labor_count_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branch.total_manhours') ? 'invalid' : '' }}">
        <label class="form-label" for="total_manhours">{{ trans('cruds.branch.fields.total_manhours') }}</label>
        <input class="form-control" type="number" name="total_manhours" id="total_manhours" wire:model.defer="branch.total_manhours" step="1">
        <div class="validation-message">
            {{ $errors->first('branch.total_manhours') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branch.fields.total_manhours_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.branches.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
