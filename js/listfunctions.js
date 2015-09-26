/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('input:radio').click(function () {
     
    window.location.href = 'http://localhost/stocktraking/index.php/portafolios/show_editform/'+$(this).val();
    })
});
