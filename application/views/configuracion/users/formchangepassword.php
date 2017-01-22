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
        
        <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="{username}" readonly="readonly" disabled="disabled"/>
    </div>
</div>
<!--<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Old Password</label>
    <div class="col-sm-10">
        <input type="password" name="oldpassword" value="" id="password" placeholder="Password" class="form-control"/>

    </div>
</div>-->
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        <input type="password" name="newpassword" value="" id="password" placeholder="Password" class="form-control"/>
    </div>
</div>
<div class="form-group">
    <label for="copassword" class="col-sm-2 control-label">Confirm - Password</label>
    <div class="col-sm-10">
        <input type="password" name="copassword" value="" id="copassword" placeholder="Co - Password" class="form-control"/> 
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-lg btn-primary btn-block">Guardar</button>
    </div>
</div>
</form>