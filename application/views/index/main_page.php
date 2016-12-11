<div class="row">
    <div class="col-md-6">
        <h2>Cambio diario</h2>
        <div id="table_div"></div>
        <input type="hidden" name="actionDailychange" id='actionDailychange' value="<?php echo $accionDaily ?>" />
    </div>
    <div class="col-md-6">
        <h2>Ultimos 60 resultados Kuspit</h2>
        <div id="chartcurvs"></div>
        <input type="hidden" name="actionPerformance" id='actionPerformance' value="<?php echo $accionPerformance ?>" />
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <h2>Ultimos 60 resultados CETES</h2>
        <div id="chartcurvscetes"></div>
    </div>
    <div class="col-md-6">
        <h2>Ultimos 60 resultados TOTAL</h2>
        <div id="chartcurvstotal"></div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
<script type="text/javascript">
    google.charts.load('current', {'packages':['table','corechart']});
    google.charts.setOnLoadCallback(drawCharts);
    
    function drawCharts(){
        drawTableDaily();
        drawLineChartKuspit();
        drawLineChartCetes();
        drawLineChartTotal();
    }
    
    function drawLineChartKuspit(){
        
        var url = $('#actionPerformance').val()+'/Kuspit';
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth();
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        
        $.get( url,function( rdata ) {
            var obj = jQuery.parseJSON( rdata );
          var data = google.visualization.arrayToDataTable(obj);

        var options = {
          title: 'Kuspit Performance',
          
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chartcurvs'));

        chart.draw(data, options);
        });
        
        
    }
    function drawLineChartCetes(){
        
        var url = $('#actionPerformance').val()+'/CETESDIRECTO';
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth();
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        
        $.get( url,function( rdata ) {
            var obj = jQuery.parseJSON( rdata );
          var data = google.visualization.arrayToDataTable(obj);

        var options = {
          title: 'Cetes Performance',
          
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chartcurvscetes'));

        chart.draw(data, options);
        });
    }
    function drawLineChartTotal(){
        
        var url = $('#actionPerformance').val()+'/ZZ';
        var date = new Date();
        var y = date.getFullYear();
        var m = date.getMonth();
        var firstDay = new Date(y, m, 1);
        var lastDay = new Date(y, m + 1, 0);
        
        $.get( url,function( rdata ) {
            
            var obj = jQuery.parseJSON( rdata );
          var data = google.visualization.arrayToDataTable(obj);

        var options = {
          title: 'Total Performance',
          
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chartcurvstotal'));

        chart.draw(data, options);
        });
    }
    function drawTableDaily(){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Portafolios');
        data.addColumn('number', 'Cambio');
        
       var url = $('#actionDailychange').val();
        
        $.get( url, function( rdata ) {
            var obj = jQuery.parseJSON( rdata );

            data.addRows(obj);

            var table = new google.visualization.Table(document.getElementById('table_div'));

            var formatter = new google.visualization.ArrowFormat();
            formatter.format(data, 1); // Apply formatter to second column

            table.draw(data, {allowHtml: true, showRowNumber: true});
        });
        
        
        }
</script>
