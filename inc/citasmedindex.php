<?php  //echo "algo<br>";
$user2=new Usuario();
$login_aut = $obj_aut->getUsername();
$tipo_usr = $user2->obtenerTipo($login_aut);
/* $arr_list_pag= array(
	1=>array('nuevopac','Nuevo paciente'),
	2=>array('nuevomed','Nuevo m&eacute;dico'),
	10=>array('solcita','solicitar citas'),
	11=>array('busqcita','buscar citas'),
	12=>array('nuevohormed','crear horario medico'),
	13=>array('busqhormed','buscar horario medico')
); */
$arr_list_pag= array(
	1=>array('solcita','Solicitar citas'),
	3=>array('admpac','Administrar pacientes'),
	4=>array('admmed','Administrar m&eacute;dicos'),
	10=>array('admcitas','Administrar citas')/* ,
	11=>array('admhormed','Administrar horarios m&eacute;dicos'), */
);
?>
<h1>Citas medicas</h1>
<p></p>
Tipo de usuario: <strong><?php echo  $tipo_usr ?></strong>.<br><br>
<p>Tareas a realizar: </p>
<ul>
<?php 
//while (list(,$arr_lista)= ($arr_list_pag)) :
while ($arr_lista = next($arr_list_pag)) :

	list($nombpag,$descpag)=$arr_lista;

	if ( $user2->revAutoriz($login_aut,$nombpag)) : ?>
	<li> <a href="<?php echo  $PHP_SELF."?pag=$nombpag" ?>"><?php echo  $descpag ?></a></li>
<?php  endif;
endwhile; ?>
</ul>
