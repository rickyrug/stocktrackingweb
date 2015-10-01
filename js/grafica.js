google.load("visualization", "1", {packages: ["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {

    var xmlhttp = new XMLHttpRequest();
    var datos;
    var candel_data = [];
    var row = [];
    var i;
    var e;
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            datos = JSON.parse(xmlhttp.responseText);

            var data = google.visualization.arrayToDataTable(datos, true);
            var options = {
                legend: 'none',
                title: 'Text,',
                height: 700,
               
                vAxis:{
                    
                    gridlines: {
                    count: 25,
                        },
                 
                },
                animation: {
                        startup: true,
                        duration: 1000,
                        easing: 'out',
                            }   
            };

            var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    };
    xmlhttp.open("GET", "http://localhost/stocktraking/index.php/reportes/generate_data_candel/valor/2014-11-01/2015-11-30/6", true);
    xmlhttp.send();


}