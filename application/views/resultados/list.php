<h1>{title}</h1>

<?php echo form_open('resultados/find_portafolios_results', array('class' => 'form-inline')); ?>
<div class="form-group">
    <input class="form-control" type="text" name="nombreportafolios" value="" placeholder="Nombre de portafolios" /> 
    <input class="btn btn-primary" type="submit" value="Filtrar" />
</div>
</form>
<table id="tablalista" border="1" cellpadding="2" cellspacing="1" class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Portafolios</th>
        <th>Valor</th>
       <!-- <th>Profit</th>
        <th>Rendimiento</th>-->
        <th><?php echo anchor('resultados/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'); ?></th>
        <th>{resultados}</th>
    </tr>
    {resultados_list}
    <tr>
        <td>{idresultados}</td>
        <td>{fecha}</td>
        <td>{portafolios}</td>
        <td>{valor}</td>
        <!--<td>{profit}</td>
        <td>{rendimiento}</td>
        <td><a href="index.php?/resultados/show_editform/{idresultados}"><span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span></a></td>
        <td><a href="index.php?/resultados/delete/{idresultados}"><span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span></a></td>-->
        <td><?php echo anchor('resultados/show_editform/{idresultados}','<span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span>'); ?></td>
        <td><?php echo anchor('resultados/delete/{idresultados}','<span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span>'); ?></td>
    </tr>
    {/resultados_list}

</table>
<nav>{paginacion}</nav>
