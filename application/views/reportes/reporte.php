   <div class="row">
        <div class="col-md-8">
            <h2><?php echo $titleizquierda; ?></h2>
             <div id="chart_div"></div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <h3> <?php echo $titlederecha; ?></h3>
            </div>
            
            <div class="row">
                <div class="col-md-12 ">
                    <div class="input-group">
                        <span class="input-group-addon">Fecha Inicio</span>
                        <input class="form-control" id="fechaini" type="text" name="fechaini" value="" placeholder="Fecha inicio"/>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="input-group">
                        <span class="input-group-addon">Fecha Final</span>
                        <input class="form-control" id="fechafin" type="text" name="fechafin" value="" placeholder="Fecha fin"/>
                    </div>
                    
                </div>
            </div>
            
             <div class="row">
                <div class="col-md-12 ">
                    <div class="input-group">
                        <span class="input-group-addon">Graficar:</span>
                        <select name="get_param" class="form-control">
                            <option>valor</option>
                            <option>profit</option>
                            <option>rendimiento</option>
                        </select>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="input-group">
                        <span class="input-group-addon">Portafolios:</span>
                        <?php
                        echo form_dropdown('portafolios', $portafolios, '', $dropdownactions);
                        ?>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <input type="button" value="Buscar" onclick="drawChart()"class="btn btn-primary btn-lg btn-block"/>
                </div>
            </div>
            <div class="row">
                <div id="table_candel_info"></div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="<?php echo base_url().'js/grafica.js'; ?>"></script>
