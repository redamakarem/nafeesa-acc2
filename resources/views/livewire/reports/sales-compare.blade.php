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

    var res1 = @this.range1_query_res;
    var res2 = @this.range2_query_res;
    console.log(res1,res2);

    var options = {
          series: [{
          name: 'PRODUCT A',
          data: [44, 55, 41, 67, 22, 43]
        }, {
          name: 'PRODUCT B',
          data: [13, 23, 20, 8, 13, 27]
        }, {
          name: 'PRODUCT C',
          data: [11, 17, 15, 15, 21, 14]
        }, {
          name: 'PRODUCT D',
          data: [21, 7, 25, 13, 22, 8]
        }],
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
          toolbar: {
            show: true
          },
          zoom: {
            enabled: true
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10,
            dataLabels: {
              total: {
                enabled: true,
                style: {
                  fontSize: '13px',
                  fontWeight: 900
                }
              }
            }
          },
        },
        xaxis: {
          type: 'category',
          categories: [@this.range1, @this.range2],
        },
        legend: {
          position: 'right',
          offsetY: 40
        },
        fill: {
          opacity: 1
        }
        };

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

