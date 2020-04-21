<?php 
foreach ($_GET as $nombre_var => $valor ){
		$$nombre_var=$valor;
		$arr_param[$nombre_var] = $valor;
		}
foreach ($_POST as $nombre_var => $valor ){
		//echo "$nombre => $valor   ";
		$$nombre_var=$valor;
		$arr_param[$nombre_var] = $valor;
		}
		
$paciente1 = new Paciente();
switch ($_accion){
	case 'crearpac':
		$paciente1->crearpac($arr_param); break;
	case 'modpac': $paciente1->modpac($arr_param);break;
	case 'borrarpac': $paciente1->borrarpac($idpac);break;
	}
/*
// esta metafuncion llama a funciones para que ejecuten la accion deseada
$paciente1->ejecutar('$_accion',$arr_param);
*/
?>

<script>
function registrar(id_forma)
	{
	var forma = document.getElementById(id_forma);
	for(var i=0; i < forma.elements.length; i++){
		if (forma.elements[i].type =='text' && forma.elements[i].value == ''){
			alert('El campo se encuentra vacio.');
			forma.elements[i].focus();
			return false;
			}
		}
	forma.submit();	
	}

function cambiar(id_forma,obj)
	{
	var forma = document.getElementById(id_forma);
	for (var elemento in obj){
		var cad_mostrar = 'forma.' + elemento + '.value = "'+ obj[elemento] + '";'
		//alert('cad mostrar='+cad_mostrar);
		eval(cad_mostrar);
		}
	mostrar_bloque('mod','block');
	location.hash ='#mod';
	}

function borrar(id,id_forma)
	{
	var forma = document.getElementById(id_forma);
	if (confirm('Esta seguro que desea borrar este registro?') ){
		forma.action += '&_accion=borrarpac&idpac='+ id;
		forma.submit();
		}
	return false;
	}

</script>
<h1>Administraci&oacute;n de Pacientes </h1>
<span class="span_enlace" onClick="mostrar_bloque('crear');" >Crear Nuevo Paciente</span> - 
<span class="span_enlace" onClick="mostrar_bloque('listar_mod');">Listar Pacientes</span>
<?php echo  "<br>".$paciente1->mostrarMsg(); ?>
<div id='crear' style="display: none">
Por favor introduzca los datos para registrar un nuevo paciente al sistema. 
  <table border="0" cellspacing="1">
  <form name="forma_crear" id="forma_crear" method="post" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG&_accion=crearpac" ?>">
    <tr>
      <td align="right">Nombre</td>
      <td><input name="nombre" type="text" id="nombre"></td>
    </tr>
    <tr>
      <td align="right">Apellidos</td>
      <td><input name="apellidos" type="text" id="apellidos"></td>
    </tr>
    <tr>
      <td align="right">Tipo de documento de identidad </td>
      <td>        <select name="tipo_doc" id="tipo_doc">
      <?php echo  citasMedicas::verTipoDoc(); ?>
      </select></td>
    </tr>
    <tr>
      <td align="right">No. de documento de identidad </td>
      <td><input name="doc_ident" type="text" id="doc_ident"></td>
    </tr>
    <tr>
      <td align="right">No de Seguro Medico</td>
      <td><input name="cod_seguro" type="text" id="cod_seguro"></td>
    </tr>
    <tr>
      <td align="right">Entidad de Salud </td>
      <td><input name="entidad_med" type="text" id="entidad_med"></td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="button" value="Registrar"  class="enlace" onClick="registrar('forma_crear');" /><!--<span class="span_enlace" onClick="registrar('forma_crear');">Registrar</span>--></td>
    </tr></form>
  </table></div>
 <div id="listar_mod">
 <div id="listar">
 <?php $arr_lista = $paciente1->listarpac(); 
 //echo "<pre>"; print_r($arr_lista); echo "</pre>";
 if (count($arr_lista) == 0 ) :
 ?>
 No hay pacientes creados.
 <?php else: 
	//var_dump($CITAS_MEDICAS['params_pager']);
	$pager = & Pager::factory(asignaArrayPager($arr_lista));
	$links = $pager->getLinks();
	$arr_rango = $pager->getOffsetByPageId();
 ?>
 
 <h2 >Listar Pacientes</h2><?php echo  $links['all']; ?>
    <table width="550" border="1" cellspacing="0" cellpadding="0">
  <form name="forma_list" id="forma_list" method="post"  action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG" ?>">     
  <tr>
        <th scope="col">nombre</th>
        <th scope="col">apellidos</th>
        <th scope="col">tipo doc </th>
        <th scope="col">documento</th>
        <th scope="col">seguro</th>
        <th scope="col">entidad</th>
        <th scope="col">cambiar</th>
        <th scope="col">borrar</th>
        <th scope="col">citas</th>
  </tr>
<?php //for ($i=0 ; $i < count(array_keys($arr_lista)); $i++ ) :
for ($i=$arr_rango[0]-1 ; $i < $arr_rango[1]; $i++ ) :
		$codigo1 = $arr_lista[$i]['codigo'];
		$cad_param_js ="<script>\n 
var param_$codigo1 = new Object;\n";
		foreach ($arr_lista[$i] as $nombre_var1 => $valor_var1){
			$$nombre_var1 = $valor_var1;
			if ($nombre_var1 != 'nombre_doc') 
				$cad_param_js .= "param_$codigo1.$nombre_var1 = '$valor_var1';\n";
			}
		$cad_param_js .="</script>\n";
		echo $cad_param_js;
?>
      <tr>
        <td><?php echo  $nombres ?></td>
        <td><?php echo  $apellidos ?></td>
        <td><?php echo  $nombre_doc ?></td>
        <td><?php echo  $doc_ident ?></td>
        <td><?php echo  $cod_seguro ?></td>
        <td><?php echo  $entidad_med ?></td>
        <td><span class="span_enlace" onClick="cambiar('forma_mod',<?php echo  "param_$codigo1" ?>);">cambiar</span></td>
        <td><span class="span_enlace" onClick="borrar(<?php echo  $codigo1 ?>,'forma_list');">borrar</span></td>
        <td><span class="span_enlace" onClick="ir_a('<?php echo  "$PHP_SELF?pag=asignacita&_accion=crearcita&cod_pac=$codigo1" ?>');">Crear</span></td>
      </tr>
<?php endfor; ?>
   </form>   </table>
  <?php endif; ?>
 </div>
<div id="mod" style="display: none">
  <h2>Modificar Paciente
    </h2>
  <table border="0" cellspacing="1">
<form name="forma_mod" method="post" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG&_accion=modpac" ?>" id="forma_mod">  
<input type="hidden" name="codigo" value="" />   <tr>
        <td align="right">Nombre</td>
        <td><input name="nombres" type="text" id="nombre2"></td>
      </tr>
      <tr>
        <td align="right">Apellidos</td>
        <td><input name="apellidos" type="text" id="apellidos2"></td>
      </tr>
      <tr>
        <td align="right">Tipo de documento de identidad </td>
        <td>
          <select name="tipo_doc" id="select2">
            <?php echo  citasMedicas::verTipoDoc(); ?>
        </select></td>
      </tr>
      <tr>
        <td align="right">No. de documento de identidad </td>
        <td><input name="doc_ident" type="text" id="doc_ident2"></td>
      </tr>
      <tr>
        <td align="right">No de Seguro Medico</td>
        <td><input name="cod_seguro" type="text" id="cod_seguro2"></td>
      </tr>
      <tr>
        <td align="right">Entidad de Salud </td>
        <td><input name="entidad_med" type="text" id="entidad_med2"></td>
      </tr>
      <tr align="center">
        <td><span class="span_enlace" onClick="registrar('forma_mod');">Modificar</span></td>
        <td><span class="span_enlace" onClick="mostrar_bloque('mod','none');">Cancelar</span></td>
      </tr>
  </form>  </table>
 </div> </div>
