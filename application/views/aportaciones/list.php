<h1>{title}</h1>

<table id="tablalista" border="1" cellpadding="2" cellspacing="1" class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Portafolios</th>
        <th>Cantidad</th>
        <th>Fecha</th>
        <th><?php echo anchor('aportacion/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'); ?></th>
        <th>{resultados}</th>
    </tr>
    {aportaciones_list}
    <tr>
        <td>{idaportaciones}</td>
        <td>{portafolios}</td>
        <td>{cantidad}</td>
        <td>{fecha}</td>
        <td><a href="index.php?/aportacion/show_editform/{idaportaciones}"><span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span></a></td>
        <td><a href="index.php?/aportacion/delete/{idaportaciones}"><span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span></a></td>
        
    </tr>
    {/aportaciones_list}

</table>
<nav>{paginacion}</nav>
