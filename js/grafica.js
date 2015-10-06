google.load("visualization", "1", {packages: ["corechart"]});

function drawChart() {

    var xmlhttp = new XMLHttpRequest();
    var datos;

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            datos = JSON.parse(xmlhttp.responseText);
            var data = google.visualization.arrayToDataTable(datos, true);
            var options = {
                legend: 'none',
               
                fontSize:10,
                height: 650,
                candlestick: {
                    fallingColor: {strokeWidth: 0, fill: '#a52714'}, // red
                    risingColor: {strokeWidth: 0, fill: '#0f9d58'}   // green
                },
                chartArea:{width:'60%',height:'90%'},
                vAxis: {
                    /*viewWindow:{
                        min:5000,
                        max:5200
                    },*/
                    gridlines: {
                        count: 15,
                       
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
            draw_table(datos);
        }
    };
    var base_url = window.location.pathname;
    var portafolios = $("select[name=portafolios]").val();
    var fechainicio = $("input[name=fechaini]").val();
    var fechafinal  = $("input[name=fechafin]").val();
    xmlhttp.open("GET", "http://localhost"+base_url+"/generate_data_candel/profit/"+fechainicio+"/"+fechafinal+"/"+portafolios, true);
    xmlhttp.send();
    
}

function draw_table(datos){
   console.log(datos);
   var table = '<table class="table table-hover table_candel"><tbody>';
   var i,e;
   var temp;
   var valor;
   table = table + '<thead><tr>'+ 
                     '<th>MONTH</th><th>MIN</th>'+
                     '<th>OPEN</th><th>CLOSE</th>'+
                     '<th>MAX</th>'+
                   '</tr></thead>';
    for(i=0;i < $(datos).size(); i++){
        table = table + '<tr>';
        temp = datos[i];
        
        for(e=0; e<$(temp).size();e++){
            valor = parseFloat(temp[e]);
            table = table + '<td>'+valor.toPrecision(8)+'</td>';
           
        }
        table = table + '</tr>';
    }
    
    
    
   table = table + '</tbody></table>';
   console.log(table);
   $("#table_candel_info").html(table);
}