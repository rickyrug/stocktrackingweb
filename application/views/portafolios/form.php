<?php

if (isset($error)) {
    echo var_dump($error);
}
echo form_open($accion);
if (isset($idportafolios)) {
    echo form_hidden($idportafolios);
}
echo form_label($labelnombre);
echo form_input($nombre);
echo form_label($labelvalorinicial);
echo form_input($valorinicial);
echo form_label($labelfechacreacion);
echo form_input($fechacreacion);
echo form_submit($btnguardar['guardar'], $btnguardar['guardar']);
echo form_close();
?>
    