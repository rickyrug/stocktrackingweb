<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>{title}</h1>
<hr>

<?php
echo form_open($accion);
echo validation_errors();
?>

<input type="hidden" name="idportafolios" value="{idportafolios}" />
<div class="form-group">
    <label for="inputNombre" class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="inputNombre" placeholder="Nombre" name="nombre" value="{nombre}">
    </div>
</div>
<div class="form-group">
    <label for="inputValor" class="col-sm-2 control-label">Valor inicial</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="inputValor" placeholder="Valor inicial" value="{valorinicial}" name="valorinicial">
    </div>
</div>
<div class="form-group">
    <label for="inputFecha" class="col-sm-2 control-label">Fecha</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="inputFecha" placeholder="Fecha" value="{fechacreacion}" name="fechacreacion">
    </div>
</div>
<div class="form-group">
    <label for="inputPortafolios" class="col-sm-2 control-label">Portafolios</label>
    <div class="col-sm-10">
        <?php
        if (isset($selectedPortafolios)) {
            echo form_dropdown('portafolios', $portafolios, $selectedPortafolios, 'id="inputPortafolios" class="form-control "');
        } else {
            echo form_dropdown('portafolios', $portafolios, '', 'id="inputPortafolios" class="form-control "');
        }
        ?>
    </div>
</div> 
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Guardar</button>
    </div>
</div>
</form>