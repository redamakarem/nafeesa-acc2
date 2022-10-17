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

document.addEventListener('livewire:load', function () {

  

    //     function initChart(data){
    //        top_products = data;
    // console.log(top_products);
    // var series = [];
    // var labels = [];
    // top_products.map(product =>{
    //     series.push(parseFloat(product['total']));
    //     labels.push(product['name_ar']);
    // });
    //  options = {
    //       series: series,
    //       chart: {
    //       width: 750,
    //       type: 'donut',
    //     },
    //     labels: labels,
    //     responsive: [{
    //       breakpoint: 480,
    //       options: {
    //         chart: {
    //           width: 200
    //         },
    //         legend: {
    //           position: 'bottom'
    //         }
    //       }
    //     }]
    //     };

        
    //     }

    //     initChart(@this.result);

    var options = {
          series: [{
          name: "sales",
          data: [{
            x: '2019/01/01',
            y: 400
          }, {
            x: '2019/04/01',
            y: 430
          }, {
            x: '2019/07/01',
            y: 448
          }, {
            x: '2019/10/01',
            y: 470
          }, {
            x: '2020/01/01',
            y: 540
          }, {
            x: '2020/04/01',
            y: 580
          }, {
            x: '2020/07/01',
            y: 690
          }, {
            x: '2020/10/01',
            y: 690
          }]
        }],
          chart: {
          type: 'bar',
          height: 380
        },
        xaxis: {
          type: 'category',
        //   labels: {
        //     formatter: function(val) {
        //       return "Q" + dayjs(val).quarter()
        //     }
          },
          group: {
            style: {
              fontSize: '10px',
              fontWeight: 700
            },
            groups: [
              { title: '2019', cols: 4 },
              { title: '2020', cols: 4 }
            ]
          }
        }
        // title: {
        //     text: 'Grouped Labels on the X-axis',
        // },
        // tooltip: {
        //   x: {
        //     formatter: function(val) {
        //       return "Q" + dayjs(val).quarter() + " " + dayjs(val).format("YYYY")
        //     }  
        //   }
        // },


    
        var chart = new ApexCharts(document.querySelector("#compare-graph"), options);
        chart.render();

    // @this.on('refreshChart',(chartData) =>{
    //   console.log(chartData.seriesData);
    //   console.log(@this.result);
    //   initChart(@this.result);

    //   chart.updateOptions (options)
    // })

})
    
    
</script>
@endpush

