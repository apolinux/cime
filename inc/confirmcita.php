<?php 
foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		//echo "$nombre => $valor   ";
		$$nombre=$valor;
		}
$cita1 = new Cita();
switch ($_accion) {
	case 'registrarcita': 
		$cita1->registrar($cod_med,$cod_pac,$fecha_cita,$hora_cita);
		break;
	case 'actualizacita': $cita1->actualizar($cod_cita,$cod_med,$cod_pac,$fecha_cita,$hora_cita); 
		break;
	}
?>
<script>
function imprimir_cita()
	{
	// enviar los datos a una plantilla sin tablas lateral ni superior
	var forma = document.getElementById('forma1');
	var param_ventana='';
	window.open('','imprimir_cita');
	forma.target='imprimir_cita';
//	forma.action='<?php echo  $CITAS_MEDICAS['URL_BASE'] ?>/imprimir_cita.php';
	forma.action='imprimir_cita.php';
	forma.submit();
	}
</script>
<h1>Confirmar cita </h1>
<?php  //$cita1->msg  ?>
<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td align="right">M&eacute;dico:</td>
    <td align="center"><font color="#990000">
      <?php echo  Medico::nombre($cod_med) ?>
    </font></td>
  </tr>
  <tr>
    <td align="right">Paciente:</td>
    <td align="center"><?php echo  Paciente::nombre($cod_pac) ?></td>
  </tr>
  <tr>
    <td align="right">Fecha:</td>
    <td align="center"><font color="#FF3333">
      <?php echo  $fecha_cita ?>
    </font></td>
  </tr>
  <tr>
    <td align="right">Hora:</td>
    <td align="center"><font color="#FF3333">
      <?php echo  Hora::verHora($hora_cita,'0seg') ?>
    </font></td>
  </tr>
  <tr>
    <td align="right">Entidad:</td>
    <td align="center">Esta entidad</td>
  </tr>
 <?php 
if ($_accion == 'modcita')
	$nueva_accion = 'actualizacita';
else  
	$nueva_accion = 'registrarcita';
 ?>
 <form name="forma" action="<?php echo "$PHP_SELF?pag=$_ESTAPAG&_accion=$nueva_accion" ?>" method="POST" id="forma1">
 <input name="cod_med" type="hidden" value="<?php echo  $cod_med?>">
 <input name="cod_pac" type="hidden" value="<?php echo  $cod_pac ?>">
 <input name="fecha_cita" type="hidden" value="<?php echo  $fecha_cita ?>">
 <input name="hora_cita" type="hidden" value="<?php echo  $hora_cita ?>">
  <input name="cod_cita" type="hidden" value="<?php echo  $cod_cita ?>">
 </form>
</table>
<?php if ($_accion == 'registrarcita' or $_accion == 'actualizacita' ) : 
	echo $cita1->mostrarMsg(); ?>
 - <span class="span_enlace" onClick="imprimir_cita();">Imprimir</span>
<?php else : ?>
<p>Desea confirmar esta cita?</p>
<p><span onClick="forma.submit();" class="span_enlace">Confirmar</span> | <a href="<?php echo $PHP_SELF?>?pag=admcitas">Cancelar</a> </p>
<?php endif; ?>