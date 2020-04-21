<?php 

foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		//echo "$nombre => $valor   ";
		$$nombre=$valor;
		}

$medico1 = new medico;
$hora1= new hora;
$hormed1 = new HorarioMedico;
//arreglo de dias
//$arr_dias=array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');
$arr_horarios =  array();
foreach ($_POST as $nombre => $valor ){
	if (preg_match_all("/^param_hora_(.*)/",$nombre,$arr_resul))
		$arr_horarios[$arr_resul[1][0]]=$valor;
	}
switch ($_accion ){
	case 'crearhormed':
		$resul = $hormed1->crearPrincipal($idmed,$arr_horarios); break;
	case 'modhormed':
		$resul = $hormed1->modifPrincipal($idmed,$arr_horarios); break;
	case 'borrarhormed': $resul = $hormed1->borrar($idmed,$idhormed);break;
	case 'crearhornodisp':
	case 'modhornodisp': 
		if ( $chkbx_hor_f_in == ""){
			$sel_h_in=NULL;
			$sel_h_fin=NULL;
			}
		if (! isset($chkbx_f_fin) || ($chkbx_f_fin == "") ){
			$fecha_fin = NULL;
			}
		
		$resul = $hormed1->crearHorNoDisp($idmed,$fecha_in,$fecha_fin,$sel_h_in,$sel_h_fin,$id_hor_nodisp);break;
	case 'borrarhornodisp':
		$result = $hormed1->borrarHorNoDisp($id_hor_nodisp);break;
	default:break;
	}
$estado_list_nodisp
?>

<script language="javascript">
COLOR_HOR_DISP = "<?php echo  $CITAS_MEDICAS['COLOR_HOR_DISP'] ?>";
COLOR_HOR_NODISP = "<?php echo  $CITAS_MEDICAS['COLOR_HOR_NODISP'] ?>";
</script>
<h1>Ingresar Horario de M&eacute;dico</h1>
<span class="span_enlace" onClick="mostrar_bloque('hor_prin');" >Horario principal</span> - 
<span class="span_enlace" onClick="mostrar_bloque('hor_nodisp');">Crear Horario de No Disponibilidad</span> - 
<span class="span_enlace" onClick="mostrar_bloque('list_hor_nodisp');">Listar Horarios de No Disponiblidad</span>
<br>
<?php echo  $hormed1->mostrarMsg(); ?>
<br>
Nombre del m&eacute;dico: <strong><?php echo  $medico1->nombre($idmed);?></strong>
<?php if ($hormed1->horPrinExiste($idmed) )
	$msg_envio = "Modificar";
 else 
	$msg_envio = "Ingresar"; 
 ?>
<div id="hor_prin">
 <h2><?php echo  $msg_envio ?> el Horario principal</h2>
Escoja los dias y las horas de disponibilidad
<table border="1" cellpadding="1" cellspacing="0" class="borde_delgado" id="tabla_hor" width="411">
  <form name="form1" method="post" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG&idmed=$idmed" ?>" id="forma_hor">
    <?php echo  $hormed1->generaTabla($idmed) ?>
  </form>
  <tr>
    <td colspan="8">
	<table border="0" cellpadding="1" cellspacing="0" class="borde_delgado" width="100%" id="otra_tabla">
  <tr align="center">
    <th scope="row"  class="borde_delgado"><span class="Estilo1">Leyenda: </span></th>
    <td bgcolor="#66FF99"  class="borde_delgado">Disponible</td>
    <td bgcolor="#FFFF31"  class="borde_delgado">No Disponible </td>
    <td class="borde_delgado" ><span onClick="reestablecer();" class="span_enlace">reestablecer</span></td>
  <td onClick="ingresar('<?php echo  $msg_envio ?>');"  class="borde_delgado"> <span  class="span_enlace"><?php echo  $msg_envio ?></span></td>
     </tr>
     </table>
    </td>
  </tr>
</table>
</div> 
<div id="hor_nodisp"  style="display: none">
<h2>D&iacute;as de No Disponibilidad</h2>
<form name="forma_nodisp" method="post" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG&idmed=$idmed&_accion=crearhornodisp" ?>" id="forma_nodisp">
  <table  border="0" cellpadding="1" cellspacing="0">
    <tr>
      <td colspan="7">Escoja el d&iacute;a o d&iacute;as de no disponibilidad</td>
    </tr>
    <tr align="center">
      <td colspan="2"><strong>fecha</strong></td>
      <td><strong>rango de horas </strong></td>
      <td><strong>hora inicial </strong></td>
      <td><strong>hora final </strong></td>

    </tr>
    <tr>
      <td align="right"> Inicial</td>
      <td>
        <input name="fecha_in" type="text" id="fecha_in" size="10">
      </td>
      <td align="center"><input name="chkbx_hor_f_in" type="checkbox" id="chkbx_hor_f_in"
	  onClick="cambEstadoCampos(this,'sel_h_in','sel_h_fin');" value="checkbox">      </td>
      <td><select name="sel_h_in" id="sel_h_in" disabled>
       <?php echo  $hora1->verRango(); ?>
                  </select></td>
      <td><select name="sel_h_fin"  id="sel_h_fin" disabled>
       <?php echo  $hora1->verRango(); ?>
      </select></td>
  
    </tr>
    <tr>
      <td><input type="checkbox" name="chkbx_f_fin" value="checkbox" id="chkbx_f_fin" 
	  onClick="cambEstadoCampos(this,'fecha_fin');"> 
        Final </td>
      <td><input name="fecha_fin" type="text" id="fecha_fin" size="10" disabled>
      </td>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr align="center">
      <td colspan="7"><span id="crear_hor_nodisp" onClick="ingresarHorNodisp('forma_nodisp');" class="span_enlace">Crear</span> </td>
    </tr>
  </table>
</form>
<script type="text/javascript">
  // define info for dates in this table:
  var dateInfo = {
    "20061212" : "Cumplea&ntilde;os de Tiota",
    "20050310" : "foo",
    "20050315" : "bar",
    "20050318" : "25$",
    "20050324" : "60$"
  };
  function getDateText(date, d) {
    var inf = dateInfo[date.print("%Y%m%d")];
    if (!inf) {
      return d + "<div class='inf'>&nbsp;</div>";
    } else {
      return d + "<div class='inf'>" + inf + "</div>";
    }
  };
  function flatCallback(cal) {
    if (cal.dateClicked) {
      // do something here
      window.status = "Selected: " + cal.date;
      var inf = dateInfo[cal.date.print("%Y%m%d")];
      if (inf) {
        window.status += ".  Additional info: " + inf;
      }
    }
  };
  Calendar.setup(
    {
      inputField  : "fecha_in",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
	  dateText: getDateText,
    flatCallback: flatCallback
    }
  ); 
   Calendar.setup(
    {
      inputField  : "fecha_fin",         // ID of the input field
      ifFormat    : "%Y-%m-%d",    // the date format
	  flatCallback : dateChanged         // our callback function
    }
  ); 
</script> 
</div>
<?php 
$arr_list_hor = $hormed1->listar($idmed);
if (sizeof($arr_list_hor)) 
	$estado_list_nodisp = 'block';
else
 	$estado_list_nodisp = 'none';
?>
<div id="list_hor_nodisp"  style="display: <?php echo  $estado_list_nodisp ?>">
<h2>Lista de Horarios de No Disponibilidad</h2>
<?php 
 //listado de horarios para el dr idmed
//$arr_list_hor = $hormed1->listar($idmed);
if (sizeof($arr_list_hor) == 0 ): ?>

El m&eacute;dico no tiene horarios asignados.<br>
<?php 
else:
?>

<form action="<?php echo  $PHP_SELF."?pag=$_ESTAPAG&idmed=$idmed" ?>" method="POST" name="form_list_nodisp" id="form_list_nodisp" >
<table border="1" cellspacing="3">
  <tr>
    <th scope="col">Rango de fechas</th>
    <th scope="col">Rango de Horas</th>
    <th scope="col">Modificar</th>
    <th scope="col">Borrar</th>
  </tr>
 <?php 
//while (list(,$list_hor)=each($arr_list_hor)):
 foreach($arr_list_hor as $list_hor):
 	$cod_hor_nodisp = $list_hor['codigo'];
 	$hora_in = $list_hor['hora_in'];
 	$hora_fin = $list_hor['hora_fin'];
	$fecha_in = $list_hor['fecha_in'];
	$fecha_fin = $list_hor['fecha_fin'];
 
	echo "<script>
var hormed$cod_hor_nodisp = new Object();
hormed${cod_hor_nodisp}.cod_hor_nodisp = $cod_hor_nodisp;
hormed${cod_hor_nodisp}.hora_in = '$hora_in';
hormed${cod_hor_nodisp}.hora_fin = '$hora_fin';
hormed${cod_hor_nodisp}.fecha_in = '$fecha_in';
hormed${cod_hor_nodisp}.fecha_fin = '$fecha_fin';
</script>"
?>
  <tr>
    <td><?php echo  "$fecha_in";
	echo $fecha_fin?" a $fecha_fin":""; ?></td>
    <td><?php if (!$hora_in && !$hora_fin) {
			echo "Todo el d&iacute;a";
			}
		   else {
			if ($hora_in) {
		  		echo hora::verHora("$hora_in",12);
				}
			if ($hora_fin)
				echo " a ".hora::verHora("$hora_fin",12);
			}
		 ?>&nbsp;</td>
	<td><span onClick="cambiarHorMed(<?php echo  "hormed${cod_hor_nodisp}" ?>,'form_mod_nodisp');" class="span_enlace">Modificar</span></td>
    <td><span onClick="borrarNoDisp('form_list_nodisp',<?php echo  $cod_hor_nodisp ?>);" class="span_enlace">Borrar</span></td>
  </tr>
<?php endforeach ; ?>
</table>

</form>
<?php endif; ?>

<div id="modif_horario" style="display: none" >
<h2>Modificar Horarios</h2>
<form method="post" name="form_mod_nodisp" id="form_mod_nodisp" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG&idmed=$idmed&_accion=modhornodisp" ?>">
 
<table border="0">
    <tr>
      <td>fecha inicial 
        <input name="fecha_in" type="text" id="mh_fecha_in" size="10" ></td>
		<td>
		&nbsp;&nbsp;
		<input type="checkbox" name="chkbx_f_fin" value="checkbox" onClick="cambEstadoCampos(this,'mh_fecha_fin');">
		fecha final 
        <input name="fecha_fin" type="text" id="mh_fecha_fin" size="10"></td>
    </tr>
<script type="text/javascript">
  Calendar.setup(
    {
      inputField  : "mh_fecha_in",         // ID of the input field
      ifFormat    : "%Y-%m-%d"
    }
  ); 
   Calendar.setup(
    {
      inputField  : "mh_fecha_fin",         // ID of the input field
      ifFormat    : "%Y-%m-%d"
    }
  ); 
</script>
    <tr>
      <td colspan="2"><input type="checkbox" name="chkbx_hor_f_in" value="checkbox" id="mh_sel_horas" 
	  onClick="cambEstadoCampos(this,'mh_hora_in','mh_hora_fin');"> 
        definir un horario </td>
      </tr>
    <tr>
      <td align="right">hora inicial 
        <select name="sel_h_in" id="mh_hora_in" disabled>
        <?php echo  $hora1->verRango(); ?>
		</select>
        </td>
      <td align="right">hora final 
        <select name="sel_h_fin" id="mh_hora_fin" disabled>
		<?php echo  $hora1->verRango(); ?>
        </select></td>
    </tr>
    <tr>
      <td align="center"><span onClick="ingresarHorNodisp('form_mod_nodisp');" class="span_enlace">modificar</span></td>
      <td align="center"><span onClick="cancelaModHor();"  class="span_enlace">cancelar</span></td>
    </tr>
  </table>
  <input type="hidden" name="id_hor_nodisp" value=""  />
</form>
</div>
</div>