<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body>
<p>Escoje medico</p>
<form name="form1" method="post" action="">
  <table border="0" cellspacing="1">
    <tr>
      <td>Seleccione el medico</td>
      <td><select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
        <option>medico1</option>
        <option>medico2</option>
            </select>      </td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="submit" name="Submit" value="Enviar"></td>
    </tr>
  </table>
</form>
<p>Lista de Citas del paciente X </p>
<table width="300" border="0" cellspacing="5">
  <tr>
    <th scope="col">citas</th>
  </tr>
  <tr>
    <td>cita1</td>
  </tr>
  <tr>
    <td>cita2</td>
  </tr>
  <tr>
    <td>...</td>
  </tr>
</table>
</body>
</html>
