    <?php
    $links = array(
        anchor('retiros/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Portafolios', 'Cantidad','Fecha','');
    foreach ($results as $result) {
   
        $row = array($result->idaportaciones, 
                     $result->portafolios,
                     $result->cantidad,
                     $result->fecha, 
                     anchor('retiros/show_editform/'.$result->idaportaciones,'Edit'),
                     anchor('retiros/delete/'.$result->idaportaciones,'Borrar')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
