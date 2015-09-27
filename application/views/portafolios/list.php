    <?php
    $links = array(
        anchor('portafolios/show_addform', 'Agregar')
    );
    
    echo ul($links);
    $this->table->set_heading('ID', 'Nombre', 'Valor inicial','Fecha creación','');
    foreach ($results as $result) {
   
        $row = array($result->idportafolios, 
                     $result->nombre,
                     $result->valorinicial,
                     $result->fechacreacion,
                     anchor('portafolios/show_editform/'.$result->idportafolios,'Edit')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
