<div class="row">
    <div class="col-md-9">
   <?php
    echo '<h1>Retiros</h1>';
    $tmpl = array ( 'table_open'  => '<table id="tablalista" border="1" cellpadding="2" cellspacing="1" class="table table-hover">' );
    $this->table->set_template($tmpl);
    $this->table->set_heading('ID', 'Portafolios', 'Cantidad','Fecha'
                              ,anchor('retiros/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>')
                              ,'');
    foreach ($results as $result) {
   
        $row = array($result->idaportaciones, 
                     $result->portafolios,
                     $result->cantidad,
                     $result->fecha, 
                     anchor('retiros/show_editform/'.$result->idaportaciones,'<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>'),
                     anchor('retiros/delete/'.$result->idaportaciones,'<span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span>')
            );
        
        $this->table->add_row($row);        
       
    }
    echo $this->table->generate();
 
    ?>
    </div>
    <div class="col-md-3">
        <h2><?php echo $title; ?></h2>
        <?php echo form_dropdown('portafolios', $portafolios); ?>
    </div>
</div> 