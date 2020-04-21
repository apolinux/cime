<?php 
foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		//echo "$nombre => $valor   ";
		$$nombre=$valor;
		}
//obtener el listado de medicos
//$arr_listmed = Medico::ListarMedicos();

/* if ($fecha_cita == ''){
	$fecha_cita = date("Y-m-d");
	}
 */
$cita1 = new Cita;
if ($_accion == 'borrar')
	{
	$cita1->borrar($cod_cita);
	}
?>
<script>
function asignaCita(id_obj,id_hora,id_medico,val_hora,val_medico,obj_nombre,id_nomb_med){
	//alert(obj.title);
	var obj = document.getElementById(id_obj);
	var hora = document.getElementById(id_hora);
	var medico = document.getElementById(id_medico);	
	var nomb_med = document.getElementById(id_nomb_med);
	//var obj_nombre = document.getElementById(id_obj_nombre);
	if (obj.title == 'Disp'){
		//buscar otros elementos que esten seleccionados
		// y resetear su valor
		if (obj.innerHTML != "X") {
			vaciarEstados();
			obj.innerHTML = "X";
			//alert(hora.value);
			hora.value =val_hora;
			//alert(hora.value);
			medico.value = val_medico;
			//alert('obj.nomb'+obj_nombre.toSource());
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
function validarCita(id_forma,id_hora,id_medico)
	{
	forma = document.getElementById(id_forma);
	hora = document.getElementById(id_hora);
	medico = document.getElementById(id_medico);
	if (hora.value == '' || medico.value == ''){
		alert('No ha escogido ningun horario.');
		return false;
		}
	else {
		//forma.method = 'post';//
	  	forma.action += '&pag=confirmcita&_accion=asignarcita';
		forma.submit();
		}
	}
function cambiar(cod,forma)
	{
	forma.cod_cita.value = cod;
	forma.action += 'pag=asignacita&_accion=modcita';
	forma.submit();
	}
function borrar(cod,forma)
	{
	if (confirm('Esta seguro que desea borrar esta cita?')) {
		forma.cod_cita.value = cod;
		forma.action += 'pag=<?php echo  $_ESTAPAG ?>&_accion=borrar';
		forma.submit();
		}
	}
</script>

<h1>Administracion de Citas </h1>
<?php echo  $cita1->mostrarMsg()."<br>" ?>
<a href="<?php echo  "$PHP_SELF?pag=asignacita" ?>">Asignacion de Citas</a> - Lista de Citas<br>

<?php 
$arr_lista = (new Cita)->listar();
$pager = & Pager::factory(asignaArrayPager($arr_lista));
$links = $pager->getLinks();
$arr_rango = $pager->getOffsetByPageId();
?>

<?php if (count($arr_lista) ): ?>
<br>Lista de Citas<br><?php echo  $links['all']; ?>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">fecha</th>
    <th scope="col">hora</th>
    <th scope="col">m&eacute;dico</th>
    <th scope="col">paciente</th>
    <th scope="col">estado</th>
    <th scope="col">borrar</th>
    <th scope="col">cambiar</th>
  </tr>
<?php 
//$cad_param_js = "\n";

for ($i=$arr_rango[0]-1 ; $i < $arr_rango[1]; $i++ ) :
		$codigo1 = $arr_lista[$i]['cod_cita'];
		$cad_param_js = "<script>
var param = Array(); 
param[$codigo1] = new Object;\n";
		foreach ($arr_lista[$i] as $nombre_var1 => $valor_var1){
			$$nombre_var1 = $valor_var1;
			if ($nombre_var1 != 'nombre_doc') 
				$cad_param_js .= "param[$codigo1].$nombre_var1 = '$valor_var1';\n";
			}
		$cad_param_js .="</script>\n";
		echo $cad_param_js;
?>
  <tr>
    <td><?php echo  $fecha_cita ?></td>
    <td><?php echo  Hora::verHora($hora_cita,12); ?></td>
    <td><?php echo  $nombre_med ?></td>
    <td><?php echo  $nombre_pac ?></td>
    <td><?php echo  $estado ?></td>
    <td><a href="javascript:borrar(<?php echo  $cod_cita ?>,document.forma2);">Borrar</a></td>
    <td><a href="javascript:cambiar(<?php echo  $cod_cita ?>,document.forma2);" >Cambiar</a></td>
  </tr>
 <?php 	endfor;
 ?>
<form name="forma2" action="<?php echo  "$PHP_SELF?" ?>" id="forma2" method="post" >
<input name="cod_cita" type="hidden" value="">
</form>
</table>
<?php else :?>
No hay citas asignadas.
<?php endif?>