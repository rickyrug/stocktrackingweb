google.load("visualization", "1", {packages: ["corechart"]});

function drawChart() {

    var xmlhttp = new XMLHttpRequest();
    var datos;

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            datos = JSON.parse(xmlhttp.responseText);
            var data = google.visualization.arrayToDataTable(datos.valores, true);
            var options = {
                legend: 'none',
                fontSize:10,
                height: 600, 
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
                        count: 50,
                       
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
            draw_table(datos.valores);
            set_values(datos);
        }
    };
   
    var portafolios = $("select[name=portafolios]").val();
    var parameter   = $("select[name=get_param]").val();
    var fechainicio = $("input[name=fechaini]").val();
    var fechafinal  = $("input[name=fechafin]").val();
    var base_url    = $("input[name=base_url]").val();
    console.log(base_url);
    xmlhttp.open("GET", base_url+"index.php?/reportes/generate_data_candel/"+parameter+"/"+fechainicio+"/"+fechafinal+"/"+portafolios, true);
    xmlhttp.send();
   
}


function draw_table(datos){
   
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
  
   $("#table_candel_info").html(table);
}

function set_values(datos){
   
    $('#utilidad').text('$'+datos.profit);
    $('#rendimiento').text(datos.perform+'%');
    $('#valor').text('$'+datos.valor);
    $('#aportaciones').text('$'+datos.aportaciones);
    $('#retiros').text('$'+datos.retiros);
    $('#valorinicial').text('$'+datos.initialvalue);
   
}