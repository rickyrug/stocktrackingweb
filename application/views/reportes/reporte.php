<div class="row">
    <div class="col-md-8">
        <h2><?php echo $titleizquierda; ?></h2>
        <div id="chart_div"></div>
    </div>
    <div class="col-md-4">
        <h3> <?php echo $titlederecha; ?></h3>
        <table>
            <tbody>
                <tr>
                    <td><input id="fechaini" type="text" name="fechaini" value="" placeholder="Fecha inicio"/></td>
                    <td><input id="fechafin" type="text" name="fechafin" value="" placeholder="Fecha fin"/></td>
                </tr>
                <tr>
                    <td><h4>Portafolios:</h4></td>
                    <td> 
                        <?php
                        echo form_dropdown('portafolios', $portafolios,'',$dropdownactions);
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" id="table_candel_info">
                        

                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
</div> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="<?php echo base_url().'js/grafica.js'; ?>"></script>
