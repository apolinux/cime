<h1>Listar detalle de los horarios</h1>
<p>Nombre del medico: dr tuga</p>
<p>Citas pendientes:</p>
<table width="400" border="1" cellspacing="2">
  <tr>
    <th scope="col">fecha</th>
    <th scope="col">hora</th>
    <th scope="col">paciente</th>
  </tr>
  <tr>
    <td>20/5/2006</td>
    <td>5:30 pm </td>
    <td><p>speedy gonzales</p>    </td>
  </tr>
</table>
<table border="0" cellspacing="5">
  <tr>
    <th scope="col">no.</th>
    <th scope="col">tipo</th>
    <th scope="col">tipo rango </th>
    <th scope="col">horas</th>
    <th scope="col">rango dias</th>
    <th scope="col">dias</th>
    <th scope="col">modificar</th>
  </tr>
  <tr>
    <td>1</td>
    <td>disp</td>
    <td>semanal</td>
    <td>8am a 6 pm </td>
    <td>-</td>
    <td><p>lunes, miercoles, viernes y sabados</p>    </td>
    <td><a href="<?php echo  $PHP_SELF ?>?pag=nuevohormed&mod=1&idhor=15">modificar</a></td>
  </tr>
  <tr>
    <td>2</td>
    <td>no disp </td>
    <td>semanal</td>
    <td>4pm a 5 pm </td>
    <td>-</td>
    <td>lunes, miercoles, viernes y sabados </td>
    <td><a href="<?php echo  $PHP_SELF ?>?pag=nuevohormed&mod=1&idhor=23">modificar</a></td>
  </tr>
</table>
<p>&nbsp;  </p>
