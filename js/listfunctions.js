/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    
    $('input[name=profit]').keydown(function(e){
       
       if(e.which === 9){
            var var_fecha       = $('input[name=fecha]').val();
            var var_portafolios = $('select[name=portafolios]').val();
            var var_valor       = $('input[name=valor]').val();
           
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('input[name=profit]').val(xmlhttp.responseText);
                   
                }
            }
            var base_url = window.location;
            
//            var url      = base_url.pathname.split('/')[1]+'/'+base_url.pathname.split('/')[2]+'/'+base_url.pathname.split('/')[3];
              var url      = base_url.pathname.split('/')[1]+'/'+base_url.pathname.split('/')[2];
 
            
           // xmlhttp.open("GET", "http://localhost/"+url+"/calculate_profit/" + var_portafolios + "/" + var_valor + "/" + var_fecha, true); 
             xmlhttp.open("GET", "http://localhost/stocktracker/index.php?/resultados/calculate_profit/" + var_portafolios + "/" + var_valor + "/" + var_fecha, true); 
            xmlhttp.send();
           
       }
    });
    
    
    $('input[name=rendimiento]').keydown(function(e){
        if(e.which === 9){
            var var_fecha       = $('input[name=fecha]').val();
            var var_portafolios = $('select[name=portafolios]').val();
            var var_valor       = $('input[name=valor]').val();
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('input[name=rendimiento]').val(xmlhttp.responseText);
                   
                }
            }
            var base_url = window.location;
//            var url      = base_url.pathname.split('/')[1]+'/'+base_url.pathname.split('/')[2]+'/'+base_url.pathname.split('/')[3];
              var url      = base_url.pathname.split('/')[1]+'/'+base_url.pathname.split('/')[2];
//            xmlhttp.open("GET", "http://rickyrugstocktracker.azurewebsites.net/"+url+"/calculate_rendimiento/" + var_portafolios + "/" + var_valor + "/" + var_fecha, true); 
              xmlhttp.open("GET", "http://localhost/stocktracker/index.php?/resultados/calculate_rendimiento/" + var_portafolios + "/" + var_valor + "/" + var_fecha, true); 
            xmlhttp.send();
        }

    });
    
});
