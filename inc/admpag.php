<?php 
$_accion= isset($_GET['_accion']) ? $_GET['_accion'] : '';

if (isset($_REQUEST['paginax']) )
	$paginax=$_REQUEST['paginax'];
else
    $paginax=0;

$cod_tarea= isset($_REQUEST['cod_tarea']) ? $_REQUEST['cod_tarea'] : '';

$pagina_nueva=isset($_REQUEST['pagina_nueva']) ? $_REQUEST['pagina_nueva'] : ''; 
//echo "paginax=$paginax";
$pag1=new Pagina();

switch ($_accion) {
	case 'crear_pag' : 
		$pag_creada = $pag1->crear($paginax,$cod_tarea);
		break;
	case 'borrar_pag' :
		$borrar_pag = $pag1->quitar($paginax);
		break;
	case 'camb_tarea':
		$cod_tarea = $cod_tarea[$paginax];
		$camb_tarea = $pag1->cambiarTarea($paginax,$cod_tarea);
		break;
/* 	case 'mod_pag':
		$mod_pag = $pag1->modif($login,$passwd);
		break; */
	case 'renombrar':
		$pagina_nueva = $pagina_nueva[$paginax];
		$renombrar = $pag1->renombrar($paginax,$pagina_nueva);
		break;
	default : break;
	}

$arr_pags = $pag1->listar();

?>
<script language="javascript">
function crearPag(forma){
	
	//chequear campos no vacios
	if ( forma.paginax.value == '' ){
		alert('el nombre de la pgina esta vaco. Por favor revise.');
		return false;
		}
	forma.submit();
	}
function enviarforma2(pagina,accion)
	{
	if (accion == 'camb_tarea'){
		document.form2.action += '&_accion=camb_tarea&paginax='+pagina;
		document.form2.submit();
		}
	if (accion == 'renombrar'){
	obj_pag='pagina_nueva['+pagina+']';
	//alert ('pagina nueva: '+ document.forms[1].elements[obj_pag].value); 
	pagina_nueva=document.forms[1].elements[obj_pag].value; //ojo esto tiene en cuenta las posiciones relativas de las formas: 0, 1, 2...
		if (pagina_nueva != ''){
			document.form2.action += '&_accion=renombrar&paginax='+pagina;
			document.form2.submit();
			}	
		else {
			alert('El nombre de la pgina est vaco.');
			return false;
			}
		}
	}

function borrarPag(pagina)
	{
	if (confirm('Esta seguro que desea borrar la pgina '+pagina+'?')){
		form2.action = form2.action +'&_accion=borrar_pag&paginax='+pagina;
		form2.submit();
		}
	return true;
	}
</script>
<h1>Administraci&oacute;n de p&aacute;ginas </h1>
<a href="<?php echo  $PHP_SELF.'?pag=' ?>">Regresar</a><br>


<?php 
if ($_accion == "crear_pag" ) :
	if ($pag_creada == 1 ): ?>
<font color="#0000FF">La p&aacute;gina '<?php echo  $paginax ?>' fue creada exitosamente.</font>
<?php 	else : ?>
<font color="#FF0000">La p&aacute;gina '<?php echo  $paginax ?>'  ya existe.</font>
<?php endif; 
endif;?>

<?php 
if ($_accion == "borrar_pag" ) :
	if ($borrar_pag ): ?>
<font color="#0000FF">La p&aacute;gina '<?php echo  $paginax ?>' fue eliminada.</font>
<?php 	else : ?>
<font color="#FF0000">La p&aacute;gina '<?php echo  $paginax ?>'   no se pudo eliminar.</font>
<?php endif; 
endif;?>

<?php 
if ($_accion == "renombrar" ) :
	if ($renombrar ): ?>
<font color="#0000FF">La p&aacute;gina '<?php echo  $paginax ?>'  cambi&oacute; su nombre.</font>
<?php 	else : ?>
<font color="#FF0000">La p&aacute;gina '<?php echo  $paginax ?>' no pudo cambiar su nombre.</font>
<?php endif; 
endif;?>

<?php if ($_accion == "camb_tarea" ) :
	if ($camb_tarea ): ?>
<font color="#0000FF">La p&aacute;gina '<?php echo  $paginax ?>'  cambi&oacute; su tarea.</font>
<?php 	else : ?>
<font color="#FF0000">La p&aacute;gina '<?php echo  $paginax ?>' no pudo cambiar su tarea.</font>
<?php endif; 
endif;?>


<h2>Crear p&aacute;ginas </h2>
<form name="form1" method="post" action="<?php echo  $PHP_SELF.'?pag='._ESTAPAG ?>&_accion=crear_pag">
  <table border="0" cellspacing="5">
    <tr>
      <td>nombre</td>
      <td><input type="text" name="paginax"></td>
    </tr>
    <tr>
      <td>tipo</td>
      <td><select name="cod_tarea">
       <?php echo  $pag1->listarTareas();?>
		</select></td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="button" name="Submit" value="Crear" onClick="crearPag(this.form);"></td>
    </tr>
  </table>
</form>
<h2>Listar páginas </h2>
<form name="form2" method="post" action="<?php echo  $PHP_SELF.'?pag='._ESTAPAG ?>">
   <table border="1" cellspacing="3">
     <tr>
       <th scope="col">nombre</th>
       <th colspan="2" scope="col">cambiar tarea</th>
       <th scope="col">renombrar</th>
       <th scope="col">borrar</th>
     </tr>
<?php 
   reset($arr_pags);
   //while (list(,$arr_pag)=each($arr_pags)):
   foreach($arr_pags as $arr_pag):
   list($cod,$pagina,$tarea)=$arr_pag;
   ?>	 
     <tr>
       <td><?php echo  $pagina ?></td>
       <td><select name="cod_tarea[<?php echo  $pagina ?>]">
         <?php echo  $pag1->listarTareas($tarea);?>
       </select></td>
       <td><a href="#" onClick="enviarforma2('<?php echo  $pagina ?>','camb_tarea');">cambiar tarea</a></td>
       <td><input type="text" name="pagina_nueva[<?php echo  $pagina?>]"><a href="#" onClick="enviarforma2('<?php echo  $pagina ?>','renombrar');">renombrar</a></td>
       <td><a href="#" onClick="borrarPag('<?php echo  $pagina ?>');">borrar</a></td>
     </tr>
<?php endforeach; ?>
   </table>
</form>
<!-- <p>Generar listado de p&aacute;ginas desde el directorio por defecto: <a href="#">Generar </a></p> -->
