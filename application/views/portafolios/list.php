    <?php
    $links = array(
        anchor('portafolios/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="table table-hover">' );
    $this->table->set_template($tmpl);
    $this->table->set_heading('ID', 'Nombre', 'Valor inicial','Fecha creación','Portafolios padre','');
    foreach ($results as $result) {
   
        $row = array($result->idportafolios, 
                     $result->nombre,
                     $result->valorinicial,
                     $result->fechacreacion,
                     $result->portafoliospadre,
                     anchor('portafolios/show_editform/'.$result->idportafolios,'Edit')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
