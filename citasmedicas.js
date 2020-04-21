// JavaScript Document
//var dir_base_sitio="/desarrollo/citas%20medicas";
var dir_base_sitio=".";
var link_inicio = dir_base_sitio+"/index.php";
var link_nuevacita= dir_base_sitio+"/index.php?pag=nuevacita";
var link_seg= dir_base_sitio + "/admin/index.php";
	

// muestra el menu horizontal
function activar(nombre)
  {
	var nombre_img=new Image();
	nombre_img.src= "imagenes/"+nombre+"_m.gif";
  	document.images[nombre].src=nombre_img.src; 
  }
function desactivar(nombre)
  {
 	var nombre_img=new Image();
  	nombre_img.src= "imagenes/"+nombre+".gif"; 
  	document.images[nombre].src=nombre_img.src; 
  }


	
function salir(tipo){
	if (tipo == 'admin') {
		dir="/admin/admin.php?_accion=salir";
		}
	else {
		dir = "/citasmedicas.php?_accion=salir";
		}
	window.location.href=dir_base_sitio+dir;
	}

function menuhoriz(tipo){
	var ruta = '';
	if (tipo =='') tipo = 'normal';
	if (tipo == 'admin' ){
		ruta = '../';
		}
	var link_salir = "javascript:salir('" + tipo +"');";
	document.write('<table border="0" cellpadding="0" cellspacing="0" ><tr>');
	document.write('<td><a href="'+link_inicio+'"><img src="'+ruta+'imagenes/inicio_h.gif" border="" name="inicio_h"  onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td>');
	document.write('<td><a href="'+link_nuevacita+'"><img src="'+ruta+'imagenes/citas_h.gif"  border="" name="citas_h" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td>');
	document.write('<td><a href="'+link_seg+'"><img src="'+ruta+'imagenes/seguridad_h.gif" border="" name="seguridad_h" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td>');
	document.write('<td><a href="'+link_salir+'"><img src="'+ruta+'imagenes/salir_h.gif" border="" name="salir_h" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td>');
	document.write('</tr></table>');
	}
function menuvert(tipo){
	var ruta = '';
	if (tipo =='') tipo = 'normal';
	if (tipo == 'admin' ){
		ruta = '../';
		}
	var link_salir = "javascript:salir('" + tipo +"');";
	document.write('<table border="0" cellpadding="0" cellspacing="0">');
	document.write('<tr><td><a href="'+link_inicio+'"><img src="'+ruta+'imagenes/inicio_v.gif" border="" name="inicio_v" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td></tr>');
	document.write('<tr><td><a href="'+link_nuevacita+'"><img src="'+ruta+'imagenes/nuevacita_v.gif"  border="" name="nuevacita_v" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td></tr>');
	document.write('<tr><td><a href="'+link_seg+'"><img src="'+ruta+'imagenes/seguridad_v.gif" border="" name="seguridad_v" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td></tr>');
	document.write('<tr><td><a href="'+link_salir+'"><img src="'+ruta+'imagenes/salir_v.gif" border="" name="salir_v" onMouseOver="activar(this.name,\''+tipo+'\')" onMouseOut="desactivar(this.name,\''+tipo+'\')"></a></td></tr>');
	document.write('</table>');
	
	return;
	}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
  } if (errors) alert('Existe el siguiente error:\n'+errors);
  document.MM_returnValue = (errors == '');
}

  var SPECIAL_DAYS = {
    0 : [ 1, 8 ],		// dias festivos en enero
	2 : [20],				// marzo
    3 : [ 13,14 ],	
    4 : [ 1, 29 ],
	5 : [19, 26],
	6 : [ 3,20 ],
	7 : [7,21],
	9 : [16],
	10: [6,13],
	11: [8,25]
  };

  function dateIsSpecial(year, month, day) {
    var m = SPECIAL_DAYS[month];
    if (!m) return false;
    for (var i in m) if (m[i] == day) return true;
    return false;
  };

  function dateChanged(calendar) {
    // Beware that this function is called even if the end-user only
    // changed the month/year.  In order to determine if a date was
    // clicked you can use the dateClicked property of the calendar:
    if (calendar.dateClicked) {
      // OK, a date was clicked, redirect to /yyyy/mm/dd/index.php
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth();     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31
      // redirect...
      //window.location = "/" + y + "/" + m + "/" + d + "/index.php";
    }
  };

  function ourDateStatusFunc(date, y, m, d) {
    if (dateIsSpecial(y, m, d))
      return "special";
    else
      return false; // other dates are enabled
      // return true if you want to disable other dates
  };
function mostrar_bloque(id_obj,estado)
	{
	obj = document.getElementById(id_obj);
	if (estado != undefined) {
		//alert('estado = "'+estado+'"');return;
		obj.style.display = estado;
		return true;
		}
	if (obj.style.display == 'none'){
		obj.style.display = 'block';
		location.hash = '#' + id_obj;
		}
	else {
		obj.style.display = 'none';
		location.hash ='#';
		}
	
	}
function ir_a(lugar)
	{
	location.href = lugar;
	}

