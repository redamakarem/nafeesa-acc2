<div>
    <div id="top-products"></div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var top_products = @json($top_products);
    console.log(top_products);
    var series = [];
    var labels = [];
    top_products.map(product =>{
        series.push(product['total_sales']);
        labels.push(product['name_ar']);
    });
    var options = {
          series: series,
          chart: {
          width: 750,
          type: 'pie',
        },
        labels: labels,
        
        };

        var chart = new ApexCharts(document.querySelector("#top-products"), options);
        chart.render();
</script>
@endpush
