<div>
    <div id="chart"></div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var chartData = @json($sales_by_branch);
    var series =[];
    var totalSales =[];
    var totalCosts =[];
    var totalProfit =[];
    var branches =[];
    var seriesNames =['Sales','Costs','Profits']
    chartData.map(branch =>{
        totalSales.push(parseFloat(branch['total_sales']).toFixed(3))
        totalCosts.push(parseFloat(branch['total_costs']).toFixed(3))
        totalProfit.push(parseFloat(branch['total_profit']).toFixed(3))
        branches.push(branch['title_en'])
    })
    console.log(series);
    var options = {
          series: [{
          name: 'Sales',
          data: totalSales
        }, {
          name: 'Costs',
          data: totalCosts
        }, {
          name: 'Profits',
          data: totalProfit
        }],
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
          categories: branches
        },
        yaxis: {
          title: {
            text: 'Amount (KWD)'
          }
        },
        fill: {
          opacity: 1
        },
        
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>
@endpush