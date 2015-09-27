    <?php
    $links = array(
        anchor('aportacion/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Portafolios', 'Cantidad','Fecha');
    foreach ($results as $result) {
   
        $row = array(form_radio(array('name'=>'idaportaciones','id'=>'idaportaciones',
                                         'value'=>$result->idaportaciones
                                        )), 
                     $result->portafolios,
                     $result->cantidad,
                     $result->fecha
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
