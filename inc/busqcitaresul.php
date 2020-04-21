<h1>Resultado de la busqueda</h1>
<table border="2" cellspacing="1">
  <tr>
    <th scope="col">No. Cita </th>
    <th scope="col">Paciente</th>
    <th scope="col">M&eacute;dico</th>
    <th scope="col">Fecha</th>
    <th scope="col">Hora</th>
    <th scope="col">modificar</th>
  </tr>
  <tr>
    <td>12345</td>
    <td>pepito perez </td>
    <td>dr tazo </td>
    <td>10/2/2006</td>
    <td>10:35am</td>
    <td><a href="<?php echo  $PHP_SELF ?>?pag=modcita&cita=12345">modificar</a></td>
  </tr>
  <tr>
    <td>23456</td>
    <td>juan jose </td>
    <td>dr tuga </td>
    <td>20/7/2006</td>
    <td>6:00pm</td>
    <td><p><a href="<?php echo  $PHP_SELF ?>?pag=modcita&cita=12345">modificar</a></p>    </td>
  </tr>
  <tr>
    <td>34667</td>
    <td>carlos arce </td>
    <td>dr caza </td>
    <td>14/08/2006</td>
    <td>8:00 am </td>
    <td><a href="<?php echo  $PHP_SELF ?>?pag=modcita&cita=12345">modificar</a></td>
  </tr>
  <tr>
    <td>...</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p><a href="exportar?tipo=cvs&info=xxxxx">exportar a cvs</a><br>
  <a href="exportar?tipo=excek&info=xxxxx">exportar a excel
</a></p>
<p>&nbsp; </p>
