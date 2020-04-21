<?php 
$user2=new Usuario();
$login_aut = $obj_aut->getUsername();
$tipo_usr = $user2->obtenerTipo($login_aut);
$arr_list_pag= array(
	0=>array('solcita','solicitar citas'),
	1=>array('busqcita','buscar citas'),
	2=>array('nuevohormed','crear horario medico'),
	3=>array('busqhormed','buscar horario medico')
);
?>
<h1>Citas medicas</h1>
<p></p>
Tipo de usuario: <strong><?php echo  $tipo_usr ?></strong>.<br><br>
<p>Tareas a realizar: </p>
<ul>
<?php 
while (list(,$arr_lista)=each($arr_list_pag)) :
	//print_r($arr_lista);
	list($nombpag,$descpag)=$arr_lista;

	if ( $user2->revAutoriz($login_aut,$pagina)) : ?>
	<li> <a href="<?php echo  $PHP_SELF."?pag=$nombpag" ?>"><?php echo  $descpag ?></a></li>
<?php  endif;
endwhile; ?>
<!--   <li> <a href="<?php echo  $PHP_SELF ?>?pag=solcita">solicitar citas</a></li>
  <li> <a href="<?php echo  $PHP_SELF ?>?pag=busqcita">buscar citas</a></li>
  <li> <a href="<?php echo  $PHP_SELF ?>?pag=nuevohormed"> crear horario medico</a></li>
  <li> <a href="<?php echo  $PHP_SELF ?>?pag=busqhormed"> buscar horario medico</a></li> -->
  </li>
</ul>
listo.