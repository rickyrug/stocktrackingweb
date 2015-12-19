<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<h1>{title}</h1>

<table id="tablalista" border="1" cellpadding="2" cellspacing="1" class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Valor inicial</th>
        <th>Fecha creación</th>
        <th>Portafolios padre</th>
        <th><?php echo anchor('portafolios/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'); ?></th>
        <th>{resultados}</th>
    </tr>
    {portafolios_list}
    <tr>
        <td>{idportafolios}</td>
        <td>{nombre}</td>
        <td>{valorinicial}</td>
        <td>{fechacreacion}</td>
        <td>{portafoliospadre}</td>
        <td><a href="index.php?/portafolios/show_editform/{idportafolios}"><span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span></a></td>
        <td><a href="index.php?/portafolios/delete/{idportafolios}"><span class="glyphicon glyphicon-trash" aria-hidden="true">Borrar</span></a></td>
        
    </tr>
    {/portafolios_list}

</table>
<nav>{paginacion}</nav>

