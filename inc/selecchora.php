<h1>Escoger hora</h1>
<?php 
$fecha = $_POST['fecha'];
list($agno,$mes, $dia) = split('/',$fecha);
?>
Seleccione la hora de la cita para la fecha: <?php echo  $agno.'/'.$mes.'/'.$dia ?><br>

<?php 
//$hin = new hora(6,0,0);
//$hfin = new hora(20,0,0);

//echo "horain: $hora_in, horafin:$hora_fin<br>";
$hin = new hora($hora_in);
$hfin = new hora($hora_fin);

$interv_t=15*60; // en segundos, 15 minutos
/* echo "tin= ".$hin->segt."<br>";
echo "tfin= ".$hfin->segt."<br>"; */
?>
<form name="form1" method="post" action="">
  <table width="300" border="0" cellspacing="2" >
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">horario</th>
      <th scope="col">Medico</th>
    </tr>

<?php 
$color1="#66ccFF";
$color2="#00ccFF";
$selcolor=0;
for ($t = $hin->segt ; $t <= $hfin->segt ; $t += $interv_t){
	$selcolor=1-$selcolor;
	if ($selcolor==0) $colorsel=$color1 ; else $colorsel=$color2;
	$h=hora::h($t);
	$m=hora::m($t);
	$s=hora::s($t);
	//printf ("%s%02d:%02d:%02d %s","hora actual: ",$h,$m,$s,"<br>");
	$hora_act = sprintf ("%02d:%02d:%02d",$h,$m,$s);
	echo '
	<tr>
      <td bgcolor="'.$colorsel.'"><input name="radiobutton" type="radio" value="radiobutton"></td>
      <td bgcolor="'.$colorsel.'">'.$hora_act.' </td>
      <td bgcolor="'.$colorsel.'">Dr Tazo </td>
    </tr>
	';

	}
?>
 </table>
  <a href="<?php echo $PHP_SELF?>?pag=mostrarcita">Continuar</a>
</form>
