<?php 
$ruta_pear = dirname(__FILE__) . '/../PEAR/';
//ini_set('include_path' , ini_get('include_path') . PATH_SEPARATOR . $ruta_pear);
ini_set('include_path' , $ruta_pear);
require_once "Auth.php";
require_once "PEAR.php";
//require_once 'DB.php';
require_once 'MDB2.php' ;
require_once 'Pager/Pager.php';

/* DEFINICION DE LAS FUNCIONES */
/*
funcion nombre pagina
retirar la extension del nombre del archivo o pagina 
*/
function nombre_pagina($pagina){
	$base=substr ($pagina, 0,-4); //4=num de caracteres de la extension php(3) + 1
	//echo "<b>nombre pagina=$base\n</b>";
	return $base;
	}

function asignaArrayPager($arreglo)
	{
	global $CITAS_MEDICAS;
	$CITAS_MEDICAS['params_pager']['itemData'] = $arreglo;
	return $CITAS_MEDICAS['params_pager'];
	}

function enlace($nombre,$pag)
	{
	return '<a href="' . enlace_corto($pag) .'">' . $nombre . '</a>' ;
	}

function enlace_corto($pag)
	{
	return $_SERVER['PHP_SELF'].'?pag=' . $pag;
	}

/*
FUNCIONES DE INCLUSION DE ARCHIVOS
incluye el archivo y revisa el tipo de pagina desde donde se llama.
*/

function incluirArchivo($archivo,$tipo="normal"){
	global $hora_in,$hora_fin,$obj_aut, $_accion, //$ruta_paginas, $ruta_paginas_admin,
	 //$INDEX_ADMIN,$INDEX_RAIZ,
	$CITAS_MEDICAS;
	//pagina por defecto
	if ($archivo == "") {
	/*	if ($tipo == "admin" ) {
			$archivo=INDEX_ADMIN;
			} 
		else */
		$archivo = INDEX_RAIZ;
		//return false;
		}
/*	if ($tipo == "admin") {
		 $ruta_paginas = RUTA_PAGINAS_ADMIN;
		 }
	else {
		 $ruta_paginas = RUTA_PAGINAS;	
		} */
	//$ruta_paginas = RUTA_PAGINAS;
	
	$archivo_comp = dirname($_SERVER["SCRIPT_FILENAME"]) . '/inc/'.$archivo.".php"; // echo "ac: $archivo_comp";
	//echo "arch=$archivo_comp<br>";
	if ($archivo_comp != $_SERVER["SCRIPT_FILENAME"]  and is_file($archivo_comp) ){
		//define("_ESTAPAG",$archivo);
		
		$_ESTAPAG=$archivo;
		define('_ESTAPAG' , $archivo);
		
		$PHP_SELF=$_SERVER['PHP_SELF'];
		include "$archivo_comp";
		}
	else echo "El archivo $archivo no existe.<br>";
	}
function incluirArchivobase($archivo){
	global $ruta_paginas,$hora_in,$hora_fin;
	$archivo_comp="$ruta_paginas".'/'.$archivo.".php";
	if ($archivo_comp != $_SERVER["SCRIPT_FILENAME"]  and is_file($archivo_comp) )
		include "$archivo_comp";
	}

/*
FUNCION mostrarlogin
Esta funcion es usada por la funcion de Auth-Pear para solicitar el login y el password
*/
function mostrarlogin(){ return true; }


/*
CLASE HORA
Manejo de la hora en la administracion de horarios
*/

class hora{
  var $h; //hora
  var $m; // minutos
  var $s; // segundos
  var $segt; //segundos contados desde las cero horas
  var $formato; // am/pm (12) o 24horas (24)
  

 /*constructor de la clase	
 asigna las variables internas sus valores de horas
 minutos y segundos
 */
  function __construct($hora="00:00:00"){
    list($h,$m,$s) = explode(":",$hora);
 	$this->h=$h;
	$this->m=$m;
	$this->s=$s;
  	$this->segt=$h*3600+$m*60+$s;
	}
  //tiempo total
  //function Tt($h,$m,$s){
  function tT(){
    //$seg=$h*3600+$m*60+$s;
	$seg=$this->h*3600+$this->m*60+$this->s;
  	return $seg;
	} 
 
  function sep($seg){
  	$this->h=floor($seg/3600);
	$res=$seg-$this->h*3600;
	$this->m=floor($res/60);
	$this->s=$res-$this->m*60;
	}
 function h($seg){return floor($seg/3600);}
 function m($seg){
 	$h=floor($seg/3600);
	$res=$seg-$h*3600;
	return floor($res/60);
	}
  function s($seg){
  	$h=floor($seg/3600);
	$res=$seg-$h*3600;
	$m=floor($res/60);
	return $res-$m*60;
	}
	/* function hora2($hora){
	   list($h,$m,$s) = split(":",$hora);
		$this->h=$h;
		$this->m=$m;
		$this->s=$s;
		$this->segt=$h*3600+$m*60+$s;	
		} */
	//devuelve el tiempo total en segundos
	static function horAseg($hora)
		{
		if ($hora == '') return $hora;
		list($h,$m,$s) = explode(":",$hora);
		//$seg=$this->h*3600+$this->m*60+$this->s;
		return $h*3600+$m*60+$s;
  		
		}
	//devuelve la hora en el formato hh:mm:ss recibiendo segundos absolutos
	static function segAhora($seg)
		{
	 	$h=floor($seg/3600);
		$res=$seg-$h*3600;
		$m=floor($res/60);
		$s=$res-$m*60;
		$cad = sprintf("%02d:%02d:%02d",$h,$m,$s);
		return $cad;
		}
	/*
	suma horas, recibe cadenas del formato 
	hh:mm:ss
	y lo retorna en el mismo formato
	*/
	static function sumar($hora1,$hora2)
		{
		$resul = hora::horAseg($hora1)+hora::horAseg($hora2);
		return hora::segAhora($resul);
		}
		
	 static function verHora($hora,$tipo){
		list($h,$m,$s) = explode(":",$hora);
		if ($h > 12) { $h -= 12; $merid = "pm"; }
			elseif ($h == 12 ){$merid = " m";}
			else $merid = "am";
		switch($tipo){
		case 12:
		case '12':
			return sprintf("%02d:%02d:%02d %s",$h,$m,$s,$merid);
			break;
		case '0seg':
			return sprintf("%d:%02d %s",$h,$m,$merid);
			break;
		case '12.1': 
			return sprintf("%d:%02d",$h,$m);break;
		default:
			return sprintf("%02d:%02d:%02d",$h,$m,$s);
			}
		}	 
	static function verRango($hora_fija="")
		{
		global $_HORA_IN,$_HORA_FIN;
		$hora=$_HORA_IN;
		//$this->formato = 12;
		$cad = '';
		
		while(hora::horAseg($hora) <= hora::horAseg($_HORA_FIN) ){
			if ($hora_fija == $hora ) {
				$selec= "selected";
				}
			else $selec="";
			$cad .= "<option value=\"$hora\" $selec>".hora::verHora($hora,'0seg')."</option>\n";
			$hora = hora::sumar($hora,"1:00:00");
			//echo "$hora<br>";
			}
		return $cad;
		}
}

Class Fecha {
	/*
	convertir fecha en formato YYYY-MM-DD
	a un formato identico en pero el mes empieza en cero
	*/
	function fechaAjs($fecha)
		{
		list($A,$M,$D) = split("-",$hora);
		$cad = sprintf("%02d:%02d:%02d",$A,$m-1,$D);;
		return $cad;
		}

	/* 
	convierte fecha a tiempo absoluto
	tiempo marcado desde 1 de enero de 1970
	*/
	static function fechaAabs($fecha)
		{
		if ($fecha=='') return NULL;
		list($A,$M,$D) = explode("-",$fecha);
		//$cad = sprintf("%02d:%02d:%02d",$A,$m-1,$D);;
		$cad = mktime(0, 0, 0, $M, $D, $A);
		//echo date("M-d-Y",$cad);
		return $cad;
		}
	/*
	funcion fechaAdiaSem
	obtiene el dia de la semana respectivo de la 
	fecha introducida
	tipo puede ser 'num' o 'nombre'
	'num' si el valor devuelto es el numero relativo, 0 es domingo, 6 es sabado
	'nombre' si el valor devuelto debe ser el nombre del dia
	*/	
	static function fechaAdiaSem($fecha,$tipo='num')
		{
		//global $CITAS_MEDICAS;
		//$dia_inicio_sem = $CITAS_MEDICAS['DIA_INICIO_SEMANA'];	
		//echo "dia relativo = $dia_rel_num<br>";
		if ($tipo == 'num') {
			$cad_tipo = 'w';
			
			$dia_rel = date('w',Fecha::fechaAabs($fecha)); 
			//echo "dia = $dia_rel<br>";
			$dia_rel = Fecha::DiaPHPaNum($dia_rel,1);
			//echo "dia rel = $dia_rel";
			return $dia_rel;
			}
		else {
			$cad_tipo = 'l';
			$dia_rel = date('l',Fecha::fechaAabs($fecha));
			return $dia_rel;
			}
		}
	/*
	funcion numAdiaPHP
	convierte el dia  de la semana PHP 0-6 -> Domingo -Lunes, devuelto por Date
	a dia  en el formato 0-6 -> lunes- domingo, si pos_rel es 1
	*/
	
	static function  DiaPHPaNum($dia,$pos_rel)
		{
		if ($dia >= $pos_rel ){
			$pos_nueva = $dia - $pos_rel;
			}
		else {
			$pos_nueva = $dia + 7 - $pos_rel;
			}
		return $pos_nueva;
		}
	}

/*
REVISAR LA AUTORIZACION DE UN USUARIO A UNA PAGINA ESPECIFICA
solicita login y el nombre de la pagina
esta funcion es valida solo para los admins
 */

/* 
DEFINICION DE LAS CLASES PARA MANEJAR LAS CITAS MEDICAS

*/

class citasMedicas extends MDB2 {
	var $conex;
	var $msg;
	var $error=false;
	function __construct()
		{
		$this->conex=self::conect();
		return $this->conex;
		}

	public static function conect()
		{
		global $CITAS_MEDICAS;
		//conexion a la bd
		$opciones = array(
			'debug'       => 5,
			//'portability' => MDB2_PORTABILITY_ALL
		);
		
		$db = MDB2::connect($CITAS_MEDICAS['dsn_mysql'] , $opciones);
		if (PEAR::isError($db)) {
    		die($db->getMessage());
			}
		$db->loadModule('Extended');	
		return $db;
		}
	function mostrarMsg(){
	if (! isset($this->msg) ) return false;
		if ($this->error ) {
			$cad = '<font color="red">'.$this->msg.'</font>';
			}
		else {
			$cad = '<font color="blue">'.$this->msg.'</font>';
			}
		return $cad;
		}
	static function verTipoDoc($doc=''){
		//$db= $this->conex;
		$db= citasMedicas::conect();
		$consulta = "SELECT codigo,nombre FROM tipo_doc";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$cad = '';
		
		while($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)){
			$tipo = $row['codigo'];
			$nombre = $row['nombre'];
			if ($tipo == $doc or $nombre == $doc )
				$sel="selected";
			else $sel = '';
			$cad .= "<option value=\"$tipo\" $sel>$nombre</option>\n";
			}
		echo $cad;		
		}
	function nombreTipoDoc($codigo)
		{
		$db= citasMedicas::conect();
		$consulta = "SELECT nombre FROM tipo_doc WHERE codigo = $codigo";
		$res = $db->getOne($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		return $res;
		}
	function lanzarErr($msg)
		{
		$this->error = true;
		$this->msg = "Error: $msg";
		return false;
		}

	function lanzarErrBD($res)
		{
		$this->error = true;
//		$this->msg = $res->getMessage();
		$this->msg = "Error en la BD: ".$res->getUserInfo();
		return false;
		}
		
		
	function msgOK($msg)
		{
		$this->error = false;
		$this->msg = $msg;
		return true;
		}
	function verMsg()
		{
		if ($this->error){
			$color = 'red';
			}
		else {
			$color = 'blue';
			}
		$msg = "<font color=\"$color\">" . $this->msg . "</font><br />";
		return $msg;
		}	

	function getOne(){
		return 'bla';
	}		
}

/*
DEFINICION DE LA CLASE USUARIOS QUE MANEJA LOS USUARIOS CON PERMISOS A PAGINAS
*/

class Usuario extends citasMedicas{
	var $login;
	var $contrasegna;
	var $tipo;

	function crear($login, $passwd, $tipo)
		{

		$db=$this->conex;
		$consulta="INSERT INTO usuarios (login,password,cod_tp_usr) VALUES ('$login',md5('$passwd'),'$tipo')";
		//echo "consulta='$consulta'<br>";
		$res = $db->query($consulta);
		
		//revisar posibles errores
		if (PEAR::isError($res)) {
			if ($res->getCode() == -5) {
				return $this->lanzarErrBD($res);
				}
			return $this->lanzarErr("El usuario '$login' ya existe.");
//			return false;
			}
		return $this->msgOK('El usuario ' . $login . ' fue creado.');
//		return true;
		}
	function listarTipos($tipo="")
		{
		$db=$this->conex;
		$consulta="SELECT codigo,nombre FROM tipo_usr";		
		$res = $db->query($consulta);
		if (PEAR::isError($db)) {
    		die($db->getMessage());
			}
		$resul = '';
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			if ($tipo == $row['codigo'] or $tipo == $row['nombre'] )
				$cadsel="selected";
			else $cadsel="";
			$resul.='<option value="'.$row['codigo'].'" '.$cadsel.'>'.$row['nombre']."\n";
			}
	return $resul;
		}
	function listarUsers(){

		$db=$this->conex;
		$consulta="SELECT u.codigo as codigo, login, nombre AS tipo FROM `usuarios` u, tipo_usr tu
WHERE u.cod_tp_usr = tu.codigo ORDER BY u.codigo";		
		$res = $db->query($consulta);
		if (PEAR::isError($db)) {
    		die($db->getMessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$resul[]=array($row['codigo'],$row['login'],$row['tipo']);
			}
		//print_r($resul);
		return $resul;
		}
	function borrar($login)
		{

		$db=$this->conex;
		/*$consulta1="SELECT 1 FROM usuarios WHERE login='$login'";
		$data =$db->getOne($consulta1);
		if (! $data) {
			$this->msg = "el usuario no existe.";
			return false;
			} */
		$consulta="DELETE FROM usuarios WHERE login='$login'";		
		//echo $consulta."<br>";
		$res = $db->exec($consulta);
		if (PEAR::isError($res)) {
    		return $this->lanzarErrBD($res);
			}
		//if ($db->_affectedRows() == 0 ) {
	    if ($res == 0 ) {
			return $this->lanzarErr('No existen usuarios con ese login.');
			}
		return $this->msgOK('El usuario fue borrado exitosamente.');
		}

	function cambioTipo($login,$tipo)
		{ //		$db=$this->conex; 		//$consulta=;		
		$res = $this->conex->query("UPDATE usuarios set cod_tp_usr='$tipo' WHERE login='$login'");
		if (PEAR::isError($res)) {
    		return $this->lanzarErrBD($res);
			}
		return $this->msgOK('El usuario fue cambiado de tipo exitosamente.');
		}
	function renombrar($login_actual, $login_nuevo)
		{	//$db=$this->conex;	 $consulta=""; //echo $consulta."<br>";
		$res =$this->conex->query("UPDATE usuarios set login='$login_nuevo' WHERE login='$login_actual'");
		if (PEAR::isError($res)) {
    		return $this->lanzarErrBD($res);
			}
		return $this->msgOK('El usuario fue renombrado exitosamente.');
		}
	function cambioPasswd($login,$passwd)
		{ //$db=$this->conex;  $consulta=; 	//echo $consulta."<br>";
		$res = $this->conex->query("UPDATE usuarios set password = md5('$passwd') WHERE login='$login'");
		if (PEAR::isError($res)) {
    		return $this->lanzarErrBD($res);
			}
		return $this->msgOK('El usuario se le cambio la contrase&ntilde; exitosamente.');
		}
	function listaTpUsrPag()
		{
		$db=$this->conex;
		$consulta="SELECT tu.nombre as tipo_usuario, t.nombre as tarea 
		FROM tipo_usr tu, tareas t,usr_tarea ut  
		WHERE  tu.codigo=ut.cod_tp_usr and t.codigo=ut.cod_tarea";
		$res = $db->query($consulta);
		if (PEAR::isError($db)) {
    		die($db->getMessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$resul[]=array($row['tipo_usuario'],$row['tarea']);
			}
		//print_r($resul);
		return $resul;
		}
	function obtenerTipo($login)
		{
		$db=$this->conex;
		$consulta="SELECT tu.nombre FROM tipo_usr tu, usuarios u
WHERE tu.codigo = u.cod_tp_usr AND u.login = '$login'";
		$data = $db->getOne($consulta);
		if (! $data) {
			$this->msg="El login no existe, o no tiene tipo asociado.";
			return false;
			}
		else return $data;
		}
	function revAutoriz($login,$pagina){
		$db=$this->conex;
		if ($pagina == '') {
			return true;
			}
		$consadmin="SELECT 1 FROM usuarios u LEFT JOIN tipo_usr tu 
		ON u.cod_tp_usr=tu.codigo WHERE u.login='$login' AND tu.nombre='administrador'";
		
		$data = $db->getOne($consadmin);
		if ( $data) {
			//el usuario es administrador
			return true;
			}
		$consulta="SELECT 1 FROM usuarios u LEFT JOIN usr_tarea ut 
		ON  ut.cod_tp_usr=u.cod_tp_usr  LEFT JOIN paginas p 
		ON  p.cod_tarea = ut.cod_tarea WHERE  u.login='$login' AND p.nombre='$pagina'";
		//echo "consulta = $consulta.<br>";
		$data = $db->getOne($consulta);
		if (! $data) {
		$this->msg = "El usuario no tiene permisos.";
			return false;
			}
		else return true;
		} 
	}

/*

DEFINICION DE LA CLASE Y METODOS PARA EL MANEJO DE LAS PAGINAS
DE MANERA ADMINISTRATIVA

*/
	
Class Pagina extends citasMedicas {
	var $nombre;
	var $tarea_asignada;
	var $directorio; //directorio relativo del web o del disco, opcional
//	var $conex;
	
	function crear($pagina,$cod_tarea)
		{
		/*if (!is_object($this->conex)){
			$this->Paginas;
			}*/
		$db=$this->conex;
		$consulta="INSERT INTO paginas (nombre,cod_tarea) VALUES ('$pagina', '$cod_tarea')";		
		$res = $db->query($consulta);
		
		if (PEAR::isError($res) and $res->getCode() == -5) {
			$this->msg="La p&aacute;gina '$pagina' ya existe.";
			return false;
			}
		return true;
		}
	function quitar($pagina)
		{
		$db=$this->conex;
		$consulta1="SELECT 1 FROM paginas WHERE nombre='$pagina'";
		$data = $db->getOne($consulta1);
		if (! $data) {
			$this->msg = "La p&aacute;gina no existe.";
			return false;
			}
		$consulta="DELETE FROM paginas WHERE nombre='$pagina'";		
		//echo $consulta."<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}

		return true;
		}
	function cambiarTarea($pagina, $cod_tarea)
		{
		$db=$this->conex;
		$consulta="UPDATE paginas set cod_tarea='$cod_tarea' WHERE nombre='$pagina'";		
		//echo $consulta."<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		return true;
		}
	function renombrar($pag_actual,$pag_nueva)
		{
		$db=$this->conex;
		$consulta="UPDATE paginas set nombre='$pag_nueva' WHERE nombre='$pag_actual'";		
		//echo $consulta."<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		return true;
		}
	function listar()
		{
		$db=$this->conex;
		$consulta="SELECT codigo,nombre AS pagina, cod_tarea FROM paginas";		
		$res = $db->query($consulta);
		if (PEAR::isError($db)) {
    		die($db->getMessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$resul[]=array($row['codigo'],$row['pagina'],$row['cod_tarea']);
			}
		//echo "<pre>";print_r($resul);echo "</pre>";
		return $resul;
		}
 	function listarTareas($tarea="")
		{
		$db=$this->conex;
		$consulta="SELECT codigo,nombre FROM tareas";		
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$resul = '';
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			if ($tarea == $row['codigo'] or $tarea == $row['nombre'] )
				$cadsel="selected";
			else $cadsel="";
			$resul.='<option value="'.$row['codigo'].'" '.$cadsel.'>'.$row['nombre']."\n";
			} 
		return $resul;
		} 
	}
	
class Medico extends citasMedicas{
	function crear($nombre,$doc_id,$tipo_doc,$cat,$oficina)
		{
		$db = $this->conex;
		$consulta = "INSERT medicos (nombre,doc_ident,tipo_doc, cod_tipo,oficina) 
		VALUES ('$nombre', '$doc_id','$tipo_doc','$cat', '$oficina')";
		//echo "consulta = $consulta<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res) and $res->getCode() == -5) {
			$this->msg="El m&eacute;dico '$nombre' ya existe.";
			$this->error=1;
			return false;
			}
		$this->msg="El m&eacute;dico '$nombre' fu&eacute; creado.";
		return true;
		}
	
	function verCats($cat='')
		{
		$db= $this->conex;
		$consulta = "SELECT codigo,nombre FROM tipo_med";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$cad = '';
		
		while($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)){
			$tipo = $row['codigo'];
			$nombre = $row['nombre'];
			if ($tipo == $cat or $nombre == $cat )
				$sel = "selected";
			else $sel = '';
			$cad .= "<option value=\"$tipo\" $sel>$nombre</option>\n";
			}
		echo $cad;
		}
	function listar(){

		$db=$this->conex;
		$consulta="SELECT m.*, tm.nombre as tipo_medico,td.nombre as tipo_docu 
		FROM medicos m left join tipo_med tm on m.cod_tipo = tm.codigo 
		left join tipo_doc td on m.tipo_doc = td.codigo";		
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$resul[]=$row;
			}
		//print_r($resul);
		return $resul;
		}
	function modif($idmed,$nombmed,$doc_id,$tipo_doc,$categoria,$oficina)
		{
		$db=$this->conex;
		$consulta="UPDATE medicos set nombre='$nombmed',doc_ident='$doc_id' ,
		tipo_doc = '$tipo_doc', cod_tipo ='$categoria', oficina = '$oficina' WHERE codigo = '$idmed'";		
		//echo $consulta."<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
 		$this->msg="Hubo un error al modificar el m&eacute;dico '$nombre'.";
			$this->error=1;
			return false;
			}
		$this->msg="El m&eacute;dico '$nombmed' fu&eacute; modificado.";
		return true;
		}
	function borrar($codigo)
		{
		$db=$this->conex;
		$consulta1="SELECT 1 FROM medicos WHERE codigo='$codigo'";
		$data = $db->getOne($consulta1);
		if (! $data) {
			$this->msg = "El m&eacute;dico no existe.";
			return false;
			}
		$consulta="DELETE FROM medicos WHERE codigo='$codigo'";		
		//echo $consulta."<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		/* Borrar sus horarios relacionados
		de las tablas horarios_medicos y horario_nodisp
		*/
		$registro_hor_borrados = HorarioMedico::borrarTodosPrin($codigo);		
		$registro_hornodisp_borrados = HorarioMedico::borrarTodosNoDisp($codigo);
		$this->msg = "El m&eacute;dico fu&eacute; eliminado.";
		return true;
		}
	/*
	Obtiene el nombre del medico con el codigo
	*/
	static function nombre($codigo)
		{
		$db=CitasMedicas::conect();
		$consulta = "SELECT nombre FROM medicos WHERE codigo = '$codigo'";
		$nombre = $db->getOne($consulta);
		if (PEAR::isError($nombre)){
			die($nombre->getmessage());
			}
		return $nombre;
		}
	/*
	funcion HorMed
	Obtiene un array asociativo donde cada llave es la hora y el valor
	es la disponibilidad
	usa las tablas horarios_medicos y horario_nodisp
	*/
	static function HorarioMed($codmed,$fecha){
		$db = CitasMedicas::conect();
		$consulta = "SELECT hora_in,dias_selec
		 FROM horarios_medicos WHERE cod_med= $codmed";
		$res =  $db->query($consulta);
		if (PEAR::isError($res)){
			die("consulta='$consulta'\n".$res->getmessage());
			}
		$resul = array();
		if ($res->numRows() == 0){
			return false;
			}
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			$hora =$row['hora_in'];			//$resul[] = $row;
			//$dias_selec = sprintf("%b",strval($row['dias_selec']));  // 53decimal
			$dias_selec = sprintf("%07b",$row['dias_selec']);  // 1010111
			$dias_selec = strrev($dias_selec); // invierte la cadena
			$dia_sem = Fecha::fechaAdiaSem($fecha,'num');  // lunes..domingo ; 0,1..5,6
			$estado_dia = $dias_selec{$dia_sem};	// posicion relativa del dia.
			$resul[$hora] = $estado_dia;
			}
		//obtener los horarios de no disponibilidad
		$consulta2 = "SELECT UNIX_TIMESTAMP('$fecha') as fecha,
		UNIX_TIMESTAMP(fecha_in) as fecha_in, UNIX_TIMESTAMP(fecha_fin) as fecha_fin, 
		 hora_in, hora_fin
		 FROM horario_nodisp WHERE cod_med = $codmed";
		$res = $db->query($consulta2);
		if (PEAR::isError($res)){
			die("consulta='$consulta2'\n".$res->getmessage());
			}
		//fecha_ts = Hora::fechaAabs($fecha);
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			$fecha_ts =$row['fecha'];
			$fecha_in =$row['fecha_in'];
			$fecha_fin =$row['fecha_fin'];
			$hora_in =Hora::horAseg($row['hora_in']);
			$hora_fin =Hora::horAseg($row['hora_fin']);
			//echo "fecha_ts=$fecha_ts,fecha_in=$fecha_in,fecha_fin:'$fecha_fin'<br>
			//hora_in='$hora_in',hora_fin='$hora_fin'<br> ";
			if (  $fecha_ts == $fecha_in  and $fecha_fin == '' or
			$fecha_ts >= $fecha_in and $fecha_ts <= $fecha_fin and $fecha_fin != '' ){
				if ($hora_in != '' ){
					//barre las horas del arreglo $resul para encontrar coincidencia en alguna
					foreach ($resul as $hora => $estado ){
						$hora_s = Hora::horAseg($hora);
						//echo "hora_s='$hora_s' ";
						if ($hora_s >= $hora_in and $hora_s <= $hora_fin ){
							$resul[$hora] = 0;
							}
						}
					}
				else {
					//echo "aqui.";
					//pone a ceros el arreglo
					foreach($resul as $hora =>$x) {
						$resul[$hora] = 0;
						//echo "resul[$hora] = $resul[$hora],";
						}
					}
				}
			}
		//print_r($resul);
		return $resul;
		
		} 
		
	static function listarMedicos(){
		$db = CitasMedicas::conect();
		$consulta = "SELECT * FROM medicos";
		$res =  $db->query($consulta);
		if (PEAR::isError($res)){
			die($res->getmessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			$resul[]=$row;
			}
		return $resul;
		}
	function algunHorario()
		{
		$sql = "SELECT count(*) FROM horarios_medicos";
		$res = $this->conex->getOne($sql);
		if (PEAR::isError($res)){
			return $this->lanzarErrBD($res);
			}
		return $res;
		}
	}	

class HorarioMedico extends citasMedicas
	{
	var $dias_semana = array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');
	
	function horarioExiste($codigo)
		{
		$db=$this->conex;
		$consulta="SELECT 1 FROM med_horario_med WHERE cod_med= '$codigo'";
		$data =$db->getOne($consulta);
		if (! $data) {
			$this->msg = "El horario no existe.";
			return false;
			}
		return true;
		}
	function horPrinExiste($idmed)
		{
		$db=$this->conex;
		$consulta="SELECT 1 FROM horarios_medicos WHERE cod_med= '$idmed'";
		$data =$db->getOne($consulta);
		if (! $data) {
			$this->msg = "El horario no existe.";
			return false;
			}
		return true;

		}
	/*
	funcion crearPrincipal
	crea el horario principal, el cual es nico para cad mdico
	este horario solo se crea una vez
	$arr_horarios es un array asociativo, cada llave es el horario en si,
	el valor es la disponibilidad de los dias modificada
	*/
	function crearPrincipal($idmed,$arr_horarios)
		{
		$hora1 = new hora;
		$db = $this->conex;
		$consulta = "INSERT horarios_medicos (cod_med,hora_in,dias_selec)";
		$llaves = array_keys($arr_horarios);
		$disp_dias = $arr_horarios[$llaves[0]];
		$hora_in = $hora1->segAhora($llaves[0]);
		$consulta .= " VALUES ('$idmed','$hora_in','$disp_dias')";
		
		for($i = 1; $i < sizeof($llaves); $i++){
			$disp_dias = $arr_horarios[$llaves[$i]];
			$hora_in = $hora1->segAhora($llaves[$i]);
			$consulta .= ",  ('$idmed','$hora_in','$disp_dias')";
			}
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			die($res->getmessage());
			$this->error=1;
			return false;
			}
		$this->msg="El horario fu&eacute; creado.";
		return true;	
		}

	function modifPrincipal($idmed,$arr_horarios)
		{
		$hora1 = new hora;
		$db = $this->conex;
		//$consulta = "REPLACE horarios_medicos (cod_med,hora_in,dias_selec)";
		//$consulta = "UPDATE horarios_medicos SET ";
		$llaves = array_keys($arr_horarios);
		$disp_dias = $arr_horarios[$llaves[0]];
		$hora_in = $hora1->segAhora($llaves[0]);
		//$consulta .= " VALUES ('$idmed','$hora_in','$disp_dias')";
		$consulta = " UPDATE horarios_medicos SET  dias_selec='$disp_dias'
		WHERE cod_med = $idmed and hora_in = '$hora_in'";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
			die($res->getMessage());
			}
		for($i = 1; $i < sizeof($llaves); $i++){
			$disp_dias = $arr_horarios[$llaves[$i]];
			$hora_in = $hora1->segAhora($llaves[$i]);
			//$consulta .= ",  ('$idmed','$hora_in','$disp_dias')";
			$consulta = " UPDATE horarios_medicos SET  dias_selec='$disp_dias'
		WHERE cod_med = $idmed and hora_in = '$hora_in'";
			$res = $db->query($consulta);
			if (PEAR::isError($res)) {
				die($res->getMessage());
				}
			}
		$this->msg="El horario fue reemplazado.";
		return true;		
		}
	// obtener la lista de los horarios medicos para el dr. idmed
	// y devolverlos en un arreglo
	function listar($idmed)
		{
		$db= $this->conex;
		$consulta = "SELECT * FROM horario_nodisp WHERE cod_med='$idmed'";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$resul[]=$row;
			}
		return $resul;
		}
	/*
	funcion borrarHorNoDisp
	Borra el horario de no disponibilidad
	*/
	function borrarHorNoDisp($id_hor_nodisp)
		{
		$db=$this->conex;
		$consulta = "DELETE FROM horario_nodisp WHERE codigo = '$id_hor_nodisp'";
		//echo "consulta1 = $consulta<br>";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$this->msg = "El horario m&eacute;dico fue borrado.";
		return true;
		}
	function listTipHor($tipo_sel)
		{
		$arr_tipo= array('disponible', 'no disponible');
		foreach ($arr_tipo as $tipo){
			if ($tipo_sel == $tipo) {
				$selec="selected";
				}
			else $selec="";
			
			$cad .= '<option value="'.$tipo.'" '.$selec.'>'.$tipo.'</option>'."\n";
			}
		return $cad;
		}
	function listCatHor($tipo_sel)
		{
		$arr_tipo= array('semanal', 'por dias');
		foreach ($arr_tipo as $tipo){
			if ($tipo_sel == $tipo) {
				$selec="selected";
				}
			else $selec="";
			
			$cad .= '<option value="'.$tipo.'" '.$selec.'>'.$tipo.'</option>'."\n";
			}
		return $cad;
		}
	/*
	funcion generaTabla
	Esta funcion se encarga de crear una tabla dinamicamente, con el listado de horarios,
	vs. los dias de la semana, y ademas debe mostrar en cada elemento de la tabla, 
	si esta disponible u ocupado.
	*/
	function generaTabla($idmed=NULL)
		{
		global $_HORA_IN,$_HORA_FIN,$CITAS_MEDICAS;
		$color_disp  = $CITAS_MEDICAS['COLOR_HOR_DISP'];
		$color_nodisp = $CITAS_MEDICAS['COLOR_HOR_NODISP'];
		$db = $this->conex;
		$hora1=new hora;
		$dias = array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');
		$tabla = "<tr>
      <td scope=\"col\" class=\"borde_delgado\" >horario";
      	foreach($dias as $dia){
			if ($dia == 'sabado' or $dia == 'domingo'){
				$color_dia = $color_nodisp;
				}
			else $color_dia = $color_disp;
			$tabla .= "<td scope=\"col\" class=\"borde_delgado\" id=\"dia_$dia\" 
	  onClick=\"horario1.cambiaEstado('dia_$dia');\" 
	  bgcolor=\"$color_dia\">$dia\n";
	  		}
		if ($idmed != NULL) {
			$arr_estados = $this->obtenerEstado($idmed);
			}
		$hora2=$_HORA_IN;
		while($hora1->horAseg($hora2) <= $hora1->horAseg($_HORA_FIN) ){
			$hora_sig = $hora1->sumar($hora2,"1:00:00");
			$id_tdg = "hora_".$hora1->horAseg($hora2);
			$tabla .="<tr>\n
			<input type=\"hidden\" name=\"param_$id_tdg\" value=\"\" id=\"param_$id_tdg\">\n
			<td class=\"borde_delgado\" id=\"$id_tdg\"
			onClick=\"horario1.cambiaEstado('$id_tdg');\" bgcolor=\"$color_disp\" >".
			hora::verHora($hora2,'0seg')." - ".hora::verHora($hora_sig,'0seg')."</td>\n";
			foreach($dias as $dia){
				// ESTADO POR DEFECTO
				if ($idmed != NULL and $arr_estados) {
					$estado = $arr_estados[$hora2][$dia];
					$color = $estado?$color_disp:$color_nodisp;
					}
				else {
					if ($dia == 'sabado' or $dia == 'domingo'){
						$color=$color_nodisp;
						}
					else { 
						$color =$color_disp;
						}
					}
				$cad_color="bgcolor=\"$color\"";
				$id_td = $dia."_".$hora1->horAseg($hora2);
				$tabla .= "<td class=\"borde_delgado\" onClick=\"horario1.cambiaEstado('$id_td');\"
				 $cad_color id=\"$id_td\">&nbsp;</td>\n";
				}			
			$hora2 = $hora_sig;
			}
		return $tabla;
		}
	function obtenerEstado($idmed){
		$db = $this->conex;
		$consulta = "SELECT hora_in, dias_selec FROM horarios_medicos WHERE cod_med = '$idmed'";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) {
    		die($res->getMessage());
			}
		$resul = array();
		if ( !$res->numRows()){
			return false;
			}
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$arr_dias = $this->bitsAdias($row['dias_selec']);
			foreach ($arr_dias as $dia => $estado){		
				$resul[$row['hora_in']][$dia]=$estado;
				}
			}
		//print_r($resul);echo "<br>";
		return $resul;
		}
	/*
	funcion bitsAdias
	convierte los dias codificados en binario a dias como nombres
	 y retorna un array asociativo de la forma
	*/
	function bitsAdias($dias_bin)
		{
		for ($i=0,$mul=1 ; $i < count($this->dias_semana);$i++,$mul*=2){
			//echo "dias&mul='".($dias_bin & $mul)."' >> mul = '".(($dias_bin & $mul) >> $i)."'<br> ";
			$arr_resul[$this->dias_semana[$i]]= ($dias_bin & $mul) >> $i;
			}
		return $arr_resul;
		}
	/*
	funcion crearHorNoDisp
	Crea un horario de no disponibilidad para un medico determinado
	*/
	function crearHorNoDisp($idmed,$fecha_in,$fecha_fin,$sel_h_in,$sel_h_fin,$idhornodisp=NULL)
		{
		$db = $this->conex;
		
		if ($idhornodisp != '' ){
			$consulta ="UPDATE horario_nodisp SET fecha_in = '$fecha_in' ";
			if ($fecha_fin != NULL) 
				$consulta .= " ,fecha_fin = '$fecha_fin' ";
			else 
				$consulta .= " ,fecha_fin = NULL ";
			if ($sel_h_in  != NULL) 
				$consulta .= " ,hora_in = '$sel_h_in' ";
			else 
				$consulta .= " ,hora_in = NULL ";
			if ($sel_h_fin != NULL) 
				$consulta .= " ,hora_fin = '$sel_h_fin' ";			
			else
				$consulta .= " ,hora_fin = NULL ";			
			$consulta .= " WHERE cod_med=$idmed and codigo = $idhornodisp";
			}
		else {
		$consulta = "REPLACE horario_nodisp SET cod_med = $idmed, fecha_in = '$fecha_in'";
		if ($fecha_fin != NULL) $consulta .= " ,fecha_fin = '$fecha_fin' ";
		if ($sel_h_in != NULL) $consulta .= " ,hora_in = '$sel_h_in' ";
		if ($sel_h_fin != NULL) $consulta .= " ,hora_fin = '$sel_h_fin' ";
			}
		
		$res = $db->exec($consulta);
		if (PEAR::isError($res) and $res->getCode() == -5) {
    		
			$this->msg = "El horario ya existe, por favor escoja otro.";
			$this->error = true;
			return false;
			}
		//if ($db->affectedRows() == 2 or $idhornodisp != '') {
		if ($res == 2 or $idhornodisp != '') {	
			$this->msg = "El horario de no disponibilidad fue reemplazado.";
			}
		else {
			$this->msg = "El horario de no disponibilidad fue creado.";
			}
		}
	/*
	funcion borrarTodosPrin
	Borra todos los horarios del codigo de medico correspondiente
	*/
	function borrarTodosPrin($cod_med)
		{
		$consulta="DELETE FROM horarios_medicos WHERE cod_med='$cod_med'";
		$db = $this->conect();
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			die($res->getMessage());
			}
		//horarios borrados
		//echo "Numero de registros borrados: ".$db->affectedRows()."<br>";
		return $db->affectedRows();
		}
	function borrarTodosNoDisp($cod_med)
		{
		$consulta="DELETE FROM horario_nodisp WHERE cod_med='$cod_med'";
		$db = $this->conect();
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			die($res->getMessage());
			}
		//horarios borrados
		//echo "Numero de registros borrados: ".$db->affectedRows()."<br>";
		return $db->affectedRows();
		}	
	}
class Paciente extends CitasMedicas {
	function crearpac($arr_params){
		foreach ( $arr_params as $nombre_var => $valor) {	
			$$nombre_var = $valor;
 			}
		$consulta = "INSERT INTO pacientes (nombres, apellidos, doc_ident, tipo_doc,
		cod_seguro,entidad_med ) VALUES ('$nombre','$apellidos','$doc_ident','$tipo_doc',
		'$cod_seguro','$entidad_med')";
		$db = $this->conex;
		$res = $db->query($consulta);
		//echo "codigo=".$res->getCode()." , consulta=$consulta<br>";
		if (PEAR::isError($res) ){
			if (  $res->getCode() == -5) {
				$this->msg="El paciente '$nombre $apellidos' ya existe.";
				$this->error=1;
				return false;
				}
			die($res->getMessage());
			}
		$this->msg = "El paciente '$nombre $apellidos' fue creado.";
		return true;
		}
	function listarpac()
		{
		$db = citasMedicas::conect();
		$consulta="SELECT p.*,td.nombre as nombre_doc FROM pacientes p LEFT JOIN tipo_doc td ON p.tipo_doc = td.codigo ";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) die ($res->getMessage());
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
    		//echo $row['name'] . ', ' . $row['address'] . "\n";
			$resul[]=$row;
			}
		return $resul;		
		}
	function borrarpac($codpac)
		{
		$db = $this->conex;
		$consulta="DELETE FROM pacientes WHERE codigo=$codpac";
		$res = $db->query($consulta);
		if (PEAR::isError($res)) die ("consulta=$consulta<br>".$res->getMessage());
		$this->msg="El paciente fue borrado.";
		}
	function modpac($arr_params){
		foreach ( $arr_params as $nombre_var => $valor) {	
			$$nombre_var = $valor;
 			}
		$consulta = "UPDATE pacientes SET nombres='$nombres', apellidos='$apellidos',
		 doc_ident = '$doc_ident', tipo_doc = '$tipo_doc',
		 cod_seguro = '$cod_seguro', entidad_med = '$entidad_med'
		 WHERE codigo = $codigo";
		$db = $this->conex;
		$res = $db->query($consulta);
		//echo "codigo=".$res->getCode()." , consulta=$consulta<br>";
		if (PEAR::isError($res) ){
			die("consulta=$consulta<br>".$res->getMessage());
			}
		$this->msg = "El paciente '$nombres $apellidos' fue modificado.";
		return true;
		}
	static function nombre($codigo)
		{
		$db=CitasMedicas::conect();
		$consulta = "SELECT concat(nombres,' ',apellidos) as nombre FROM pacientes WHERE codigo = '$codigo'";
		$nombre = $db->getOne($consulta);
		if (PEAR::isError($nombre)){
			die($nombre->getmessage());
			}
		return $nombre;
		}
	}
class Cita extends CitasMedicas {
	function registrar($codmed,$codpac,$fecha,$hora)
		{
		$db = CitasMedicas::conect();
		$consulta = "INSERT citas (cod_med,cod_pac,fecha,hora_in) 
		VALUES ('$codmed','$codpac','$fecha','$hora')";
		$res = $db->query($consulta);
		if (PEAR::isError($res) and $res->getCode() == -5){
			$this->msg = "La cita ya existe.";
			$this->error = 1;
			return false;
			//die("consulta=$consulta<br>".$res->getMessage());
			}
		$this->msg = "La cita fue creada.";
		}
		
	static function Buscar($cod_med,$fecha_cita)
		{
		$db = CitasMedicas::conect();
		$consulta = "SELECT cod_pac,hora_in,hora_fin,estado FROM citas 
		WHERE cod_med = $cod_med and fecha = '$fecha_cita'"; //,cod_paciente, hora_in, hora_fin,estado 
		$res =  $db->query($consulta);
		if (PEAR::isError($res)){
			die("consulta='$consulta'".$res->getmessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			$resul[]=$row;
			}		
		return $resul;
		}
	/*
	funcion listar
	lista todas las citas existentes en la bd
	*/
	function listar()
		{
		$db = CitasMedicas::conect();
		$consulta = "SELECT c.codigo as cod_cita,c.fecha as fecha_cita,
		c.hora_in as hora_cita, c.cod_med as cod_med, c.cod_pac as cod_pac,
		c.estado as estado, m.nombre as nombre_med, 
		concat(p.nombres,' ',p.apellidos) as nombre_pac
		FROM citas c, medicos m, pacientes p WHERE c.cod_med = m.codigo
		and c.cod_pac = p.codigo"; //,cod_paciente, hora_in, hora_fin,estado 
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			die("consulta='$consulta'".$res->getmessage());
			}
		$resul = array();
		while ($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC)) {
			$resul[]=$row;
			}		
		return $resul;
		}
	/*
	funcion datos
	obtiene los datos de la cita medica:
	medico, paciente, fecha y hora
	*/
	static function datos($cod_cita)
		{
		$db = CitasMedicas::conect();
		$consulta = "SELECT fecha, hora_in ,cod_med, cod_pac, estado
		 FROM citas  WHERE codigo = $cod_cita"; //,cod_paciente, hora_in, hora_fin,estado 
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			die("consulta='$consulta'".$res->getmessage());
			}
		//$resul = array();
		$fila = $res->fetchRow(MDB2_FETCHMODE_ASSOC);
		return $fila;
		}
	function actualizar($cod_cita,$codmed,$codpac,$fecha,$hora)
		{
		$db = CitasMedicas::conect();
		$consulta = "UPDATE citas SET cod_med=$codmed,cod_pac=$codpac,fecha='$fecha',
		hora_in='$hora' WHERE codigo=$cod_cita";
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			//$this->msg = "La cita ya existe.";
			//$this->error = 1;
			//return false;
			die("consulta=$consulta<br>".$res->getMessage());
			}
		$this->msg = "La cita fue actualizada.";
		}
	function borrar($cod_cita)
		{
		$db = CitasMedicas::conect();
		$consulta = "DELETE FROM citas WHERE codigo=$cod_cita";
		$res = $db->query($consulta);
		if (PEAR::isError($res)){
			die("consulta=$consulta<br>".$res->getMessage());
			}	
		$this->msg="La cita fue borrada.";
		}
	/*
	funcion solicitar
	envia un correo al asistente para solicitar la asignacion
	de la cita
	*/
	function solicitar($doc,$tipo_doc,$fecha,$hora)
		{
		$tipo_doc = CitasMedicas::nombreTipoDoc($tipo_doc);
		
		$para = $GLOBALS['CITAS_MEDICAS']['email_asist'] ;
		$asunto = "[Citas Medicas] Solicitar Cita";
		$msg = "Documento: $doc\nTipo Doc:$tipo_doc\nfecha: $fecha\nHora: $hora";
		$cabecera = "From: drake@localhost";
		//try {
		if (!@mail($para,$asunto,$msg,$cabecera)) {
    		$errorMessage = error_get_last()['message'];
			return $this->lanzarErr("Hubo un error al enviar el mensaje: " .
				"'$errorMessage'. Por favor informe al administrador del Sitio.");
			}
		return $this->msgOK("Mensaje enviado con éxito.");
			/*}
		catch(Exception $e){
			echo "Error enviando correo: " . $e->getMessage() ."<br/>";
			} */
		} 
	/*
	Enviar la solicitud a los asistentes
	la solicitud se guarda en la bd
	*/
	/* function solicitar()
		{
		
		} */
	}
?>
