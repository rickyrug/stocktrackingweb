<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>{title}</h1>
<hr>

<?php
echo form_open($accion);
echo validation_errors();
?>

<input type="hidden" name="iduser" value="{iduser}" />
<div class="form-group">
    <label for="username" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{username}"/>
    </div>
</div>
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        <input type="password" name="password" value="" id="password" class="form-control"/>

    </div>
</div>
<div class="form-group">
    <label for="copassword" class="col-sm-2 control-label">Confirm - Password</label>
    <div class="col-sm-10">
        <input type="password" name="copassword" value="" id="copassword" class="form-control"/> 
    </div>
</div>
<div class="form-group">
     <label for="activo" class="col-sm-2 control-label"></label>
     <?php echo form_checkbox('activo', 'x', $checked); ?> Activo
    </label>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Guardar</button>
    </div>
</div>
</form>