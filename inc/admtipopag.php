<h1>Administrar tipos de p&aacute;ginas</h1>
<h2>Crear nuevo tipo de p&aacute;gina </h2>
<form name="form1" method="post" action="">
  <p>nombre del tipo 
    <input type="text" name="textfield">
  </p>
  <p>Seleccione las p&aacute;ginas correspondientes del tipo a crear:</p>
  <table border="0" cellspacing="5">
    <tr>
      <td scope="col"><input type="checkbox" name="checkbox" value="checkbox"></td>
      <td scope="col">busqcita</td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox2" value="checkbox"></td>
      <td>busqcitaresul</td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox3" value="checkbox"></td>
      <td>busqhormed</td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox4" value="checkbox"></td>
      <td>confirmcita</td>
    </tr>
  </table>
  <p>
    <input type="submit" name="Submit" value="crear"> 
    </p>
</form>
El tipo de p&aacute;gina xxxx fu&eacute; creado exitosamente. 
<h2>Lista de tipos de p&aacute;gina </h2>
<form name="form2" method="post" action="">
  <table width="600" border="0" cellspacing="5">
    <tr>
      <th rowspan="2" scope="col">tipo de p&aacute;gina </th>
      <th scope="col">seleccione las paginas por tipo </th>
      <th rowspan="2" scope="col">modificar</th>
      <th rowspan="2" scope="col">borrar</th>
    </tr>
    <tr>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td>consulta de citas </td>
      <td>busqcita, busqcitaresul</td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
    <tr>
      <td>solicita citas </td>
      <td>solcita,</td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
    <tr>
      <td>asigna citas </td>
      <td>confirmcita</td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
    <tr>
      <td>asigna horarios medicos</td>
      <td>busqhormed</td>
      <td><a href="#">modificar</a></td>
      <td><a href="#">borrar</a></td>
    </tr>
  </table>
</form>
Esta secci&oacute;n es opcional y aparece cuando se hace click en modificar arriba:
<h2>Modificar tipos de p&aacute;gina xxxx</h2>
<p>Seleccione las p&aacute;ginas que pertenecen a este tipo de p&aacute;gina </p>
<form name="form3" method="post" action="">
  <table width="600" border="0" cellspacing="5">
    <tr>
      <td><input type="checkbox" name="checkbox5" value="checkbox">
      busqcita</td>
      <td><input type="checkbox" name="checkbox52" value="checkbox">
      busqcitaresul</td>
      <td><input type="checkbox" name="checkbox53" value="checkbox">
      busqhormed</td>
      <td><input type="checkbox" name="checkbox54" value="checkbox">
      confirmcita</td>
      <td><input type="checkbox" name="checkbox517" value="checkbox">
      escojemedico</td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox55" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox56" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox57" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox58" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox518" value="checkbox"></td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox59" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox510" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox511" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox512" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox519" value="checkbox"></td>
    </tr>
    <tr>
      <td><input type="checkbox" name="checkbox513" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox514" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox515" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox516" value="checkbox"></td>
      <td><input type="checkbox" name="checkbox520" value="checkbox"></td>
    </tr>
  </table>
</form>
<p>El tipo de pagina xxxxx fue modificado exitosamente. </p>
<p>&nbsp; </p>
<p>&nbsp;</p>
