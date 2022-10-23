@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.finished.title_singular') }}:
                    {{ trans('cruds.finished.fields.id') }}
                    {{ $finished->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <form  class="pt-3" action="{{route('admin.finished.store-new',$finished)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group" {{$errors->any() ? 'invalid' : ''}}>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="form-group {{ $errors->has('semiFinished.item_code') ? 'invalid' : '' }}">
                    <label class="form-label required" for="item_code">{{ trans('cruds.semiFinished.fields.item_code') }}</label>
                    <input class="form-control" value="{{ $finished->item_code }}" type="number" name="item_code" id="item_code" required>
                    <div class="validation-message">
                        {{ $errors->first('semiFinished.item_code') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.semiFinished.fields.item_code_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.name_en') ? 'invalid' : '' }}">
                    <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.name_en') }}</label>
                    <input class="form-control" value="{{$finished->name_en}}" type="text" name="name_en" id="name_en" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.name_en') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.name_en_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.name_ar') ? 'invalid' : '' }}">
                    <label class="form-label required" for="name_ar">{{ trans('cruds.finished.fields.name_ar') }}</label>
                    <input class="form-control" value="{{$finished->name_ar}}" type="text" name="name_ar" id="name_ar" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.name_ar') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.name_ar_helper') }}
                    </div>
                </div>
            
                <div class="form-group {{ $errors->has('finished.kilos_per_dough') ? 'invalid' : '' }}">
                    <label class="form-label required" for="kilos_per_dough">{{ trans('cruds.finished.fields.kilos_per_dough') }}</label>
                    <input class="form-control" value="{{$finished->kilos_per_dough}}" type="number" name="kilos_per_dough" id="kilos_per_dough" required  step="0.001">
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
                                <td><input  data-id="{{ $rm->id }}" type="checkbox" {{ $rm->value ? 'checked' : null }}   class="rm-enable"></td>
                                <td style="padding: 5px 0px">{{ $rm->code }}</td>
                                <td>{{ $rm->name_en }} | {{ $rm->name_ar }}</td>
                                <td style="padding: 5px 0px">{{ $rm->unit->name_en }}</td>
                                <td style="padding: 5px 0px">{{ $rm->avg_cost }}</td>
                                <td>
                                    <input value="{{ $rm->value ?? null }}"  {{ $rm->value ? null : 'disabled' }} name="rms[{{$rm->id}}]"  data-id="{{ $rm->id }}"  type="text" class="rm-amount form-control disabled:bg-gray-300" placeholder="Amount">
                                </td>
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
            
                            <tr>
                                <td><input  data-id="{{ $sf->id }}" type="checkbox" {{ $sf->value ? 'checked' : null }}   class="sf-enable"></td>
                                <td style="padding: 5px 0px">{{ $sf->item_code }}</td>
                                <td>{{ $sf->name_en }} | {{ $sf->name_ar }}</td>
                                <td style="padding: 5px 0px" class="text-center">{{ $sf->unit->name_en }}</td>
                                <td style="padding: 5px 0px" class="text-center">{{ $sf->new_total_cost }}</td>
                                <td><input  {{ $sf->value ? null : 'disabled' }} value="{{$sf->value}}"  data-id="{{ $sf->id }}" name="sfs[{{$sf->id}}]" type="text" class="sf-amount form-control disabled:bg-gray-400" placeholder="Amount"></td>
                            </tr>
                        @endforeach
                    </table>
            
                </div>
            
            
            
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
                                <td><input  data-id="{{ $lb->id }}" type="checkbox" {{ $lb->value ? 'checked' : null }} class="lb-enable"></td>
                                <td>{{ $lb->title_en }} | {{ $lb->title_ar }}</td>
                                <td style="padding: 5px 0px">{{ $lb->cost_per_hour }}</td>
                                <td><input  {{ $lb->value ? null : 'disabled' }} value="{{$lb->value}}" data-id="{{ $lb->id }}"  type="text" class="lb-amount form-control" placeholder="How many?"></td>
                                <td><input  {{ $lb->labor_time ? null : 'disabled' }} value="{{$lb->labor_time}}" data-id="{{ $lb->id }}"  type="text" class="lb-time form-control disabled:bg-gray-400" placeholder="How many?"></td>
                            </tr>
                        @endforeach
                    </table>
            
                </div>
            
                <div class="form-group {{ $errors->has('finished.unit_id') ? 'invalid' : '' }}">
                    <label class="form-label required" for="unit">{{ trans('cruds.finished.fields.unit') }}</label>
                    <select name="unit" id="unit">
                        <option value="">Select unit</option>
                        @foreach ($units as $unit )
                        <option value="{{$unit->id}}" {{$finished->unit_id == $unit->id ? 'selected' : ''}}>{{$unit->name_en}}</option>
                        @endforeach
                    </select>
                    <div class="validation-message">
                        {{ $errors->first('finished.unit_id') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.unit_helper') }}
                    </div>
                </div>
            
                <div class="form-group {{ $errors->has('finished.sale_price') ? 'invalid' : '' }}">
                    <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.sale_price') }}</label>
                    <input class="form-control" value="{{ $finished->sale_price }}" type="text" name="sale_price" id="name_en" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.sale_price') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.sale_price_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.freight') ? 'invalid' : '' }}">
                    <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.freight') }}</label>
                    <input class="form-control" value="{{ $finished->freight }}" type="text" name="freight" id="name_en" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.freight') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.freight_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.transport') ? 'invalid' : '' }}">
                    <label class="form-label required" for="transport">{{ trans('cruds.finished.fields.transport') }}</label>
                    <input class="form-control" value="{{ $finished->sale_price }}" type="text" name="sale_price" id="sale_price" name="sale_price" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.transport') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.transport_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.loyalty') ? 'invalid' : '' }}">
                    <label class="form-label required" for="loyalty">{{ trans('cruds.finished.fields.loyalty') }}</label>
                    <input class="form-control" value="{{ $finished->loyalty }}" type="text" name="loyalty" id="loyalty" name="loyalty" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.loyalty') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.loyalty_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.other') ? 'invalid' : '' }}">
                    <label class="form-label required" for="other">{{ trans('cruds.finished.fields.other') }}</label>
                    <input class="form-control" value="{{ $finished->other }}" type="text" name="other" id="other" required >
                    <div class="validation-message">
                        {{ $errors->first('finished.other') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.finished.fields.other_helper') }}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('finished.notes') ? 'invalid' : '' }}">
                    <label class="form-label required" for="name_en">{{ trans('cruds.finished.fields.notes') }}</label>
                    <textarea class="form-control" value="{{ $finished->notes }}" type="text" name="notes" id="notes" ></textarea>
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
            
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        jQuery(document).ready(function () {
            jQuery('.rm-enable').on('click', function () {
                let id = jQuery(this).attr('data-id')
                let enabled = jQuery(this).is(":checked")
                jQuery('.rm-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                jQuery('.rm-amount[data-id="' + id + '"]').val(null)
                
            })

            jQuery('.lb-enable').on('click', function () {
                let id = jQuery(this).attr('data-id')
                let enabled = jQuery(this).is(":checked")
                jQuery('.lb-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                jQuery('.lb-amount[data-id="' + id + '"]').val(null)
                
            })
        })


      
    </script>
@endpush
