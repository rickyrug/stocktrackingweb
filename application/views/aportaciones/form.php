<?php
if (isset($error)) {
    echo var_dump($error);
}
echo form_open($accion);
if (isset($idoperacion)) {
    echo form_hidden($idoperacion);
}
if(isset($ididoperacion_delete)){
    $linkborrar = 'aportacion/delete/'.$idoperacion_delete;
    echo anchor($linkborrar,"Borrar");
}

if(isset($selectedPortafolios)){
    
}

echo form_label($labelportafolios);
echo form_dropdown('portafolios', $portafolios);
echo form_label($labelcantidad);
echo form_input($cantidad);
echo form_label($labelfecha);
echo form_input($fecha);
echo form_submit($btnguardar['guardar'], $btnguardar['guardar']);


echo form_close();
?>
