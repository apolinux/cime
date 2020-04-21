
<h1>Seleccionar fecha de la cita</h1>
<p>Seleccione la fecha</p>
<form name="forma" action="<?php echo  $PHP_SELF ?>?pag=selecchora" method="post">
  <input type="text" name="fecha">  
  <input type="submit" name="Submit" value="siguiente">
</form>

<div style="float: left; margin-left: 0em; margin-bottom: 1em;"
id="calendar-container"></div>
<P>
<script type="text/javascript">
  function dateChanged(calendar) {
    // Beware that this function is called even if the end-user only
    // changed the month/year.  In order to determine if a date was
    // clicked you can use the dateClicked property of the calendar:
    if (calendar.dateClicked) {
      // OK, a date was clicked, redirect to /yyyy/mm/dd/index.php
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth();     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31
	  document.forma.fecha.value=y + "/" + (m+1) + "/" + d ;
      // redirect...
      //window.location = "/" + y + "/" + m + "/" + d + "/index.php";
    }
  };

  Calendar.setup(
    {
      flat         : "calendar-container", // ID of the parent element
      flatCallback : dateChanged ,        // our callback function
	  showsTime	   : false
    }
  );
</script>

