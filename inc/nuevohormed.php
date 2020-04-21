<?php 

$codigo = $_GET['codigo'];
$medico1 = new medico;

$hora1= new hora;
?>
<h1>Ingresar Horario de M&eacute;dico</h1>
<form name="form1" method="post" action="">
  <table border="0" cellspacing="2">
    <tr>
      <td width="124">Nombre del m&eacute;dico:</td>
      <td width="98"><!-- <input type="text" name="textfield"> -->
	  <strong><?php echo  $medico1->nombre($codigo);?></strong>
	  </td>
      <td width="111">&nbsp;</td>
      <td width="91">&nbsp;</td>
    </tr>
    <tr>
      <td>Tipo de horario </td>
      <td><label>
        <input name="tipo" type="radio" value="disponible" checked>
disponible</label>
        <br>
        <label>        </label></td>
      <td><input type="radio" name="tipo" value="no_disponible">
no disponible</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">Escoja la categor&iacute;a del horario:</td>
      <td><input name="categoria" type="radio" value="semanal" checked>
Semanal</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><p>
          <input name="lunes" type="checkbox" value="lunes" checked>
        Lunes<br>
        <input name="martes" type="checkbox" id="dias" value="martes" checked>
        Martes<br>
        <input name="miercoles" type="checkbox" id="dias" value="miercoles" checked>
        Mi&eacute;rcoles
        <br>
      </p>        </td>
      <td><input name="jueves" type="checkbox" id="dias" value="jueves" checked>      
        Jueves<br>
        <input name="viernes" type="checkbox" id="dias" value="viernes" checked>
        Viernes<br>
        <input name="sabado" type="checkbox" value="checkbox">
      S&aacute;bado</td><td valign="top">
          <input type="checkbox" name="domingo" value="checkbox">
        Domingo
        </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td><input name="categoria" type="radio" value="rango_dias">
Por rango de d&iacute;as</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Fecha Inicial </td>
      <td><input name="fecha_in" type="text" id="fecha_in" size="10">
      <input type="button" name="boton1" value="ver" id="boton_fecha_in" ></td>
      <td align="right">Fecha Final </td>
      <td><input name="fecha_fin" type="text" id="fecha_fin" size="10">
      <input type="button" name="boton2" value="ver" id="boton_fecha_fin"></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Hora Inicial </td>
      <td>
	  <select name="hora_in">
	  <?php echo  $hora1->verRango(); ?>
	  </select></td>
      <td align="right">Hora final </td>
      <td><select name="hora_fin" >
	  <?php echo  $hora1->verRango(); ?>
	  </select></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "fecha_in",         // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format
      button      : "boton_fecha_in" ,      // ID of the button
	  flatCallback : dateChanged,          // our callback function
      dateStatusFunc : ourDateStatusFunc
    }
  ); 
   Calendar.setup(
    {
      inputField  : "fecha_fin",         // ID of the input field
      ifFormat    : "%d-%m-%Y",    // the date format
      button      : "boton_fecha_fin" ,      // ID of the button
	  flatCallback : dateChanged,          // our callback function
      dateStatusFunc : ourDateStatusFunc
    }
  ); 
</script>
<p><a href="<?php echo  $PHP_SELF ?>?pag=confirmmed">Ingresar</a></p>
<h2>Horario m&eacute;dico</h2>
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
    <td><p>lunes, miercoles, viernes y sabados</p></td>
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
