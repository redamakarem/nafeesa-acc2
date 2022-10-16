<form wire:submit.prevent="submit" class="pt-3">
    <div class="form-group" {{$errors->any() ? 'invalid' : ''}}>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <div class="form-group {{ $errors->has('finished.item_image') ? 'invalid' : '' }}">
        <x-media-library-attachment name="item_image" />
        <div class="validation-message">
            {{ $errors->first('finished.item_image') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.finished.fields.item_image_helper') }}
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
{{--    <div class="form-group {{ $errors->has('finished.labour_time') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label" for="labour_time">{{ trans('cruds.finished.fields.labour_time') }}</label>--}}
{{--        <input class="form-control" type="number" name="labour_time" id="labour_time" wire:model.defer="finished.labour_time" step="0.001">--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('finished.labour_time') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.finished.fields.labour_time_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}
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
{{--    <div class="form-group {{ $errors->has('raw_materials') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required" for="raw_materials">{{ trans('cruds.finished.fields.raw_materials') }}</label>--}}
{{--        <x-select-list class="form-control" required id="raw_materials" name="raw_materials" wire:model="raw_materials" :options="$this->listsForFields['raw_materials']" multiple />--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('raw_materials') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.finished.fields.raw_materials_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}

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
                    <td><input  data-id="{{ $rm->id }}" type="checkbox" {{ $rm->value ? 'checked' : null }} wire:ignore  class="rm-enable"></td>
                    <td style="padding: 5px 0px">{{ $rm->code }}</td>
                    <td>{{ $rm->name_en }} | {{ $rm->name_ar }}</td>
                    <td style="padding: 5px 0px">{{ $rm->unit->name_en }}</td>
                    <td style="padding: 5px 0px">{{ $rm->avg_cost }}</td>
                    <td><input  {{ $rm->value ? null : 'disabled' }}  data-id="{{ $rm->id }}" wire:model="raw_materials.{{ $rm->id }}" type="text" class="rm-amount form-control" placeholder="Amount"></td>
                </tr>
            @endforeach
        </table>

    </div>

{{--    <div class="form-group {{ $errors->has('semi_finished') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required" for="semi_finished">{{ trans('cruds.finished.fields.semi_finished') }}</label>--}}
{{--        <x-select-list class="form-control" required id="semi_finished" name="semi_finished" wire:model="semi_finished" :options="$this->listsForFields['semi_finished']" multiple />--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('semi_finished') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.finished.fields.semi_finished_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}

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

                <tr>
                    <td><input  data-id="{{ $sf->id }}" type="checkbox" {{ $sf->value ? 'checked' : null }} wire:ignore  class="sf-enable"></td>
                    <td style="padding: 5px 0px">{{ $sf->item_code }}</td>
                    <td>{{ $sf->name_en }} | {{ $sf->name_ar }}</td>
                    <td style="padding: 5px 0px" class="text-center">{{ $sf->unit->name_en }}</td>
                    <td style="padding: 5px 0px" class="text-center">{{ $sf->new_total_cost }}</td>
                    <td><input  {{ $sf->value ? null : 'disabled' }}  data-id="{{ $sf->id }}" wire:model="semi_finished.{{ $sf->id }}" type="text" class="sf-amount form-control" placeholder="Amount"></td>
                </tr>
            @endforeach
        </table>

    </div>

{{--    <div class="form-group {{ $errors->has('labor') ? 'invalid' : '' }}">--}}
{{--        <label class="form-label required" for="labor">{{ trans('cruds.finished.fields.labor') }}</label>--}}
{{--        <x-select-list class="form-control" required id="labor" name="labor" wire:model="labor" :options="$this->listsForFields['labor']" multiple />--}}
{{--        <div class="validation-message">--}}
{{--            {{ $errors->first('labor') }}--}}
{{--        </div>--}}
{{--        <div class="help-block">--}}
{{--            {{ trans('cruds.finished.fields.labor_helper') }}--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="form-group">
        <table class="table table-index w-1/2">
            <tr>
                <th>-</th>
                <th>Title</th>
                <th>Cost per hour</th>
                <th>Count</th>
                <th>Time</th>
            </tr>
            @foreach($lbs as $lb)

                <tr>
                    <td><input  data-id="{{ $lb->id }}" type="checkbox" {{ $lb->value ? 'checked' : null }} wire:ignore  class="lb-enable"></td>
                    <td>{{ $lb->title_en }} | {{ $lb->title_ar }}</td>
                    <td style="padding: 5px 0px">{{ $lb->cost_per_hour }}</td>
                    <td><input  {{ $lb->value ? null : 'disabled' }}  data-id="{{ $lb->id }}" wire:model.lazy="labor.{{ $lb->id }}.workers" type="text" class="lb-amount form-control" placeholder="How many?"></td>
                    <td><input  {{ $lb->labor_time ? null : 'disabled' }}  data-id="{{ $lb->id }}" wire:model.lazy="labor.{{ $lb->id }}.labor_time" type="text" class="lb-amount form-control" placeholder="How many?"></td>
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


@push('scripts')
    <script>
        jQuery(document).ready(function () {
            // jQuery('.rm-enable').on('click', function () {
            //     let id = jQuery(this).attr('data-id')
            //     let enabled = jQuery(this).is(":checked")
            //     jQuery('.rm-amount[data-id="' + id + '"]').attr('disabled', !enabled)
            //     jQuery('.rm-amount[data-id="' + id + '"]').val(null)
            //     // @this.clean_raw_materials()
            // })

            // jQuery('.lb-enable').on('click', function () {
            //     let id = jQuery(this).attr('data-id')
            //     let enabled = jQuery(this).is(":checked")
            //     jQuery('.lb-amount[data-id="' + id + '"]').attr('disabled', !enabled)
            //     jQuery('.lb-amount[data-id="' + id + '"]').val(null)
            //     // @this.clean_raw_materials()
            // })
        })


        document.addEventListener('livewire:load', function () {
            jQuery('.rm-enable').change(function () {
                let id = jQuery(this).attr('data-id')
                let enabled = jQuery(this).is(":checked")
                jQuery('.rm-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                jQuery('.rm-amount[data-id="' + id + '"]').val(null)
                let lvModel = jQuery('.rm-amount[data-id="' + id + '"]').attr('wire:model');
                @this.set(lvModel,jQuery('.rm-amount[data-id="' + id + '"]').val())
            })

            jQuery('.lb-enable').on('click', function () {
                let id = jQuery(this).attr('data-id')
                let enabled = jQuery(this).is(":checked")
                jQuery('.lb-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                if(!enabled)
                {
                    jQuery('.lb-amount[data-id="' + id + '"]').val(null)
                }
                let lvModel = jQuery('.lb-amount[data-id="' + id + '"]').attr('wire:model');
                @this.set(lvModel,jQuery('.lb-amount[data-id="' + id + '"]').val())
                // jQuery('.lb-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                // jQuery('.lb-amount[data-id="' + id + '"]').val(null)
                // @this.clean_raw_materials()
            })
            jQuery('.sf-enable').on('click', function () {
                let id = jQuery(this).attr('data-id')
                let enabled = jQuery(this).is(":checked")
                jQuery('.sf-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                if(!enabled)
                {
                    jQuery('.sf-amount[data-id="' + id + '"]').val(null)
                }
                let lvModel = jQuery('.sf-amount[data-id="' + id + '"]').attr('wire:model');
                @this.set(lvModel,jQuery('.sf-amount[data-id="' + id + '"]').val())
            })

            jQuery('.rm-amount').blur(function(){
                let lvModel = jQuery(this).attr('wire:model');
                @this.set(lvModel,jQuery(this).val())
            })
            jQuery('.sf-amount').blur(function(){
                let lvModel = jQuery(this).attr('wire:model');
                @this.set(lvModel,jQuery(this).val())
            })
        })
    </script>
@endpush
