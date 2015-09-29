    <?php
    $links = array(
        anchor('resultados/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-hover">' );
    $this->table->set_template($tmpl);
    $this->table->set_heading('ID', 'Fecha', 'Portafolios','Valor','Profit','Rendimiento','','');
    foreach ($results as $result) {
   
        $row = array($result->idresultados, 
                     $result->fecha,
                     $result->portafolios,
                     $result->valor,
                     $result->profit,
                     $result->rendimiento,
                     anchor('resultados/show_editform/'.$result->idresultados,'Edit'),
                     anchor('resultados/delete/'.$result->idresultados,'Borrar')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
