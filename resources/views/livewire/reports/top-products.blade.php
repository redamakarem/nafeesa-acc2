<div>
  <div class="card-controls">
    <div class="w-full">
      <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
        <label class="form-label required" for="date">Dates</label>
        <x-date-picker class="form-control" required wire:model="selected_dates" id="selected_dates" name="selected_dates" picker="date" mode="multiple" />
        <div class="validation-message">
            {{ $errors->first('sale.date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sale.fields.date_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('finished.unit_id') ? 'invalid' : '' }}">
      <label class="form-label required" for="by">By?</label>
      <select wire:model="selected_clause">
        <option value="">Select</option>
        <option value="quantity">quantity</option>
        <option value="price">price</option>
        <option value="profit">profit</option>
      </select>
          {{ $errors->first('finished.unit_id') }}
      </div>
      <div class="help-block">
          {{ trans('cruds.finished.fields.unit_helper') }}
      </div>
  </div>
    <div class="form-group {{ $errors->has('finished.unit_id') ? 'invalid' : '' }}">
      <label class="form-label required" for="by">Count</label>
      <input type="number" step="1" wire:model='selected_count' />
          {{ $errors->first('selected_count') }}
      </div>
      <div class="help-block">
          {{ trans('cruds.finished.fields.unit_helper') }}
      </div>
  </div>
    </div>
  </div>
    <div id="top-products"></div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

var options=null;
var top_products=null;

document.addEventListener('livewire:load', function () {

  

        function initChart(data){
           top_products = data;
    console.log(top_products);
    var series = [];
    var labels = [];
    top_products.map(product =>{
        series.push(parseFloat(product['total']));
        labels.push(product['name_ar']);
    });
     options = {
          series: series,
          chart: {
          width: 750,
          type: 'donut',
        },
        labels: labels,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        
        }

        initChart(@this.result);
        var chart = new ApexCharts(document.querySelector("#top-products"), options);
        chart.render();

    @this.on('refreshChart',(chartData) =>{
      console.log(chartData.seriesData);
      console.log(@this.result);
      initChart(@this.result);

      chart.updateOptions (options)
    })

})
    
    
</script>
@endpush
