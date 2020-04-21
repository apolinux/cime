<?php 
/*
ARCHIVO DE CONFIGURACION
*/

error_reporting(E_ALL & ~E_STRICT);
ini_set('display_errors',1) ;

$INDEX_RAIZ="citasmedindex";
$INDEX_ADMIN="admindex";
$ruta_paginas = dirname($_SERVER["SCRIPT_FILENAME"]);
$ruta_paginas_admin="$ruta_paginas/admin";

define('INDEX_ADMIN','admindex');
define('INDEX_RAIZ','citasmedindex');
define('RUTA_PAGINAS',dirname($_SERVER["SCRIPT_FILENAME"]));
define('RUTA_PAGINAS_ADMIN','RUTA_PAGINAS' . '/admin' );

$CITAS_MEDICAS['ruta_paginas'] = $ruta_paginas;
$CITAS_MEDICAS['URL_BASE']="";
$CITAS_MEDICAS['dsn_mysql'] = "mysqli://cime_user:12345@localhost/cime"; 

$archivo= isset($_GET['pag']) ? $_GET['pag'] : '';

$_HORA_IN="07:00:00"; // hora inicial y final de programacion de las citas medicas
						// ojo con el cero no significativo de la izquierdad en la hora
$_HORA_FIN="21:00:00";
$CITAS_MEDICAS['_HORA_IN'] = "07:00:00";
$CITAS_MEDICAS['_HORA_FIN'] = "21:00:00";
$CITAS_MEDICAS['INT_TIEMPO'] = '01:00:00';
$CITAS_MEDICAS['DIA_INICIO_SEMANA'] = 'lunes'; // dia de inicio seleccionar el arreglo de dias
										// en la tabla horarios_medicos
										// el campo dias_selec es un numero hexadecimal de 7 bits
										// donde cada bit representa un dia y el estado del bit indica
										// la actividad
										// LSB es el bit menos significativo

$CITAS_MEDICAS['COLOR_HOR_DISP'] = "#66FF99";
$CITAS_MEDICAS['COLOR_HOR_NODISP'] = "#FFFF31";
$CITAS_MEDICAS['DIAS_SEMANA'] = array('lunes','martes','miercoles','jueves','viernes','sabado','domingo');

$CITAS_MEDICAS['params_pager']= array(
    'mode'       => 'Jumping',
    'perPage'    => 10,
    'delta'      => 10,
/*     'itemData'   => array_keys($arr_lista), */
	'prevImg' => '< Anterior',
	'nextImg' => 'Siguiente >'
);

$CITAS_MEDICAS['params_auth'] = array(
	"dsn" => $CITAS_MEDICAS['dsn_mysql'],
	"table" => "usuarios",
	"usernamecol" => "login",
	"passwordcol" => "password" ,
	"db_options" => [
		'debug_level' => 5 ,
	],
	'enableLogging' => true,
	);
$CITAS_MEDICAS['email_asist'] = 'user@localhost';

$PHP_SELF = $_SERVER['PHP_SELF'];

$_accion='';
?>
