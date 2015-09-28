    <?php
    $links = array(
        anchor('aportacion/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Fecha', 'Portafolios','Valor','Profit','Rendimiento','','');
    foreach ($results as $result) {
   
        $row = array($result->idresultados, 
                     $result->fecha,
                     $result->portafolios,
                     $result->valor,
                     $result->profit,
                     $result->rendimiento,
                     anchor('aportacion/show_editform/'.$result->idaportaciones,'Edit'),
                     anchor('aportacion/delete/'.$result->idaportaciones,'Borrar')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
