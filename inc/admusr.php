<h1>Administraci&oacute;n de usuarios </h1>
<?php
$usr1=new Usuario();

$_accion= isset($_GET['_accion']) ?$_GET['_accion'] : '';


if (isset($_REQUEST['login']) )
	$login=$_REQUEST['login'];
else 
	$login = '';
	
$passwd= isset($_POST['passwd']) ? $_POST['passwd'] : '';

$cod_tipo= isset($_POST['cod_tipo'] ) ? $_POST['cod_tipo'] : '';

$login_ant= isset($_POST['login_ant'] ) ? $_POST['login_ant'] : ''; 
if (isset($_accion) ) {
	switch ($_accion) {
		case 'crear_usr' : 
			$usr_creado = $usr1->crear($login,$passwd,$cod_tipo);
			break;
		case 'borrar_usr' :
			$borrar_usr = $usr1->borrar($login);
			break;
		case 'camb_tipo':
			$cod_tipo = $cod_tipo[$login] ?? null;
			$camb_tipo = $usr1->cambioTipo($login,$cod_tipo);
			break;
		case 'mod_usr':
			$mod_usr = $usr1->cambioPasswd($login,$passwd);
			break;
		case 'renombrar':
			$renombrar = $usr1->renombrar($login_ant,$login);
			break;
		default : break;
		}
	echo $usr1->verMsg();
	}
$arr_users = $usr1->listarUsers();

?>
<!-- ------------------- -->
<script language="javascript">
function crearUsr(forma,tipo){
	
	//chequear campos no vacios
	if ( forma.login.value == '' || 
	forma.passwd.value == '' || forma.confpasswd.value == ''){
		alert('alguno de los campos esta vacio. Por favor revise.');
		return false;
		}
	if (forma.passwd.value == forma.confpasswd.value ){
		if (tipo == 2 ) {
			forma.action += '&_accion=mod_usr';
			}
		forma.submit();
		return true;
		}
	else {
		alert('las contraseas no coinciden.');
		}
	}
function enviarforma2(login,accion)
	{
	if (accion == 'camb_tipo'){
		document.form2.action += '&_accion=camb_tipo&login='+login;
		document.form2.submit();
		}
	if (accion == 'mod_usr'){
		//poner visible la capa aquella
		document.form3.login.value=login;
		document.form3.login_ant.value=login;
		//document.form3.cod_tipo.selectedIndex=login;
		document.getElementById('mod_usr').style.visibility= 'visible';
		//window.location.href='#modf_usr';
		}
	}
function renombrar()
	{
	if (document.form3.login.value != ''){
		document.form3.action += '&_accion=renombrar';
		document.form3.submit();
		}
	else {
		alert('El campo de login est vaco.');
		return false;
		}
	}
function borrarUsr(login)
	{
	if (confirm('Esta seguro que desea borrar el login '+login+'?')){
		form2.action = form2.action +'&_accion=borrar_usr&login='+login;
		form2.submit();
		}
	return true;
	}
</script>


<!-- <a href="<?php echo  $PHP_SELF ?>?pag=admindex">regresar al menu</a> -->

<a href="<?php echo  $PHP_SELF.'?pag=' ?>">Regresar</a><br>
<!--
<?php 
if ($_accion == "crear_usr" ) :
	if ($usr_creado == 1 ): ?>
<font color="#0000FF">El usuario '<?php echo  $login ?>' fue creado exitosamente.</font>
<?php 	else : ?>
<font color="#FF0000">El usuario '<?php echo  $login ?>'  ya existe.</font>
<?php endif; 
endif;?>

<?php 
if ($_accion == "borrar_usr" ) :
	if ($borrar_usr ): ?>
<font color="#0000FF">El usuario '<?php echo  $login ?>' fue eliminado.</font>
<?php 	else : ?>
<font color="#FF0000">El usuario '<?php echo  $login ?>'  no se pudo eliminar.</font>
<?php endif; 
endif;?>

<?php 
if ($_accion == "renombrar" ) :
	if ($renombrar ): ?>
<font color="#0000FF">El usuario '<?php echo  $login ?>' cambi&oacute; su nombre.</font>
<?php 	else : ?>
<font color="#FF0000">El usuario '<?php echo  $login ?>'  no pudo cambiar su nombre.</font>
<?php endif; 
endif;?>

<?php if ($_accion == "mod_usr" ) :
	if ($mod_usr ): ?>
<font color="#0000FF">El usuario '<?php echo  $login ?>' cambi&oacute; sus datos.</font>
<?php 	else : ?>
<font color="#FF0000">El usuario '<?php echo  $login ?>'  no pudo cambiar sus datos.</font>
<?php endif; 
endif;?>

<?php if ($_accion == "camb_tipo" ) :
	if ($camb_tipo ): ?>
<font color="#0000FF">El usuario '<?php echo  $login ?>' cambi&oacute; el tipo.</font>
<?php 	else : ?>
<font color="#FF0000">El usuario '<?php echo  $login ?>'  no pudo cambiar su tipo.</font>
<?php endif; 
endif;?>-->

<h2>Crear usuario</h2>
<form name="form1" method="post" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG&_accion=crear_usr" ?>">
  <table border="0" cellspacing="5">
    <tr>
      <td>login</td>
      <td><input type="text" name="login"></td>
    </tr>
    <tr>
      <td>contrase&ntilde;a</td>
      <td><input type="password" name="passwd"></td>
    </tr>
    <tr>
      <td>confirmar contrase&ntilde;a </td>
      <td><input type="password" name="confpasswd"></td>
    </tr>
    <tr>
      <td>tipo de usuario </td>
      <td><select name="cod_tipo">
	  <?php echo  $usr1->listarTipos(); ?>
       </td>
    </tr>
    <tr align="center">
      <td colspan="2"><input type="button" name="Submit" value="Crear" onClick="crearUsr(this.form,1);"></td>
    </tr>
  </table>
</form>

<br>
<h2>Listar usuarios </h2>
<form name="form2" method="POST" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG" ?>">
  <table border="1" cellspacing="3">
    <tr>
      <th scope="col">login</th>
      <th scope="col">tipo</th>
      <th scope="col">modificar </th>
      <th scope="col">borrar</th>
    </tr>
   <?php 
   reset($arr_users);
   //while (list(,$arr_usr)=each($arr_users)):
   while ($arr_usr= next($arr_users)):
    list($cod,$login1,$tipo)=$arr_usr;
   ?>
    <tr>
      <td><?php echo $login1?></td>
      <td><select name="cod_tipo[<?php echo  $login1 ?>]">
          <?php echo  $usr1->listarTipos($tipo); ?>
          </select>&nbsp;
		  <a href="#" onClick="enviarforma2('<?php echo  $login1 ?>','camb_tipo');">cambiar</a></td>
      <td><a href="#modf_usr" onClick="enviarforma2('<?php echo  $login1 ?>','mod_usr');">modificar</a></td>
      <td><a href="#" onClick="borrarUsr('<?php echo  $login1 ?>');">borrar</a></td>
    </tr>
	<?php 
	endwhile;
	?>
  </table>
</form>

<div style="visibility: collapse" id="mod_usr">
  <a name="modf_usr"></a><h2>Modificar Usuario</h2>
  <form name="form3" method="post" action="<?php echo  "$PHP_SELF?pag=$_ESTAPAG" ?>">
    <table border="0" cellspacing="5">
      <tr>
        <td>login</td>
        <td><input type="text" name="login"> 
          &nbsp;
          <input type="button" name="Submit" value="renombrar" onClick="renombrar();"></td>
      </tr>
      <tr>
        <td>contrase&ntilde;a</td>
        <td><input type="password" name="passwd"></td>
      </tr>
      <tr>
        <td>confirmar contrase&ntilde;a </td>
        <td><input type="password" name="confpasswd"></td>
      </tr>
      <!-- <tr>
        <td>tipo de usuario </td>
        <td><select name="cod_tipo">
          <?php echo  $usr1->listarTipos($tipo); ?>
          </select></td>
      </tr> -->
      <tr align="center">
        <td colspan="2"><input type="button" name="cambiar" value="Cambiar" onClick="crearUsr(this.form,2);"></td>
      </tr>
    </table>
	<input name="login_ant" type="hidden" value="">
    </form>
</div>
 


 
 


