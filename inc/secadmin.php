<h1>Administracion de usuarios </h1>
<p><a href="<?php echo  $PHP_SELF ?>?pag=seccrearusr">Crear usuario </a></p>
<p>Lista de usuarios</p>
<table border="1" cellspacing="2">
  <tr>
    <th scope="col">usuario</th>
    <th scope="col">tipo</th>
    <th scope="col">permisos</th>
    <th scope="col">estado</th>
    <th scope="col">logueado</th>
    <th scope="col">eliminar</th>
  </tr>
  <tr>
    <td>pepito</td>
    <td>normal</td>
    <td>asistente</td>
    <td>activo</td>
    <td>no</td>
    <td><a href="<?php echo  $PHP_SELF ?>?pag=secadmin&accion=elim&login=pepito">eliminar</a></td>
  </tr>
  <tr>
    <td>admin</td>
    <td>administrador</td>
    <td>admin</td>
    <td>activo</td>
    <td>si</td>
    <td>eliminar</td>
  </tr>
  <tr>
    <td>carlosg</td>
    <td>normal</td>
    <td>paciente</td>
    <td>activo</td>
    <td><p>no</p>    </td>
    <td><p><a href="<?php echo  $PHP_SELF ?>?pag=secadmin&accion=elim&login=carlosg">eliminar</a></p>    </td>
  </tr>
</table>
<p>&nbsp; </p>
