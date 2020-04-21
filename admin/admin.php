<?php 
//require_once "PEAR.php";
//echo "docroot:${_SERVER['DOCUMENT_ROOT']}<BR>";
//phpinfo();
require_once "../config.php";
require_once "../lib/citasmedicaslib.php";


$obj_aut = new Auth("DB", $CITAS_MEDICAS['params_auth'], "mostrarlogin",false);
if ($_GET['_accion'] == "salir" && $obj_aut->checkAuth()) {
	$obj_aut->logout();
	}

$obj_aut->start();
$login = $obj_aut->getUsername();
$pagina=$_GET['pag'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Control de citas médicas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../citasmedicas.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../citasmedicas.js" type="text/javascript"></script>
<!-- <link href="test_auth.php" rev="act"> -->

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>
<?php if ($archivo == "seleccfecha"){ ?>
<style type="text/css">@import url(../jscalendar/calendar-system.css);</style>
<script type="text/javascript" src="../jscalendar/calendar.js"></script>
<script type="text/javascript" src="../jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="../jscalendar/calendar-setup.js"></script>
<?php } ?>
</head>

<body leftmargin="0" topmargin="0" class="cuerpo1">
<div id="header">
  <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td width="520" valign="top"><img src="../imagenes/control%20de%20citas2_heading.jpg" width="409" height="72"  border="0" /></td>
      <td width="100%" align="center" background="../imagenes/control%20de%20citas_topstrip1.png">
        <table cellspacing="3" cellpadding="0">
          <tr>
            <td  valign="top"><img src="../imagenes/control%20de%20citas2_image1.jpg" border="0" /></td>
            <td  valign="top"><img src="../imagenes/control%20de%20citas2_image2.jpg" border="0" /></td>
            <td  valign="top"><img src="../imagenes/control%20de%20citas2_image3.jpg" border="0" /></td>
            <td  valign="top"><img src="../imagenes/control%20de%20citas2_image4.jpg" border="0" 
			  onMouseOver="MM_showHideLayers('capa1','','show')"
			  onMouseOut="MM_showHideLayers('capa1','','hide')" /></td>
          </tr>
      </table> </td>
    </tr>
  </table>
</div>
<div id="hnavigation"> 
 <script> menuhoriz('admin'); </script>
  <!-- aqui va el contenido dinamico, es decir, el menu que muestra las opciones, dependiendo del usuario y de la página.. -->
</div>

<div id="content"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>

      <td width="165" valign="top">
<?php if ($obj_aut->checkAuth()){ 
  	echo '<div align="center">'.$obj_aut->getUsername()."</div>";
 	echo "<br>";
 	}
?>	  
	   <p><img src="../imagenes/control%20de%20citas2_logo.gif" width="165" height="144" border="0" /></p>
        <p align="center"> 
        <!-- aqui va el contenido dinamico, es decir, el menu que muestra las opciones, dependiendo del usuario y de la página. -->
		<script> menuvert('admin'); </script>
      </p></td>
      <td valign="top" class="content"> 
	  <!-- inicio del contenido -->
	 <?php 
	 //$obj_aut->start(); // aqui apareceria el cuadro de login, si no está autenticado!
if ($obj_aut->checkAuth() ) {
	//echo "usuario autenticado";
	$user1=new Usuario;
	if (!$user1->revAutoriz($login,$pagina)){ ?>
El usuario <?php echo  $login ?> no esta autorizado a ver la pagina <?php echo  $pagina ?>.<br>
<a href='javascript:salir("admin");'>Regresar.</a>
<?php 
		}
	else {
		incluirArchivo($pagina,"admin");  
		echo "<br>";
		echo '<a href="'.$PHP_SELF.'?pag=">Regresar</a><br>';
		}
	}
else {
	echo "Usuario no autenticado";
	incluirArchivo("seclogin","admin");
	//echo "redirigir: <a href=""> login</a>";
	}	
	
	?>
    <img src="../imagenes/creditos.png" align="middle">      	
       <!-- fin del contenido -->  
       
    </tr>
  </table>
</div>
</body>
</html>
