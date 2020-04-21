<?php 
require_once "config.php";

require_once "./lib/citasmedicaslib.php";

foreach ($_GET as $nombre => $valor ){
		$$nombre=$valor;
		}
foreach ($_POST as $nombre => $valor ){
		//echo "$nombre => $valor   ";
		$$nombre=$valor;
		}
?>
<html>
<head>
<title>imprimir_pagina</title>
<link href="citasmedicas.css" rel="stylesheet" type="text/css">
</head>
<body>

<div align="center">
<h1>Cita M&eacute;dica</h1>

  <table width="300" border="0" cellspacing="5">
    <tr>
      <td>medico</td>
      <td><?php echo  Medico::nombre($cod_med) ?></td>
    </tr>
    <tr>
      <td>paciente</td>
      <td><?php echo  Paciente::nombre($cod_pac) ?> </td>
    </tr>
    <tr>
      <td>fecha</td>
      <td><?php echo  $fecha_cita ?></td>
    </tr>
    <tr>
      <td>hora</td>
      <td><?php echo  Hora::verHora($hora_cita,'0seg') ?></td>
    </tr>
<!--     <tr>
      <td>Entidad</td>
      <td>Comeba</td>
    </tr> -->
  </table>

<a href="javascript:print();">Imprimir</a> el comprobante de cita<br/>
<a href="javascript:window.close();">Cerrar</a></div>
</body>
</html>
