
<!-- <h1>Administraci&oacute;n de cuentas </h1> -->
<p>&nbsp;</p>
<form name="form1" method="post" action="<?php echo  $_SERVER['PHP_SELF'].'?pag='. INDEX_RAIZ ?>">
  <table width="200" border="0">
	<tr>
	  <td align="right">login</td>
	  <td><input name="username" type="text" id="login"></td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td align="right">password</td>
	  <td><input name="password" type="password" id="password" ></td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input name="Submit" type="button" onClick="MM_validateForm('login','','R','password','','R');this.form.submit();return document.MM_returnValue;" value="Entrar"></td>
	  <td>&nbsp;</td>
	</tr>
  </table>
</form> 