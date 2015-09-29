    <?php
    echo '<h1>Portafolios</h1>';
    $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-hover">' );
    $this->table->set_template($tmpl);
    $this->table->set_heading('ID', 'Nombre', 'Valor inicial','Fecha creación','Portafolios padre',
              anchor('portafolios/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'));
    foreach ($results as $result) {
   
        $row = array($result->idportafolios, 
                     $result->nombre,
                     $result->valorinicial,
                     $result->fechacreacion,
                     $result->portafoliospadre,
                     anchor('portafolios/show_editform/'.$result->idportafolios,'<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
