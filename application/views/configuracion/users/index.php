<h2>{title}</h2>
<table id="tablalista" border="1" cellpadding="2" cellspacing="1" class="table table-hover">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Active</th>
        <th><?php echo anchor('configuracion/user/show_addform', '<span class="glyphicon glyphicon-plus" aria-hidden="true">Add</span>'); ?></th>
    </tr>
    {user_list}
    <tr>
        <td>{id_usuario}</td>
        <td>{username}</td>
        <td>{active}</td>
        <td><a href="index.php?/configuracion/user/show_editform/{id_usuario}"><span class="glyphicon glyphicon-pencil" aria-hidden="true">Edit</span></a></td>
    </tr>
    {/user_list}
</table>
