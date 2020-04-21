<h1>Solicitar Citas </h1>
<?php 

foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		$$nombre=$valor;
		}
/* 
$documento = $_POST['doc_id'];
$tipo = $_POST['tipo_doc'];
$_accion = $_GET['_accion']; */
$cita = new Cita;
if($_accion == 'solicitar'){
	$resul = $cita->solicitar($doc_id,$tipo_doc,$fecha,$hora);
	}
echo $cita->mostrarMsg();
?>
<script language="javascript">
function revisarCampos(forma)
	{
	if (forma.tipo_doc.value == ''){
		alert('No se ha seleccionado un tipo de Documento.');	
		return false;
		}	
	if (forma.doc_id.value == ''){
		alert('Por favor escriba el no. de identificacion primero.');
		forma.doc_id.focus();
		return false;
		}
	if (forma.fecha.value == ''){
		alert('La fecha esta vaca.');
		forma.fecha.focus();
		return false;
		}
	if (forma.hora.value == ''){
		alert('La hora esta vaca.');
		return false;
		}

	forma.submit();
	}

</script>

<form name="form1" method="post" action="<?php echo  $PHP_SELF."?pag="._ESTAPAG ?>&_accion=solicitar">
  <table border="0" cellspacing="1">
    <tr>
      <td>Documento de Identidad</td>
      <td><input type="text" name="doc_id"></td>
    </tr>
    <tr>
      <td>Tipo</td>
      <td><select name="tipo_doc" id="tipo_doc">
      <?php echo  CitasMedicas::verTipoDoc(); ?>
	  </select></td>
    </tr>
    <tr>
      <td>Escoja la fecha </td>
      <td><input name="fecha" type="text" id="fecha" size="10"></td>
    </tr>
    <tr>
      <td>Escoja la hora </td>
      <td><select name="hora" id="hora">
	  <?php echo  hora::verRango(); ?>
      </select></td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="button" value="Registrar"  class="enlace" onClick="revisarCampos(document.form1);"></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
   Calendar.setup(
    {
      inputField  : "fecha",         // ID of the input field
      ifFormat    : "%Y-%m-%d"//,    // the date format
//	  flatCallback : dateChanged         // our callback function
    }
  ); 
</script>
<?php if ( $_accion == 'solicitar') : ?>
<p>Su solicitud ha sido recibida. <br>
  Por favor espere a que sea correctamente asignada por nuestro equipo de trabajo.<br>
En caso tal de ser confirmada, lo estaremos contactando. </p>
<?php endif; ?>