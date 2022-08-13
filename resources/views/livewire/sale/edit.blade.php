<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('sale.item_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="item">{{ trans('cruds.sale.fields.item') }}</label>
        <x-select-list class="form-control" required id="item" name="item" :options="$this->listsForFields['item']" wire:model="sale.item_id" />
        <div class="validation-message">
            {{ $errors->first('sale.item_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.item_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sale.qty') ? 'invalid' : '' }}">
        <label class="form-label required" for="qty">{{ trans('cruds.sale.fields.qty') }}</label>
        <input class="form-control" type="number" name="qty" id="qty" required wire:model.defer="sale.qty" step="0.001">
        <div class="validation-message">
            {{ $errors->first('sale.qty') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.qty_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
        <label class="form-label required" for="date">{{ trans('cruds.sale.fields.date') }}</label>
        <x-date-picker class="form-control" required wire:model="sale.date" id="date" name="date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('sale.date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sale.branch_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="branch">{{ trans('cruds.sale.fields.branch') }}</label>
        <x-select-list class="form-control" required id="branch" name="branch" :options="$this->listsForFields['branch']" wire:model="sale.branch_id" />
        <div class="validation-message">
            {{ $errors->first('sale.branch_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.branch_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sale.transaction_type') ? 'invalid' : '' }}">
        <label class="form-label required" for="branch">{{ trans('cruds.sale.fields.transaction_type') }}</label>
        <x-select-list class="form-control" required id="transaction_type" name="transaction_type" :options="$this->listsForFields['transaction_type']" wire:model="sale.transaction_type" />
        <div class="validation-message">
            {{ $errors->first('sale.transaction_type') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.transaction_type_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
