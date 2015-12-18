<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>STOCK TRACKER</title>
        <?php
        echo link_tag('bootstrap/css/bootstrap.min.css');
        echo link_tag('bootstrap/css/dashboard.css');
        echo link_tag('bootstrap/css/mystyle.css');
        ?>
        <script src="<?php echo base_url() . 'js/jquery/jquery.js'; ?>"></script>
        <script src="<?php echo base_url() . 'js/jqueryui/jqueryui.js'; ?>"></script>
        <script src="<?php echo base_url() . 'js/jquery/jquery.tablesorter.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'js/jquery/jquery.tablesorter.widgets.min.js'; ?>"></script>
        <script src="<?php echo base_url() . 'js/listfunctions.js'; ?>"></script>       
        <script src="<?php echo base_url() . 'js/datepicker.js'; ?>"></script>
    </head>
    <?php  
          echo form_open($accion);       
          echo validation_errors();
    ?>
    <div class="container">
        <h2 class="">Stocktracker Login</h2>
        <input class="form-control" type="text" name="username" value="" placeholder="Username"/>
        <input class="form-control" type="password" name="password" value="" placeholder="Password"/>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </div>
   <?php  echo form_close();       ?>
</div>
</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url() . 'js/jquery/jquery.js'; ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url() . 'bootstrap/js/bootstrap.min.js'; ?>"></script>
</body>
</html>

