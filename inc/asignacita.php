<?php 
foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		//echo "$nombre => $valor   ";
		$$nombre=$valor;
		}
//obtener el listado de medicos
$arr_listmed = Medico::listarMedicos();
//print_r($arr_listmed);

$cod_med='';
$hora_cita = '';
$nombre_med ='';


if (isset($cod_cita) and $cod_cita != ''){ //caso de modificacion  
	//echo "cod cita= $cod_cita<br>";
	$arr_datos = Cita::datos($cod_cita);
	$fecha_cita_orig=$arr_datos['fecha'];
	$hora_cita = $arr_datos['hora_in'];
	$cod_med = $arr_datos['cod_med'];
	$cod_pac = $arr_datos['cod_pac'];
	$estado_cita = $arr_datos['estado'];
	$nombre_med = Medico::nombre($cod_med);
	//echo "Cita Actual: M&eacute;dico:$nombre_med, Fecha:$fecha_cita_orig, hora_cita:$hora_cita.<br>";
	if (!isset($fecha_cita)){
		$fecha_cita=$fecha_cita_orig;
		}
	}
if (empty($fecha_cita)){
	$fecha_cita = date("Y-m-d");
	}

if ( empty($cod_pac) )
{
	echo "El paciente no existe.";
	return;
}

?>
<script>
function asignaCita(id_obj,id_hora,id_medico,val_hora,val_medico,obj_nombre,id_nomb_med){
	var obj = document.getElementById(id_obj);
	var hora = document.getElementById(id_hora);
	var medico = document.getElementById(id_medico);	
	var nomb_med = document.getElementById(id_nomb_med);
	if (obj.title == 'Disp'){
		//buscar otros elementos que esten seleccionados
		// y resetear su valor
		if (obj.innerHTML != "X") {
			vaciarEstados();
			obj.innerHTML = "X";
			hora.value =val_hora;
			medico.value = val_medico;
			nomb_med.innerHTML = obj_nombre[val_medico];
			}
		else {
			obj.innerHTML = "&nbsp;";
			hora.value ='';
			medico.value = '';
			nomb_med.innerHTML = '';
			}
		}
	}
function vaciarEstados()
	{
	var spanes = document.getElementsByTagName('span');
	for ( var i=0; i < spanes.length ; i++){
		var re = /^hm_/
		//alert('i ='+i+',spanes_i='+spanes[i].id+',test=' +re.test(spanes[i].id));return;
		if ( re.test(spanes[i].id)){
			spanes[i].innerHTML ='&nbsp;';
			}
		}
	}
function validarCita(id_forma,id_hora,id_medico,accion)
	{
	forma = document.getElementById(id_forma);
	hora = document.getElementById(id_hora);
	medico = document.getElementById(id_medico);
	if (hora.value == '' || medico.value == ''){
		alert('No ha escogido ningun horario.');
		return false;
		}
	else {
		if (accion == 'modcita'){
			forma.action += '&pag=confirmcita&_accion=modcita';
			}
		else {
	  	forma.action += '&pag=confirmcita&_accion=asignarcita';
			}
		forma.submit();
		}
	}
</script>
<?php 
if ($_accion == 'modcita') {
	$mensaje1='Modificar Cita';
	}
else {
	$mensaje1='Nueva Cita';
	}
?>

<h1><?php echo  $mensaje1 ?></h1> 
<?php 
$medico = new Medico();
if (!isset($cod_pac) and !isset($cod_cita)):
?>
Por favor <span onClick="ir_a('<?php echo  "$PHP_SELF?pag=admpac" ?>');" class="span_enlace">escoja</span> un paciente primero.
<?php 
elseif  (sizeof($arr_listmed) <= 0) : ?>
No hay medicos en el sistema. <?php echo  enlace('Crear medico','admmed') ?>
<?php 
elseif ($medico->algunHorario() == 0 ) : ?>
No existen horarios disponibles para alg&uacute;n m&eacute;dico.
<?php 
else : ?>
Nombre del paciente: <strong><?php echo  paciente::nombre($cod_pac) ?></strong><br>
<?php 
	if (isset($cod_cita) and $cod_cita != ''){ //caso de modificacion
		echo "Cita Actual: M&eacute;dico:$nombre_med, Fecha:$fecha_cita_orig, hora_cita:$hora_cita.<br>";
		}
 ?>
Escoja la cita : 

  <table border="0" cellspacing="0" cellpadding="0">
 <form name="form1" method="post" action="<?php echo  "$PHP_SELF?x=0" ?>" id="forma1">   <tr>
      <td  >fecha:</td>
      <td><input type="text" name="fecha_cita" id="fecha_cita" value ="<?php echo  $fecha_cita ?>" size="8" maxlength="10"></td>
     <td align="right" >&nbsp;hora: </td>
      <td><input type="text" name="hora_cita" id="hora_cita" value="<?php echo  $hora_cita ?>" size="5" maxlength="8"></td> 
      
     <td align="right" >&nbsp;Nombre del M&eacute;dico: </td>
      <td>&nbsp;<span id="nombre_med"><?php echo  ( $nombre_med ? $nombre_med : 'No Asignado'); ?></span>
      </td> 
      
	</tr>
<input name="cod_med" type="hidden" value="<?php echo  $cod_med ?>" id="cod_med">
<input name="cod_pac" type="hidden" value="<?php echo  $cod_pac ?>" id="cod_pac">
<input name="cod_cita" type="hidden" value="<?php echo  ($cod_cita ?? '') ?>" id="cod_pac">
</form> </table><br>

<div id="calendar-container" style=" width: 220"></div>
<script type="text/javascript">
   function dateChanged(calendar) {
    // Beware that this function is called even if the end-user only
    // changed the month/year.  In order to determine if a date was
    // clicked you can use the dateClicked property of the calendar:
    if (calendar.dateClicked) {
      // OK, a date was clicked, redirect to /yyyy/mm/dd/index.php
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth() + 1;     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31
      var fecha = document.getElementById('fecha_cita');
	  var forma  = document.getElementById('forma1');
	  fecha.value = y + '-' + m + '-' + d;
	  forma.action += '&pag=<?php echo  $_ESTAPAG ?>&_accion=<?php echo  $_accion ?>' + '#tabla_horario';
	  forma.submit();
    }
  }; 
var fecha_i = new Date(<?php echo  Fecha::fechaAabs($fecha_cita)*1000 ?>);
  Calendar.setup(
    { 
	  date : fecha_i,
      flat         : "calendar-container" , // ID of the parent element
      flatCallback : dateChanged           // our callback function
    }
  );
</script>
<br>
<div id="tabla_horario">
Escoja el horario. Solo estan habilitados para activar la cita los recuadros verdes. Los amarillos son los horarios de no disponibilidad.<br>
<table width="550" border="1" cellspacing="0" cellpadding="0" class="borde_delgado">
  <tr>
    <th width="100" rowspan="2" scope="col"  class="borde_delgado">Lista M&eacute;dicos</th>
<?php 
//print_r($arr_listmed);
$hora2=$CITAS_MEDICAS['_HORA_IN']; 
$count_horas = 0;
$arr_horas = array();
$num_am=$num_pm=0;
while(hora::horAseg($hora2) <= hora::horAseg($CITAS_MEDICAS['_HORA_FIN']) ):	
	if (hora::horAseg($hora2) < hora::horAseg("12:00:00")){
		$num_am++;
		}
	else if (hora::horAseg($hora2) > hora::horAseg("12:00:00")){
		$num_pm++;
		}
	$arr_horas[$count_horas] = $hora2; 
	$hora2 = hora::sumar($hora2,"1:00:00");
	$count_horas++;
	endwhile;  ?>
  
    <td scope="col" colspan="<?php echo  $num_am; ?>" align="center" class="borde_delgado"><span class="span_chico">AM</span></td>
	<td scope="col"  align="center" class="borde_delgado"><span class="span_chico">M</span></td>
	<td scope="col" colspan="<?php echo  $num_pm; ?>" align="center" class="borde_delgado"><span class="span_chico">PM</span></td>
  </tr>
   <tr>
  <?php 
for($i=0;$i< count($arr_horas) ; $i++) : ?>
    <td width="22" scope="col" align="center"
	 class="borde_delgado"><span class="span_chico"><?php echo  hora::verHora($arr_horas[$i],'12.1') ?></span></td>
<?php endfor; ?>	
  </tr>
 
<?php 
$obj_js = "<script>\nvar nomb_med = Array();\n";
//$cont_x = 0;
//echo " cuenta:".count(array_keys($arr_listmed));
for($i = 0 ; $i < count(array_keys($arr_listmed)) ; $i++) :
	$nombre_med1 = $arr_listmed[$i]['nombre'];
	$cod_med1 = $arr_listmed[$i]['codigo'];
	$obj_js .= "nomb_med[$cod_med1] = '$nombre_med1';\n";
	//obtener las citas del medico
	$arr_citas = Cita::Buscar($cod_med1,$fecha_cita);
	//obtener el horario del medico
	$arr_horarios = Medico::HorarioMed($cod_med1,$fecha_cita);
?>
  <tr>
  	<td class="borde_delgado"><?php echo  $nombre_med1 ?></td>
	<?php for ($j = 0 ; $j < $count_horas; $j++) :
		$id = "hm_$i"."_$j";
		if ($arr_horarios[$arr_horas[$j]]){
			$color =$CITAS_MEDICAS['COLOR_HOR_DISP'];
			$estado = "Disp";
			}
		else {
			$color =$CITAS_MEDICAS['COLOR_HOR_NODISP'];
			$estado = "NoDisp";
			}
		if ($hora_cita == $arr_horas[$j] and $nombre_med == $nombre_med1 ){
			$mostrar_x = 'X';
			//$cont_x ++;
			}
		else {
			$mostrar_x = '&nbsp';
			}
	?>
	<td bgcolor="<?php echo  $color ?>"  class="borde_delgado"
	onClick="asignaCita('<?php echo  $id ?>','hora_cita','cod_med','<?php echo  $arr_horas[$j] ?>',<?php echo  $cod_med1 ?>,nomb_med,'nombre_med');"
	align="center"><span title="<?php echo  $estado ?>" id="<?php echo  "$id" ?>" 
	 style="font-size: smaller"><?php echo  $mostrar_x ?></span></td>
	<?php endfor; ?>
  </tr>
 <?php endfor; 
$obj_js .= "</script>\n"; 
echo $obj_js;
//echo "contx = $cont_x<br />";
 ?>
</table>
<span class="span_enlace" onClick="validarCita('forma1','hora_cita','cod_med','<?php echo  $_accion ?>');";>Asignar Cita </span>
</div>
<?php endif; ?>
