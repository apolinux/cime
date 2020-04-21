<h1>Administrar tipos de usuario </h1>
<h2>Crear nuevo tipo de usuario</h2>
<form name="form1" method="post" action="">
  <p>nombre del tipo 
    <input type="text" name="textfield">
  </p>
  <p>Permisos sobre tipos de p&aacute;ginas</p>
  <table border="0" cellspacing="5">
    <tr>
      <td scope="col"><input type="checkbox" name="checkbox" value="checkbox"></td>
      <td scope="col">consultar citas </td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox2" value="checkbox"></td>
      <td>solicitar citas </td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox3" value="checkbox"></td>
      <td>asignar citas </td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox4" value="checkbox"></td>
      <td>asignar horarios m&eacute;dicos</td>
    </tr>
  </table>
  <p>
    <input type="submit" name="Submit" value="crear"> 
    </p>
</form>
El tipo de usuario xxxx fu&eacute; creado exitosamente. 
<h2>Lista de tipos de usuario</h2>
<form name="form2" method="post" action="">
  <table width="600" border="0" cellspacing="5">
    <tr>
      <th rowspan="2" scope="col">tipo de usuario</th>
      <th colspan="4" scope="col">tipos de paginas </th>
      <th rowspan="2" scope="col">modificar</th>
      <th rowspan="2" scope="col">borrar</th>
    </tr>
    <tr>
      <th scope="col">consulta citas</th>
      <th scope="col">solicita citas</th>
      <th scope="col">asigna citas</th>
      <th scope="col">asigna horarios medicos</th>
    </tr>
    <tr>
      <td>administrativo</td>
      <td><input name="checkbox5" type="checkbox" value="checkbox" checked></td>
      <td><input name="checkbox52" type="checkbox" value="checkbox" checked></td>
      <td><input name="checkbox53" type="checkbox" value="checkbox" checked></td>
      <td><input name="checkbox54" type="checkbox" value="checkbox" checked></td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
    <tr>
      <td>medico</td>
      <td><input name="checkbox55" type="checkbox" value="checkbox" checked></td>
      <td><input type="checkbox" name="checkbox56" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox57" value="checkbox"></td>
      <td><input name="checkbox58" type="checkbox" value="checkbox" checked></td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
    <tr>
      <td>paciente</td>
      <td><input type="checkbox" name="checkbox59" value="checkbox"></td>
      <td><input name="checkbox592" type="checkbox" value="checkbox" checked></td>
      <td><input type="checkbox" name="checkbox593" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox594" value="checkbox"></td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
    <tr>
      <td>asistente</td>
      <td><input name="checkbox598" type="checkbox" value="checkbox" checked></td>
      <td><input type="checkbox" name="checkbox595" value="checkbox"></td>
      <td><input name="checkbox596" type="checkbox" value="checkbox" checked></td>
      <td><input type="checkbox" name="checkbox597" value="checkbox"></td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
  </table>
</form>
<p>El tipo de usuario xxxxx fue modificado exitosamente. </p>
<p>&nbsp; </p>
<p>&nbsp;</p>
