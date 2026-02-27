<div>
    <div id="main" style="width:100%;height:400px;"></div>
    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('main'));
      option = {
        legend: {},
        tooltip: {},
        xAxis: {
            type: 'category',
            data: @json($months)
        },
        yAxis: {
            type: 'value'
        },
        series: [
            {
                name: 'Receitas',
                data: @json($credit),
                type: 'line',
                smooth: true
            },
            {
                name: 'Despesas',
                data: @json($debit),
                type: 'line',
                smooth: true
            },
        ]
    };
      myChart.setOption(option);
    </script>
</div>