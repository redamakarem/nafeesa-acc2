<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('setting.key') ? 'invalid' : '' }}">
        <label class="form-label required" for="key">{{ trans('cruds.setting.fields.key') }}</label>
        <input class="form-control" type="text" name="key" id="key" required wire:model.defer="setting.key">
        <div class="validation-message">
            {{ $errors->first('setting.key') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.key_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.value') ? 'invalid' : '' }}">
        <label class="form-label required" for="value">{{ trans('cruds.setting.fields.value') }}</label>
        <input class="form-control" type="text" name="value" id="value" required wire:model.defer="setting.value">
        <div class="validation-message">
            {{ $errors->first('setting.value') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.value_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.type') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.setting.fields.type') }}</label>
        <select class="form-control" wire:model="setting.type">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['type'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('setting.type') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.type_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
