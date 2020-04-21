<?php 

require_once "config.php";
require_once "./lib/citasmedicaslib.php";
require_once 'Log.php';
require_once 'Log/observer.php';

class Auth_Log_Observer extends Log_observer {

    var $messages = array();

    function notify($event) {

        $this->messages[] = $event;

    }

}

//error_log('citas:'. print_r($CITAS_MEDICAS,1)) ;
$obj_aut = new Auth("MDB2", $CITAS_MEDICAS['params_auth'], "mostrarlogin",false);
if ( isset($_GET['_accion']) and $_GET['_accion'] == "salir" && $obj_aut->checkAuth()) {
	$obj_aut->logout();
	}

$infoObserver = new Auth_Log_Observer(PEAR_LOG_INFO);

$obj_aut->attachLogObserver($infoObserver);

$debugObserver = new Auth_Log_Observer(PEAR_LOG_DEBUG);

$obj_aut->attachLogObserver($debugObserver);


$obj_aut->start();
$login = $obj_aut->getUsername();
$pagina= isset($_GET['pag']) ? $_GET['pag'] : '';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Control de citas médicas</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="citasmedicas.css" rel="stylesheet" type="text/css">

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
<?php //if ($pagina == "nuevohormed"){ ?>
<style type="text/css">@import url(jscalendar/calendar-system.css);</style>
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-es.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<?php // } ?>
<script language="JavaScript" src="citasmedicas.js" type="text/javascript"></script>
<script language="JavaScript" src="admhormed.js" type="text/javascript"></script>
</head>

<body leftmargin="0" topmargin="0" class="cuerpo1">
<div id="header">
  <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td width="520" valign="top"><img src="imagenes/control%20de%20citas2_heading.jpg" width="409" height="72"  border="0" /></td>
      <td width="100%" align="center" background="imagenes/control%20de%20citas_topstrip1.png">
        <table cellspacing="3" cellpadding="0">
          <tr>
            <td  valign="top"><img src="imagenes/control%20de%20citas2_image1.jpg" border="0" /></td>
            <td  valign="top"><img src="imagenes/control%20de%20citas2_image2.jpg" border="0" /></td>
            <td  valign="top"><img src="imagenes/control%20de%20citas2_image3.jpg" border="0" /></td>
            <td  valign="top"><img src="imagenes/control%20de%20citas2_image4.jpg" border="0" 
			  onMouseOver="MM_showHideLayers('capa1','','show')"
			  onMouseOut="MM_showHideLayers('capa1','','hide')" /></td>
          </tr>
      </table> </td>
    </tr>
  </table>
</div>
<div id="hnavigation">
<?php include 'menuhoriz.php';  ?>
<!-- <script> menuhoriz('normal'); </script>-->
  <!-- aqui va el contenido dinamico, es decir, el menu que muestra las opciones, dependiendo del usuario y de la página.. -->
</div>

<div id="content"> 
  <table width=100% border="0" cellspacing="0" cellpadding="0">
	<tr>

      <td width="165" rowspan="2" valign="top">
<?php if ($obj_aut->checkAuth()){ 
  	echo '<div align="center">'.$obj_aut->getUsername()."</div>";
 	echo "<br>";
 	}
?>	  
	   <p><img src="imagenes/control%20de%20citas2_logo.gif" width="165" height="144" border="0" /></p>
        <p align="center"> <?php include 'menuvert.php';  ?></p>
        <!-- aqui va el contenido dinamico, es decir, el menu que muestra las opciones, dependiendo del usuario y de la página. -->
<!--		<script> menuvert('normal'); </script>-->
      </td>
      <td valign="top" class="content"><!-- inicio del contenido -->

          <?php 
	if ($obj_aut->checkAuth() ) {
	//echo "pagina=$pagina<BR>";
	//echo "usuario autenticado";
		$user1=new Usuario;
		if (!$user1->revAutoriz($login,$pagina)){ ?>
        El usuario
        <?php echo  $login ?> 
        no esta autorizado a ver la pagina 
        <?php echo  $pagina ?>
        .<br>
        <a href='javascript:salir("normal");'>Salir.</a><br>
        <a href='<?php echo  $PHP_SELF."?pag="?>'>Regresar.</a><br>        
        <?php 
			}
		else {
			incluirArchivo($pagina,"normal");  
			echo "<br>";
			echo '<a href="'.$PHP_SELF.'?pag='.$INDEX_RAIZ.'">Regresar</a><br>';
			}
		}
	else {
		echo "Usuario no autenticado";
		incluirArchivo("seclogin","normal");
		//echo "redirigir: <a href=""> login</a>";
	}	
	?>        
<!-- fin del contenido -->   </tr>
	<tr>
	  <td valign="top" class="content" align="center">
		  Percasoft.com - info@percasoft.com - 2012

      <?php 
/*
print '<h3>Logging Output:</h3>'
    .'<b>PEAR_LOG_INFO level messages:</b><br/>';
foreach ($infoObserver->messages as $event) {
    print $event['priority'].': '.$event['message'].'<br/>';
}

print '<br/>'
    .'<b>PEAR_LOG_DEBUG level messages:</b><br/>';

foreach ($debugObserver->messages as $event) {
    print $event['priority'].': '.$event['message'].'<br/>';
} */?>
	  </td>        
	</tr>
  </table>
</div>




</body>
</html>