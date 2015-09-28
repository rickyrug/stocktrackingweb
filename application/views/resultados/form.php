<?php

if (isset($error)) {
    echo var_dump($error);
}
echo form_open($accion);
if (isset($idresultados)) {
    echo form_hidden($idresultados);
}
if (isset($idresultados_delete)) {
    $linkborrar = 'resultados/delete/' . $idresultados_delete;
    echo anchor($linkborrar, "Borrar");
}

echo form_label($labelfecha);
echo form_input($fecha);

echo form_label($labelportafolios);
if (isset($selectedPortafolios)) {
    echo form_dropdown('portafolios', $portafolios, $selectedPortafolios);
} else {
    echo form_dropdown('portafolios', $portafolios);
}
echo form_label($labelvalor);
echo form_input($valor);
echo form_label($labelprofit);
echo form_input($profit);
echo form_label($labelrendimiento);
echo form_input($rendimiento);
echo form_submit($btnguardar['guardar'], $btnguardar['guardar']);


echo form_close();
?>
