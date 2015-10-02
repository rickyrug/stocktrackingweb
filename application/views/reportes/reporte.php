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
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"> Portafolios:<?php
                        echo form_dropdown('portafolios', $portafolios,'',$dropdownactions);
                        ?>
                    </td>
                    <td>
                        
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
