/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('input[name=profit]').dblclick(function () {
       
            var var_fecha       = $('input[name=fecha]').val();
            var var_portafolios = $('select[name=portafolios]').val();
            var var_valor       = $('input[name=valor]').val();
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('input[name=profit]').val(xmlhttp.responseText);
                   
                }
            }
            var base_url = window.location.pathname;
            xmlhttp.open("GET", "http://localhost"+base_url+"/calculate_profit/" + var_portafolios + "/" + var_valor + "/" + var_fecha, true); // first try `../index.php/example` ( extension depends if you enable/disable url rewrite in apache.conf ) , if this won't work then try base_url/index.php/example ( where you can specify base_url by static or with CodeIgniter helpher function )
            xmlhttp.send();
        
    });
    
    $('input[name=rendimiento]').dblclick(function(){
        
            var var_fecha       = $('input[name=fecha]').val();
            var var_portafolios = $('select[name=portafolios]').val();
            var var_valor       = $('input[name=valor]').val();
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('input[name=rendimiento]').val(xmlhttp.responseText);
                   
                }
            }
            var base_url = window.location.pathname;
            xmlhttp.open("GET", "http://localhost"+base_url+"/calculate_rendimiento/" + var_portafolios + "/" + var_valor + "/" + var_fecha, true); 
            xmlhttp.send();

    });
    
});
