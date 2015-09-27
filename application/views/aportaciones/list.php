    <?php
    $links = array(
        anchor('aportacion/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Portafolios', 'Cantidad','Fecha','');
    foreach ($results as $result) {
   
        $row = array($result->idaportaciones, 
                     $result->portafolios,
                     $result->cantidad,
                     $result->fecha, 
                     anchor('aportacion/show_editform/'.$result->idaportaciones,'Edit')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
