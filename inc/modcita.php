<h1>Modificar Cita</h1>
<p>Cita no 12345<br>
Fecha: 2006/07/08<br>
hora: 10:30 am<br>
no. de citas mensual: 5</p>
<p><a href="<?php echo  $PHP_SELF ?>?pag=seleccfecha&cita=12345">Modificar fecha_hora</a></p>
<p><a href="<?php echo  $PHP_SELF ?>?pag=escojemedico&cita=12345">Modificar medico</a></p>
<p>Modificar estado: 
  <select name="select">
    <option>cumplida</option>
    <option>incumplida</option>
    <option>debe</option>
    <option>cancelada</option>
  </select>
  <input type="submit" name="Submit" value="modificar">
</p>
