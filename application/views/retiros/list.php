    <?php
    $links = array(
        anchor('retiros/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-hover">' );
    $this->table->set_template($tmpl);
    $this->table->set_heading('ID', 'Portafolios', 'Cantidad','Fecha','','');
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
