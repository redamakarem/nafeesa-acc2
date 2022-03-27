<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('labor.title_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="title_en">{{ trans('cruds.labor.fields.title_en') }}</label>
        <input class="form-control" type="text" name="title_en" id="title_en" required wire:model.defer="labor.title_en">
        <div class="validation-message">
            {{ $errors->first('labor.title_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.title_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.title_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="title_ar">{{ trans('cruds.labor.fields.title_ar') }}</label>
        <input class="form-control" type="text" name="title_ar" id="title_ar" required wire:model.defer="labor.title_ar">
        <div class="validation-message">
            {{ $errors->first('labor.title_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.title_ar_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('labor.basic_salary') ? 'invalid' : '' }}">
        <label class="form-label required" for="basic_salary">{{ trans('cruds.labor.fields.basic_salary') }}</label>
        <input class="form-control" type="number" name="basic_salary" id="basic_salary" required wire:model.defer="labor.basic_salary" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.basic_salary') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.basic_salary_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.allowance') ? 'invalid' : '' }}">
        <label class="form-label" for="allowance">{{ trans('cruds.labor.fields.allowance') }}</label>
        <input class="form-control" type="number" name="allowance" id="allowance" wire:model.defer="labor.allowance" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.allowance') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.allowance_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.indemnity_expenses') ? 'invalid' : '' }}">
        <label class="form-label required" for="indemnity_expenses">{{ trans('cruds.labor.fields.indemnity_expenses') }}</label>
        <input class="form-control" type="number" name="indemnity_expenses" id="indemnity_expenses" required wire:model.defer="labor.indemnity_expenses" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.indemnity_expenses') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.indemnity_expenses_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.leave_expenses') ? 'invalid' : '' }}">
        <label class="form-label required" for="leave_expenses">{{ trans('cruds.labor.fields.leave_expenses') }}</label>
        <input class="form-control" type="number" name="leave_expenses" id="leave_expenses" required wire:model.defer="labor.leave_expenses" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.leave_expenses') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.leave_expenses_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.flat_rent') ? 'invalid' : '' }}">
        <label class="form-label required" for="flat_rent">{{ trans('cruds.labor.fields.flat_rent') }}</label>
        <input class="form-control" type="number" name="flat_rent" id="flat_rent" required wire:model.defer="labor.flat_rent" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.flat_rent') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.flat_rent_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.medical_insurance') ? 'invalid' : '' }}">
        <label class="form-label required" for="medical_insurance">{{ trans('cruds.labor.fields.medical_insurance') }}</label>
        <input class="form-control" type="number" name="medical_insurance" id="medical_insurance" required wire:model.defer="labor.medical_insurance" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.medical_insurance') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.medical_insurance_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.visa_residency') ? 'invalid' : '' }}">
        <label class="form-label required" for="visa_residency">{{ trans('cruds.labor.fields.visa_residency') }}</label>
        <input class="form-control" type="number" name="visa_residency" id="visa_residency" required wire:model.defer="labor.visa_residency" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.visa_residency') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.visa_residency_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.workers_insurance') ? 'invalid' : '' }}">
        <label class="form-label required" for="workers_insurance">{{ trans('cruds.labor.fields.workers_insurance') }}</label>
        <input class="form-control" type="number" name="workers_insurance" id="workers_insurance" required wire:model.defer="labor.workers_insurance" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.workers_insurance') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.workers_insurance_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.uniform_expenses') ? 'invalid' : '' }}">
        <label class="form-label required" for="uniform_expenses">{{ trans('cruds.labor.fields.uniform_expenses') }}</label>
        <input class="form-control" type="number" name="uniform_expenses" id="uniform_expenses" required wire:model.defer="labor.uniform_expenses" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.uniform_expenses') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.uniform_expenses_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('labor.travel_expenses') ? 'invalid' : '' }}">
        <label class="form-label required" for="uniform_expenses">{{ trans('cruds.labor.fields.travel_expenses') }}</label>
        <input class="form-control" type="number" name="uniform_expenses" id="uniform_expenses" required wire:model.defer="labor.travel_expenses" step="0.001">
        <div class="validation-message">
            {{ $errors->first('labor.travel_expenses') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.labor.fields.travel_expenses_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.labors.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
