<form wire:submit.prevent="submit" class="pt-3">
    <div class="form-group" {{$errors->any() ? 'invalid' : ''}}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.item_code') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.item_code') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="semiFinished.item_code">
        <div class="validation-message">
            {{ $errors->first('semiFinished.item_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.item_code_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.name_en') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.name_en') }}</label>
        <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="semiFinished.name_en">
        <div class="validation-message">
            {{ $errors->first('semiFinished.name_en') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.name_en_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.name_ar') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_ar">{{ trans('cruds.semiFinished.fields.name_ar') }}</label>
        <input class="form-control" type="text" name="name_ar" id="name_ar" required wire:model.defer="semiFinished.name_ar">
        <div class="validation-message">
            {{ $errors->first('semiFinished.name_ar') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.name_ar_helper') }}
        </div>
    </div>
{{--    <div class="form-group">--}}
{{--        <label class="form-label required" for="name_ar">{{ trans('cruds.rawMaterial.title') }}</label>--}}

{{--        <table class="table table-index w-1/2">--}}
{{--            <tr>--}}
{{--                <th>-</th>--}}
{{--                <th>Code</th>--}}
{{--                <th>Title</th>--}}
{{--                <th class="w-24">Unit</th>--}}
{{--                <th>Avg. Cost</th>--}}
{{--                <th>Quantity</th>--}}
{{--            </tr>--}}
{{--            @foreach($rms as $rm)--}}
{{--                <tr>--}}
{{--                    <td style="padding: 5px 0px"><input wire:model="selected_raw_materials.{{$rm->id}}"  data-id="{{ $rm->id }}" type="checkbox"  class="rm-enable" wire:ignore></td>--}}
{{--                    <td style="padding: 5px 0px">{{ $rm->code }}</td>--}}
{{--                    <td style="padding: 5px 0px">{{ $rm->name_en }} | {{ $rm->name_ar }}</td>--}}
{{--                    <td style="padding: 5px 0px">{{ $rm->unit->name_en }}</td>--}}
{{--                    <td style="padding: 5px 0px">{{ $rm->avg_cost }}</td>--}}
{{--                    <td style="padding: 5px 0px"><input {{$this->key_is_in_array($rm->id,$selected_raw_materials)?'':'disabled'}}  data-id="{{ $rm->id }}" wire:model="raw_materials.{{ $rm->id }}" type="text" class="rm-amount form-control" placeholder="Quantity"></td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--        </table>--}}

{{--    </div>--}}
    <div class="form-group" wire:ignore>
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
                    <td style="padding: 5px 0px"><input  data-id="{{ $rm->id }}" type="checkbox"  class="rm-enable"></td>
                    <td style="padding: 5px 0px">{{ $rm->code }}</td>
                    <td style="padding: 5px 0px">{{ $rm->name_en }} | {{ $rm->name_ar }}</td>
                    <td style="padding: 5px 0px">{{ $rm->unit->name_en }}</td>
                    <td style="padding: 5px 0px">{{ $rm->avg_cost }}</td>
                    <td style="padding: 5px 0px"><input data-id="{{ $rm->id }}"  type="text" class="rm-amount form-control" placeholder="Quantity"></td>
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

        <table class="table table-index">
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

{{--    <div class="form-group {{ $errors->has('raw_materials') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required" for="raw_materials">{{ trans('cruds.semiFinished.fields.raw_materials') }}</label>--}}
{{--        <x-select-list class="form-control" required id="raw_materials" name="raw_materials" wire:model="raw_materials" :options="$this->listsForFields['raw_materials']" multiple />--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('raw_materials') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.semiFinished.fields.raw_materials_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group {{ $errors->has('semiFinished.kilos_per_dough') ? 'invalid' : '' }}">
        <label class="form-label required" for="kilos_per_dough">{{ trans('cruds.semiFinished.fields.kilos_per_dough') }}</label>
        <input class="form-control" type="number" name="kilos_per_dough" id="kilos_per_dough" required
               wire:model.defer="semiFinished.kilos_per_dough" step="0.001">
        <div class="validation-message">
            {{ $errors->first('semiFinished.kilos_per_dough') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.kilos_per_dough_helper') }}
        </div>
    </div>


    <div class="form-group {{ $errors->has('semiFinished.unit_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="unit">{{ trans('cruds.semiFinished.fields.unit') }}</label>
        <x-select-list class="form-control" required id="unit" name="unit" :options="$this->listsForFields['unit']" wire:model="semiFinished.unit_id" />
        <div class="validation-message">
            {{ $errors->first('semiFinished.unit_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.unit_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.transport') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.transport') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="semiFinished.transport">
        <div class="validation-message">
            {{ $errors->first('semiFinished.transport') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.transport_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.other') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.other') }}</label>
        <input class="form-control" type="text" name="item_code" id="name_en" required wire:model.defer="semiFinished.other">
        <div class="validation-message">
            {{ $errors->first('semiFinished.other') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.other_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('semiFinished.notes') ? 'invalid' : '' }}">
        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.notes') }}</label>
        <textarea class="form-control" type="text" name="item_code" id="name_en" wire:model.defer="semiFinished.notes"></textarea>
        <div class="validation-message">
            {{ $errors->first('semiFinished.notes') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.semiFinished.fields.notes_helper') }}
        </div>
    </div>

{{--    <div class="form-group {{ $errors->has('semiFinished.labor_time') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required" for="name_en">{{ trans('cruds.semiFinished.fields.labor_time') }}</label>--}}
{{--        <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="semiFinished.labor_time">--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('semiFinished.labor_time') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.semiFinished.fields.labor_time_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.semi-finisheds.index') }}" class="btn btn-secondary">
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

@push('scripts')
   <script>
       // jQuery(document).ready(function () {
           //Raw materials




       document.addEventListener('livewire:load', function () {

           jQuery('.rm-enable').each(function (index) {
               let id = jQuery(this).attr('data-id')
               let enabled = jQuery(this).is(":checked")
               jQuery('.rm-amount[data-id="' + id + '"]').attr('disabled', !enabled)
               jQuery('.rm-amount[data-id="' + id + '"]').val(null)
           })
           jQuery('.rm-enable').on('click', function () {
               let id = jQuery(this).attr('data-id')
               let enabled = jQuery(this).is(":checked")

               jQuery('.rm-amount[data-id="' + id + '"]').attr('disabled', !enabled)
               jQuery('.rm-amount[data-id="' + id + '"]').val(null)

               if(enabled){
                   jQuery('.rm-amount[data-id="' + id + '"]').focus();
               }

           })

           jQuery('.rm-amount').blur(function () {
                let amt = jQuery.trim(jQuery(this).val());
               let id = jQuery(this).attr('data-id')
                console.log(`Amount====== ${amt}`);
               @this.set(`raw_materials.${id}`,amt);
           })

           jQuery('.sf-enable').each(function (index) {
               let id = jQuery(this).attr('data-id')
               let enabled = jQuery(this).is(":checked")
               jQuery('.sf-amount[data-id="' + id + '"]').attr('disabled', !enabled)
               jQuery('.sf-amount[data-id="' + id + '"]').val(null)
           })
           jQuery('.sf-enable').on('click', function () {
               let id = jQuery(this).attr('data-id')
               let enabled = jQuery(this).is(":checked")
               jQuery('.sf-amount[data-id="' + id + '"]').attr('disabled', !enabled)
               jQuery('.sf-amount[data-id="' + id + '"]').val(null)
           })


           //Labor
           jQuery('.lb-enable').each(function (index) {
               let id = jQuery(this).attr('data-id')
               let enabled = jQuery(this).is(":checked")
               jQuery('.lb-salary[data-id="' + id + '"]').attr('disabled', !enabled)
               jQuery('.lb-salary[data-id="' + id + '"]').val(null)
           })
           jQuery('.lb-enable').on('click', function () {
               let id = jQuery(this).attr('data-id')
               let enabled = jQuery(this).is(":checked")
               jQuery('.lb-salary[data-id="' + id + '"]').attr('disabled', !enabled)
               jQuery('.lb-salary[data-id="' + id + '"]').val(null)
           })

       })
       // })
   </script>
@endpush
