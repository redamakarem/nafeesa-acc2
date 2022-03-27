<form wire:submit.prevent="submit" class="pt-3">
    <div class="form-group" {{$errors->any() ? 'invalid' : ''}}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.item_image') ? 'invalid' : '' }}">
        <x-media-library-attachment name="item_image" />
        <div class="validation-message">
            {{ $errors->first('semiFinished.item_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.item_image_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.item_code') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.item_code') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="finished.item_code">
        <div class="validation-message">
            {{ $errors->first('semiFinished.item_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.item_code_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.name_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.name_en') }}</label>
        <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="finished.name_en">
        <div class="validation-message">
            {{ $errors->first('finished.name_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.name_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.name_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_ar">{{ trans('cruds.finished.fields.name_ar') }}</label>
        <input class="form-control" type="text" name="name_ar" id="name_ar" required wire:model.defer="finished.name_ar">
        <div class="validation-message">
            {{ $errors->first('finished.name_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.name_ar_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('finished.kilos_per_dough') ? 'invalid' : '' }}">
        <label class="form-label required" for="kilos_per_dough">{{ trans('cruds.finished.fields.kilos_per_dough') }}</label>
        <input class="form-control" type="number" name="kilos_per_dough" id="kilos_per_dough" required wire:model.defer="finished.kilos_per_dough" step="0.001">
        <div class="validation-message">
            {{ $errors->first('finished.kilos_per_dough') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.kilos_per_dough_helper') }}
        </div>
    </div>


    <div class="form-group">
        <label class="form-label required" for="name_ar">{{ trans('cruds.rawMaterial.title') }}</label>

        <table class="table table-index w-1/2">
            <tr>
                <th>-</th>
                <th>Code</th>
                <th>Title</th>
                <th class="w-24">Unit</th>
                <th>Avg. Cost</th>
                <th>Quantity</th>
            </tr>
            @foreach($rms as $rm)
                <tr>
                    <td style="padding: 5px 0px"><input wire:model="selected_raw_materials.{{$rm->id}}"  data-id="{{ $rm->id }}" type="checkbox"  class="rm-enable" wire:ignore></td>
                    <td style="padding: 5px 0px">{{ $rm->code }}</td>
                    <td style="padding: 5px 0px">{{ $rm->name_en }} | {{ $rm->name_ar }}</td>
                    <td style="padding: 5px 0px">{{ $rm->unit->name_en }}</td>
                    <td style="padding: 5px 0px">{{ $rm->avg_cost }}</td>
                    <td style="padding: 5px 0px"><input {{$this->key_is_in_array($rm->id,$selected_raw_materials)?'':'disabled'}}  data-id="{{ $rm->id }}" wire:model="raw_materials.{{ $rm->id }}" type="text" class="rm-amount form-control" placeholder="Quantity"></td>
                </tr>
            @endforeach
        </table>

    </div>


    <div class="form-group">
        <label class="form-label required" for="name_ar">{{ trans('cruds.semiFinished.title') }}</label>

        <table class="table table-index w-1/2">
            <tr>
                <th>-</th>
                <th>Code</th>
                <th>Title</th>
                <th class="w-24">Unit</th>
                <th>Cost per unit</th>
                <th>Quantity</th>
            </tr>
            @foreach($sfs as $sf)
                <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                    <td style="padding: 5px 0px"><input wire:model="selected_semiFinished.{{$sf->id}}" data-id="{{ $sf->id }}" type="checkbox"  class="sf-enable"></td>
                    <td style="padding: 5px 0px">{{ $sf->item_code }}</td>
                    <td style="padding: 5px 0px">{{ $sf->name_en }} | {{ $sf->name_ar }}</td>
                    <td style="padding: 5px 0px" class="text-center">{{ $sf->unit->name_en }}</td>
                    <td style="padding: 5px 0px" class="text-center">{{ $sf->new_total_cost }}</td>
                    <td style="padding: 5px 0px"><input  {{$this->key_is_in_array($sf->id,$selected_semiFinished)?'':'disabled'}} data-id="{{ $sf->id }}" wire:model="semi_finished.{{ $sf->id }}" type="text" class="sf-amount form-control" placeholder="Quantity"></td>
                </tr>
            @endforeach
        </table>

    </div>




    <div class="form-group">
        <label class="form-label required" for="name_ar">{{ trans('cruds.labor.title') }}</label>

        <table class="table table-index w-1/2">
            <tr>
                <th>-</th>
                <th>Title</th>
                <th>Cost per hour</th>
                <th>Count</th>
                <th>Time</th>
            </tr>
            @foreach($lbs as $lb)
                <tr class="border-b odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700 dark:border-gray-600">
                    <td style="padding: 5px 0px"><input  data-id="{{ $lb->id }}" type="checkbox" wire:model="selected_labor.{{$lb->id}}" class="lb-enable"></td>
                    <td style="padding: 5px 0px">{{ $lb->title_en }} | {{ $lb->title_ar }}</td>
                    <td style="padding: 5px 0px">{{ $lb->cost_per_hour }}</td>
                    <td style="padding: 5px 0px"><input {{$this->key_is_in_array($lb->id,$selected_labor)?'':'disabled'}}  data-id="{{ $lb->id }}" wire:model="labours.{{ $lb->id }}.workers" type="text"
                                                        class="lb-salary form-control" placeholder="How many?"></td>
                    <td style="padding: 5px 0px"><input {{$this->key_is_in_array($lb->id,$selected_labor)?'':'disabled'}}  data-id="{{ $lb->id }}" wire:model="labours.{{ $lb->id }}.labor_time" type="text"
                                                        class="lb-salary form-control" placeholder="How much time?"></td>
                </tr>
            @endforeach
        </table>

    </div>

    <div class="form-group {{ $errors->has('finished.unit_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="unit">{{ trans('cruds.finished.fields.unit') }}</label>
        <x-select-list class="form-control" required id="unit" name="unit" :options="$this->listsForFields['unit']" wire:model="finished.unit_id" />
        <div class="validation-message">
            {{ $errors->first('finished.unit_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.unit_helper') }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('finished.sale_price') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.sale_price') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="finished.sale_price">
        <div class="validation-message">
            {{ $errors->first('finished.sale_price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.sale_price_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.freight') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.freight') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="finished.freight">
        <div class="validation-message">
            {{ $errors->first('finished.freight') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.freight_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.transport') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.transport') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="finished.transport">
        <div class="validation-message">
            {{ $errors->first('finished.transport') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.transport_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.loyalty') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.loyalty') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="finished.loyalty">
        <div class="validation-message">
            {{ $errors->first('finished.loyalty') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.loyalty_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.other') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.other') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="finished.other">
        <div class="validation-message">
            {{ $errors->first('finished.other') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.other_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.notes') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.notes') }}</label>
        <textarea class="form-control" type="text" name="item_code" id="name_en" wire:model.defer="finished.notes"></textarea>
        <div class="validation-message">
            {{ $errors->first('finished.notes') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.notes_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.finisheds.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>


@push('styles')
    <style>
        input[type="text"]:disabled {
            background: #dddddd;
        }
    </style>
@endpush
