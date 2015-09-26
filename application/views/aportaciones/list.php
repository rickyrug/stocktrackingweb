    <?php
    $links = array(
        anchor('aportaciones/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Portafolios', 'Monto','Fecha');
    foreach ($results as $result) {
   
        $row = array(form_radio(array('name'=>'idaportaciones','id'=>'idaportaciones',
                                         'value'=>$result->idaportaciones
                                        )), 
                     $result->portafolios,
                     $result->monto,
                     $result->fecha
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
