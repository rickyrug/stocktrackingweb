<div class="row">
    <h1>Resultados</h1>
</div>  
<div class="row">
    <?php echo form_open($accion, array('class' => 'form-inline')); ?>
    <div class="form-group">
            <input class="form-control" type="text" name="nombreportafolios" value="" placeholder="Nombre de portafolios" /> 
            <input class="btn btn-primary" type="submit" value="Filtrar" />
    </div>
   
</div>
<?php
echo form_close();
//    echo '<h1>Resultados</h1>';
$tmpl = array('table_open' => '<table border="1" cellpadding="2" cellspacing="1" class="table table-hover">');
$this->table->set_template($tmpl);
$this->table->set_heading('ID', 'Fecha', 'Portafolios', 'Valor', 'Profit', 'Rendimiento', anchor('resultados/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'), '');
foreach ($results as $result) {

    $row = array($result->idresultados,
        $result->fecha,
        $result->portafolios,
        $result->valor,
        $result->profit,
        $result->rendimiento,
        anchor('resultados/show_editform/' . $result->idresultados, '<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>'),
        anchor('resultados/delete/' . $result->idresultados, '<span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span>')
    );

    $this->table->add_row($row);
}
echo $this->table->generate();

?>