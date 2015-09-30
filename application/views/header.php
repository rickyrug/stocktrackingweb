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
        ?>
        <script src="<?php echo base_url().'js/jquery/jquery.js'; ?>"></script>
        <script src="<?php echo base_url().'js/jquery/jquery.tablesorter.min.js'; ?>"></script>
        <script src="<?php echo base_url().'js/jquery/jquery.tablesorter.widgets.min.js'; ?>"></script>
        <script src="<?php echo base_url().'js/listfunctions.js'; ?>"></script>
        
    </head>
    <body>
    <body>
        <!-- START TOP MENU -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Stock Tracker</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                </div>
            </div>
        </nav>
        <!-- END TOP MENU -->
        <div class="container-fluid">
            <div class="row">
                <!--START SIDE BAR -->
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li><h4>Portafolios</h4></li>
                        <li role="separator" class="divider"></li>
                        <li><?php echo anchor("portafolios",'Gestion'); ?></li>
                        <li><a href="#">Reportes</a></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><h4>Operaciones</h4></li>
                        <li><?php echo anchor("aportacion",'Aportaciones'); ?></li>
                        <li><?php echo anchor("retiros",'Retiros'); ?></li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li><h4>Resultados</h4></li>
                        <li><?php echo anchor("resultados",'Gestion'); ?></li>
                        <li><?php echo anchor('reportes', 'Reportes') ?></li>
                    </ul>
                </div>
                <!--END SIDE BAR -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">  
                    