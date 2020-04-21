<?php

$_accion= isset($_GET['_accion']) ?$_GET['_accion'] : '';
$login = '';
if (isset($_POST['login']) )
	$login=$_POST['login'];
elseif ( isset($_GET['login'])  )
    $login=$_GET['login'];

$passwd= isset($_POST['passwd']) ? $_POST['passwd'] : '';
$usr1=new Usuario();
if ($_accion == "camb_passwd"){
	$cambio_passwd = $usr1->cambioPasswd($login,$passwd);
	}
?>
<script>
function revisar_contr(forma)
	{
	if (forma.passwd.value != forma.passwd1.value ){
		alert('las nuevas contraseas no coinciden.');
		}
	else if (forma.passwd.value == ''){
		alert('password vacio.');
		}
	else {
		forma.submit();
		return true;
		
		}
	}
function cambiar_vista(id_obj)
	{
	obj = document.getElementById(id_obj)
	if (obj.style.display == 'block')
		obj.style.display = 'none';
	else obj.style.display = 'block';
	}
</script>
<?php //$obj_aut->getUsername(); 
$usr1=new Usuario();
$login_aut = $obj_aut->getUsername();
?>
<p>Usted es <b><?php echo  $usr1->obtenerTipo($login_aut) ?></b></p>
<?php if ($_accion == "camb_passwd" ) :
	if ($cambio_passwd ): ?>
<font color="#0000FF">El usuario '<?php echo  $login ?>' cambi&oacute; sus datos.</font>
<?php 	else : ?>
<font color="#FF0000">El usuario '<?php echo  $login ?>'  no pudo cambiar sus datos.</font>
<?php endif; 
endif;?>

<p>Cambio de contrase&ntilde;a</p>
<form name="form1" method="post" action="<?php echo  $PHP_SELF.'?pag='._ESTAPAG ?>&_accion=camb_passwd">
  <table border="0" cellspacing="5">
 <!--    <tr>
      <td>contrase&ntilde;a actual</td>
      <td><input type="password" name="passwd_act"></td>
    </tr>
    <tr> -->
      <td>nueva contrase&ntilde;a </td>
      <td><input type="password" name="passwd"></td>
    </tr>
    <tr>
      <td>repita nueva contrase&ntilde;a </td>
      <td><input type="password" name="passwd1"></td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="button" name="Submit" value="Cambiar" onClick="revisar_contr(this.form);"></td>
    </tr>
  </table>
  <input type="hidden" name="login" value="<?php echo  $login_aut ?>">
</form>
<p>Esta secci&oacute;n permite administrar los permisos de los usuarios sobre las p&aacute;ginas. 
Los permisos est&aacute;n escalados de la siguiente manera: los usuarios pertenecen a cierto grupo, 
por ejemplo asistentes o administradores. 
Estos grupos tienen acceso a cierto grupo de p&aacute;ginas, por ejemplo, creaci&oacute;n de citas, busqueda, modificacion de citas. </p>
<p><a href="<?php echo  $PHP_SELF ?>?pag=admusr">Administrar usuarios<br>
</a>
  <!-- <p><a href="<?php echo  $PHP_SELF ?>?pag=admtipousr">Administrar tipos de usuarios </a></p>
<p><a href="<?php echo  $PHP_SELF ?>?pag=admtipopag">Administrar tipos de p&aacute;ginas</a> </p> -->
  <a href="<?php echo  $PHP_SELF ?>?pag=admpag">Administrar p&aacute;ginas </a><br>
  <a href="#listTipos" onClick="cambiar_vista('list_tipos')">
  Listar asignaciones de tipos de usuario vs. tareas </a></p>
<a name="listTipos"></a><div id="list_tipos" style="display: none">
  <table width="600" border="1" cellspacing="1" bgcolor="#CCCCCC">
    <tr>
      <th scope="col">tipo de usuario </th>
      <th scope="col">tarea</th>
    </tr>
  <?php 
$arr_lista=$usr1->listaTpUsrPag(); 
//reset($arr_lista);
  // while ($item = next($arr_lista)):
foreach($arr_lista as $arr_list) :
   list($tipo,$tarea)=$arr_list;
?> 
    <tr align="center">
      <td><?php echo  $tipo ?></td>
      <td><?php echo  $tarea ?></td>
    </tr>
   <?php endforeach; ?>
  </table>
</div>
