<?php 

function MostrarVariablesForm(){
	echo "Variables GET:<br>";
	foreach ($_GET as $nombre => $valor ){
		echo "[$nombre] es $valor<br>";
		}
	echo "Variables POST:<br>";
	foreach ($_POST as $nombre => $valor ){
		echo "[$nombre] es $valor<br>";
		}
	
	}
function ObtenerVariablesForm(){
	//echo "Variables GET:<br>";
	foreach ($_GET as $nombre => $valor ){
		//echo "[$nombre] es $valor<br>";
		$GLOBALS["$nombre"]=$valor;
		}
//	echo "Variables POST:<br>";
	foreach ($_POST as $nombre => $valor ){
		//echo "[$nombre] es $valor<br>";
		$GLOBALS["$nombre"]=$valor;
		}
	
	}


$medico1 = new Medico;

/* configura las variables enviadas de get y post de los formularios
 y enlaces */
 
foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		$$nombre=$valor;
		}
	
if ($_accion == 'crearmed') {
	$resul = $medico1->crear($nombmed,$doc_id,$tipo_doc, $categoria,$oficina);
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
</script>
<h1>Ingresar nuevo m&eacute;dico</h1>
<?php $medico1->mostrarMsg(); ?>
<form name="form1" method="post" action="<?php echo  $PHP_SELF.'?pag='._ESTAPAG ?>&_accion=crearmed">
  <table width="400" border="0" cellspacing="5">
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
  </table>
</form>
<!-- <p><a href="<?php echo  $PHP_SELF.'?pag='._ESTAPAG ?>&_accion=crearmed">Crear m&eacute;dico </a></p> -->
<p><a href="#" onClick="revisarCampos();">Crear m&eacute;dico </a></p>
