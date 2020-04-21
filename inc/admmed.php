<?php 

$medico1 = new Medico;

/* configura las variables enviadas de get y post de los formularios
 y enlaces */
 
foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		$$nombre=$valor;
		}
	
switch ($_accion){
	case 'crearmed': 
		$resul = $medico1->crear($nombmed,$doc_id,$tipo_doc, $categoria,$oficina); break;
	case 'modmed':
		$nombmed = $nombmed[$idmed];
		$doc_id = $doc_id[$idmed];
		$tipo_doc = $tipo_doc[$idmed];
		$categoria = $categoria[$idmed];
		$oficina = $oficina[$idmed];
		$resul = $medico1->modif($idmed,$nombmed,$doc_id,$tipo_doc,$categoria,$oficina); break;
	case 'borrar':
		$resul = $medico1->borrar($idmed);
		break;
	default: break;
	}
?>
<script language="javascript">
function revisarCampos(){
	var forma = document.form1;
	if (forma.nombmed.value == '' || forma.doc_id.value == '' 
	|| forma.oficina == '' ) {
		alert('Alguno de los campos está vacio. Por favor revise.');
		return false;
		}
	forma.submit();
	return true;
	}
function sumNomObj(objeto,codigo)
	{
	var nom_obj = objeto+'['+codigo+']';
	return nom_obj; 
	}
function cambiar(forma,codigo)
	{
	
	if ( forma.elements[sumNomObj('nombmed',codigo)].value == '' ||
	forma.elements[sumNomObj('doc_id',codigo)].value == '' ||
	forma.elements[sumNomObj('oficina',codigo)].value == '' ) {
		alert('Alguno de los campos está vacío, por favor revíselo.');
		return false;
		}
	else {
		forma.action += '&_accion=modmed&idmed=' + codigo;
		forma.submit();
		}
	}
function borrar(forma,id,medico)
	{
	if (confirm('Esta seguro que desea borrar el médico '+medico+'?')){
		forma.action += '&_accion=borrar&idmed='+id;
		forma.submit();
		}
	return true;
	}
function enviarHorMed(forma,accion,codigo)
	{
	if (accion == 'crear'){
		forma.action = '<?php echo  $PHP_SELF ?>?pag=admhormed&_accion=crear&idmed='+codigo;
		forma.submit();
		}
	else {
		forma.action = '<?php echo  $PHP_SELF ?>?pag=admhormed&_accion=cambiar&idmed='+codigo;
		forma.submit();
		}
	}

</script>
<h1>Administrar m&eacute;dicos</h1>
<span class="span_enlace" onClick="mostrar_bloque('crear');" >Crear Nuevo Medico</span> - 
<span class="span_enlace" onClick="mostrar_bloque('listar_mod');">Listar Medicos</span>
<br><?php echo  $medico1->mostrarMsg(); ?><br>
<div id="crear" style="display: none">
<h2>Crear nuevo m&eacute;dico</h2>
  <table width="400" border="0" cellspacing="5">
  <form name="form1" method="post" action="<?php echo  $PHP_SELF.'?pag='._ESTAPAG ?>&_accion=crearmed">
    <tr>
      <td>nombre del m&eacute;dico</td>
      <td><input type="text" name="nombmed"></td>
    </tr>
    <tr>
      <td>documento de identidad</td>
      <td><input type="text" name="doc_id"></td>
    </tr>
    <tr>
      <td>tipo de documento </td>
      <td><select name="tipo_doc">
	  <?php $medico1->verTipoDoc();?>
	  </select></td>
    </tr>
    <tr>
      <td>categor&iacute;a</td>
      <td><select name="categoria">
		<?php $medico1->vercats(); ?>
	  </select></td>
    </tr>
    <tr>
      <td>Oficina</td>
      <td><input type="text" name="oficina"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="button" value="Crear"  class="enlace"  onClick="revisarCampos();"/><!--<span onClick="revisarCampos();" class="span_enlace">Crear m&eacute;dico </span>--></td>
    </tr>
</form>  </table>

</div>

<?php 
$arr_meds = $medico1->listar();
if (count($arr_meds) == 0 ) :
?>
No hay medicos asignados.
<?php else: ?>
<div id="listar_mod">
<h2>Listar Medicos</h2>

<form name="form2" method="post" action="<?php echo  $PHP_SELF."?pag="._ESTAPAG ?>">
  <table border="0" cellspacing="0" >
    <tr>
      <th scope="col" class="th_sencilla">nombre</th>
      <th scope="col" class="th_sencilla">documento</th>
      <th scope="col" class="th_sencilla">tipo</th>
      <th scope="col" class="th_sencilla">categoria</th>
      <th scope="col" class="th_sencilla">oficina</th>
      <th scope="col" class="th_sencilla">cambiar</th>
      <th scope="col" class="th_sencilla">borrar</th>
      <th scope="col" class="th_sencilla">horario</th>
    </tr>
<?php 
 foreach($arr_meds as $arr_med):
?>
    <tr>
      <td class="td_sencilla">
	  <input name="nombmed[<?php echo  $arr_med['codigo'] ?>]" type="text" value="<?php echo  $arr_med['nombre'] ?>" size="15">
	  </td>
      <td class="td_sencilla">
	  <input name="doc_id[<?php echo  $arr_med['codigo'] ?>]" type="text" value="<?php echo  $arr_med['doc_ident'] ?>" size="12">
	  </td>
 <!--      <td align="center" class="td_sencilla"><?php echo  $arr_med['tipo_docu'] ?></td> -->
	  <td align="center" class="td_sencilla">
	  <select name="tipo_doc[<?php echo  $arr_med['codigo'] ?>]"><?php $medico1->verTipoDoc($arr_med['tipo_docu']) ?></select>	  </td>
      <td align="center" class="td_sencilla">
	  <select name="categoria[<?php echo  $arr_med['codigo'] ?>]">
		<?php $medico1->vercats($arr_med['tipo_medico']); ?>
	  </select></td>
      <td align="center"  class="td_sencilla">
	  <input name="oficina[<?php echo  $arr_med['codigo'] ?>]" type="text" value="<?php echo  $arr_med['oficina'] ?>" size="4">
	  </td>
      <td align="center"  class="td_sencilla"><span onClick="cambiar(document.form2,<?php echo  $arr_med['codigo'] ?>);"
	   class="span_enlace">cambiar</span></td>
      <td align="center"  class="td_sencilla"><span 
	  onClick="borrar(document.form2,<?php echo  $arr_med['codigo'] ?>,'<?php echo  $arr_med['nombre'] ?>');"
	   class="span_enlace">borrar</span></td>
      <?php  $horariomed1 = new HorarioMedico;
	  if (!$horariomed1->horPrinExiste($arr_med['codigo']) ) {
	  		$accion = "crear";
			}
		else {
			$accion = "cambiar";
			}
		?>
	  <td align="center"  class="td_sencilla"><span
	   onClick="enviarHorMed(document.form2,'<?php echo  $accion ?>',<?php echo  $arr_med['codigo'] ?>);" 
	    class="span_enlace"><?php echo  $accion ?></span></td>
    </tr>
<?php endforeach; ?>
  </table>
</form>
</div>
<?php endif; ?>