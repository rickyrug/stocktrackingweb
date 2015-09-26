    <?php
    $links = array(
        anchor('portafolios/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Nombre', 'Valor inicial','Fecha creación');
    foreach ($results as $result) {
   
        $row = array(form_radio(array('name'=>'idportafolios','id'=>'idportafolios',
                                         'value'=>$result->idportafolios
                                        )), 
                     $result->nombre,
                     $result->valorinicial,
                     $result->fechacreacion
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
