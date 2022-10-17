<div>
    <div class="card-controls">
        <div class="w-full">
          <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
            <label class="form-label required" for="date">Range 1</label>
            <x-date-picker class="form-control" required wire:model="range1" id="range1" name="range1" picker="date" mode="range" />
            <div class="validation-message">
                {{ $errors->first('sale.date') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.sale.fields.date_helper') }}
            </div>
        </div>
        <div class="w-full">
          <div class="form-group {{ $errors->has('sale.date') ? 'invalid' : '' }}">
            <label class="form-label required" for="date">Range 2</label>
            <x-date-picker class="form-control" required wire:model="range2" id="range2" name="range2" picker="date" mode="range" />
            <div class="validation-message">
                {{ $errors->first('sale.date') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.sale.fields.date_helper') }}
            </div>
        </div>
        <div class="w-full">
            <button class="btn btn-indigo mr-2" wire:click='do_search'>Submit</button>
        </div>
        <div class="w-full">
            <div id="compare-graph" wire:ignore></div>
        </div>
        
        
</div>

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

var options=null;
var top_products=null;

function initChart(seriesData){
            var res1 = @this.range1_query_res;
            var res2 = @this.range2_query_res;
            console.log(res1,res2);
    var series_array = [];
    
     options = {
          series: [{
          name: 'Total Sales-R1',
          data: [res1[0]['total_sales'], res1[1]['total_sales'],res1[2]['total_sales'],res1[3]['total_sales'],res1[4]['total_sales']]
        },
        {
          name: 'Total Sales-R2',
          data: [res2[0]['total_sales'], res2[1]['total_sales'],res2[2]['total_sales'],res2[3]['total_sales'],res2[4]['total_sales']]
        },
        {
          name: 'Total Costs-R1',
          data: [res1[0]['total_costs'], res1[1]['total_costs'],res1[2]['total_costs'],res1[3]['total_costs'],res1[4]['total_costs']]
        }, 
        {
          name: 'Total Costs-R2',
          data: [res2[0]['total_costs'], res2[1]['total_costs'],res2[2]['total_costs'],res2[3]['total_costs'],res2[4]['total_costs']]
        },{
          name: 'Total Profit-R1',
          data: [res1[0]['total_profit'], res1[1]['total_profit'],res1[2]['total_profit'],res1[3]['total_profit'],res1[4]['total_profit']]
        },
        {
          name: 'Total Profit-R2',
          data: [res2[0]['total_profit'], res2[1]['total_profit'],res2[2]['total_profit'],res2[3]['total_profit'],res2[4]['total_profit']]
        }
    ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Hawalli','Oquila','Salmiya','Jahra','Ardiya'],
        },
        yaxis: {
          title: {
            text: 'KD'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "KD " + val 
            }
          }
        }
        };
        }

document.addEventListener('livewire:load', function () {

  

    

        
    
        

    @this.on('refreshChart',(chartData) =>{
        console.log('YAAASS');
      console.log(chartData.seriesData);
      initChart(chartData.seriesData);
      var chart = new ApexCharts(document.querySelector("#compare-graph"), options);
        chart.render();

      chart.updateOptions (options)
    })

})
    
    
</script>
@endpush

