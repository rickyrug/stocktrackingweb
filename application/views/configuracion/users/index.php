<table id="tablalista" border="1" cellpadding="2" cellspacing="1" class="table table-hover">
    <h1>{title}</h1>
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Active</th>
        <th colspan="2"><?php echo anchor('configuracion/user/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'); ?></th>
    </tr>
    {user_list}
        <tr>
            <td>{id_usuario}</td>
            <td>{username}</td>
            <td>{active}</td>
            <td><a  class="btn btn-default" href="<?php echo $accionchpass ?>/{id_usuario}"><span class="glyphicon glyphicon-edit" aria-hidden="true" title="Cambiar password"></span></a></td>
            <td><a  class="btn btn-default" href="<?php echo $acciondlpass?>/{id_usuario}"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Desactivar"></span></a></td>
        </tr>
    {/user_list}
</table>
