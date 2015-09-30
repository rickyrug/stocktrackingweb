    <?php
    echo base_url();
    echo '<h1>Aportaciones</h1>';
    $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-hover">' );
    $this->table->set_template($tmpl);
    $this->table->set_heading('ID', 'Portafolios', 'Cantidad','Fecha',
                             anchor('aportacion/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'),
                             '');
    foreach ($results as $result) {
   
        $row = array($result->idaportaciones, 
                     $result->portafolios,
                     $result->cantidad,
                     $result->fecha, 
                     anchor('aportacion/show_editform/'.$result->idaportaciones,'<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>'),
                     anchor('aportacion/delete/'.$result->idaportaciones,'<span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span>')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
