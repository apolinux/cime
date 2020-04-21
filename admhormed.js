//var dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];

/* function verCheckbox(checkbox)
	{
	var valor="";
	for (var i in checkbox) {
		if (checkbox[i].checked)
		  valor = checkbox[i].value;
		}
	if (valor == "")
		return false;
	else 
		return valor;
	} */
/* function inArray(arreglo,cadena)
	{
	for(var i= 0 ; i < arreglo.length; i++){
		if (arreglo[i] == cadena) 
			return true;
		}
	return false;
	} */


/* version 3.0 disegno: generar tabla dinamicamente
y usar funciones para cambiar el estado y el color 
*/
function horario (){
	this.cambiaEstado = cambiaEstado;
	}
/* const COLOR_HOR_DISP = "<?= $CITAS_MEDICAS['COLOR_HOR_DISP'] ?>";
const COLOR_HOR_NODISP = "<?= $CITAS_MEDICAS['COLOR_HOR_NODISP'] ?>"; */

horario1 = new horario();

function cambColorTd(id_td,color_selec)
	{
	var td1=document.getElementById(id_td);
	var color = td1.bgColor.toLowerCase();
	var color_disp = COLOR_HOR_DISP.toLowerCase();
	var color_nodisp = COLOR_HOR_NODISP.toLowerCase();
	if (color_selec != undefined ){
		color = color_selec;
		}
	switch (color){
		case color_nodisp: td1.bgColor = color_disp; break;
		case color_disp: 
		default: td1.bgColor = color_nodisp; break;	
		}
	}

function cambiaEstado(id_td)
	{
	var dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];	
	var td1=document.getElementById(id_td);
	var color = td1.bgColor.toLowerCase();
	var color_disp = COLOR_HOR_DISP.toLowerCase();
	var color_nodisp = COLOR_HOR_NODISP.toLowerCase();
	var re = /^hora_(.*)/
	var re2 = /^dia_(.*)/
	var arr_re = re.exec(id_td);
	var arr_re2 = re2.exec(id_td);
	if ( re.test(id_td)){
		for (var i = 0 ; i < dias.length ; i++){ 
			if (dias[i] != 'sabado' && dias[i] != 'domingo'){
				cad_eval = 'var id_td1 = "'+dias[i] + '_' + arr_re[1]+'"';
				//alert(cad_eval);// return false;
				eval(cad_eval);
				cambColorTd(id_td1,color);
				cambColorTd(id_td);
				}
			}
		}
	else 
	if (re2.test(id_td)) {
		var tabla_hor = document.getElementById('tabla_hor');
		var tdes = tabla_hor.getElementsByTagName("td");
		for (var i = 0; i < tdes.length; i++) {
			if (tdes[i].id.lastIndexOf(arr_re2[1]) != -1 ){
				cambColorTd(tdes[i].id,color);
				cambColorTd(id_td);
				}
			}
		} 
	else {
		cambColorTd(id_td);
		}
	}
/*
funcion reestablecer
deja los colores o estados por defecto en cada una de las celdas
*/
function reestablecer()
	{
	var tabla_hor = document.getElementById('tabla_hor');
	var tdes = tabla_hor.getElementsByTagName("td");
	var color_disp = COLOR_HOR_DISP.toLowerCase();
	var color_nodisp = COLOR_HOR_NODISP.toLowerCase();
	for (var i = 1; i < tdes.length; i++) {
		if ( tdes[i].id.lastIndexOf('sabado') != -1
		   || tdes[i].id.lastIndexOf('domingo') != -1  ){
			tdes[i].bgColor=color_nodisp;
			}
		else {
			tdes[i].bgColor=color_disp;
			}
		}
	}

/*
funcion ingresar
lee los horarios y los envia para ingresarlos en la bd
*/

function ingresar(accion)
	{
	var dias = ['lunes','martes','miercoles','jueves','viernes','sabado','domingo'];	
	var tabla_hor = document.getElementById('tabla_hor');
	var tdes = tabla_hor.getElementsByTagName("td");
	var color_disp = COLOR_HOR_DISP.toLowerCase();
	var color_nodisp = COLOR_HOR_NODISP.toLowerCase();
	var valor ;
	var forma_hor = document.getElementById('forma_hor');
	var inputs_hora = document.getElementsByTagName('input');
	var param_hora = new Object;
	// inicializar el objeto param_hora
	for (var i = 0; i < inputs_hora.length; i++){
		if (inputs_hora[i].name.lastIndexOf('param_hora') != -1){
			var nombre_param = inputs_hora[i].name.substr(11);
			param_hora[nombre_param] = 0;
			}
		}

	for (var hora in param_hora){
		param_hora[hora] = 0;
		for (var j = 0 ; j < dias.length; j++){
			eval('var nombre_campo1 = "' + dias[j] + '_' + hora + '"');
			var campo = document.getElementById(nombre_campo1);
			if (campo.bgColor == color_disp){
				param_hora[hora] += 1 << j; 
				}
			}
		eval('var id_param = "param_hora_' + hora + '"');
		document.getElementById(id_param).value = param_hora[hora];
		
		}
	// se envian los datos
	if (accion == 'Modificar'){
		forma_hor.action += '&_accion=modhormed';
		}
	else {
		forma_hor.action += '&_accion=crearhormed';
		}
	forma_hor.submit();
	}
	
function ingresarHorNodisp(cad_forma)
	{
	var forma = document.getElementById(cad_forma);
	var fecha_in = forma.fecha_in;
	var fecha_fin = forma.fecha_fin;
	var chkbx_f_fin = forma.chkbx_f_fin;
	var chkbx_h = forma.chkbx_hor_f_in;
	var hora_in = forma.sel_h_in;
	var hora_fin = forma.sel_h_fin;	

	if (fecha_in.value == '' ){
	 	alert('El campo fecha inicial se encuentra vacio.');
		return false;
		}
	if (chkbx_f_fin.checked && fecha_fin.value == ''){
		alert('El campo fecha final se encuentra vacio.');
		return false;
		}
	if (fechaAseg(fecha_in.value) >= fechaAseg(fecha_fin.value) && chkbx_f_fin.checked){
		alert('La fecha inicial es posterior a la fecha inicial.');
		return false;
		}
	if (horaAseg(hora_in.value) > horaAseg(hora_fin.value) && chkbx_h.checked ){
		alert('La hora inicial es posterior a la hora inicial.');
		return false;
		}
	forma.submit();
	}
function cambEstadoCampos()
	{
	var obj_rev = arguments[0];
	for (var i=1; i<arguments.length; i++) {
    	var elem = document.getElementById(arguments[i]);
		if (!obj_rev.checked){
		 	elem.disabled='disabled';
		 	}
		else {
			elem.disabled='';
			}
   		}
	}

/*
Convierte la fecha en segundos absolutos desde EPOCH
*/
function fechaAseg(fecha)
	{
	var arr_fecha = fecha.split('-');
	var fecha1 = new Date(arr_fecha[0],arr_fecha[1]-1,arr_fecha[2]);
	fecha1.setHours(0,0,0);
	return Date.parse(fecha1);
	}
function horaAseg(hora)
	{
	var arr_hora = hora.split(':');
	var hora1 = new Date();
	hora1.setHours(arr_hora[0],arr_hora[1],arr_hora[2]);
	return Date.parse(hora1);
	}
function VisualizaTabla(tabla)
	{
	id_tabla = document.getElementById(tabla);
	id_sp_camb = document.getElementById('sp_cambia_tabla');
	if (id_tabla.style.display == 'block'){
		id_tabla.style.display = 'none';
		id_sp_camb.innerHTML = 'Expande tabla';
		}
	else {
		id_tabla.style.display = 'block';
		id_sp_camb.innerHTML = 'Recoge tabla';
		}
	}
	
function borrarNoDisp(cad_forma,cod_hor_med)
	{
	forma = document.getElementById(cad_forma);
	if (confirm('¿Está seguro que desea borrar este horario?')){
		forma.action += '&_accion=borrarhornodisp&id_hor_nodisp='+cod_hor_med;
		forma.submit();
		}
	else return false;
	}
/*
funcion cambiarHorMed
asigna los valores del horario de medico seleccionado
a la forma creada en la parte inferior de la lista de horarios,
que corresponde a la forma de modificar horarios
*/
function cambiarHorMed(obj_orig,id_forma_dest)
	{
	var modif_horario = document.getElementById('modif_horario');
	var forma_dest = document.getElementById(id_forma_dest);
	modif_horario.style.display = 'block';
	forma_dest.fecha_in.value = obj_orig.fecha_in;
	forma_dest.fecha_fin.value = obj_orig.fecha_fin;
 	for (var i = 0 ; i < forma_dest.sel_h_in.length ; i++)
		if(forma_dest.sel_h_in[i].value == obj_orig.hora_in)
			forma_dest.sel_h_in[i].selected=true;
		else
			forma_dest.sel_h_in[i].selected=false;
			
	for (var i = 0 ; i < forma_dest.sel_h_fin.length ; i++)
		if(forma_dest.sel_h_fin[i].value == obj_orig.hora_fin)
			forma_dest.sel_h_fin[i].selected=true;
		else 
			forma_dest.sel_h_fin[i].selected=false;
	if (obj_orig.hora_in != '') {
		forma_dest.mh_sel_horas.checked = true;
		forma_dest.sel_h_in.disabled = '';
		forma_dest.sel_h_fin.disabled = '';
		}
	else {
		forma_dest.mh_sel_horas.checked = false;
		forma_dest.sel_h_in.disabled = 'disabled';
		forma_dest.sel_h_fin.disabled = 'disabled';
		}
	
	if (obj_orig.fecha_fin != '') {
		forma_dest.chkbx_f_fin.checked = true;
		forma_dest.fecha_fin.disabled = '';
		}
	else {
		forma_dest.chkbx_f_fin.checked = false;
		forma_dest.fecha_fin.disabled = 'disabled';
		}
	
	forma_dest.id_hor_nodisp.value = obj_orig.cod_hor_nodisp;
	forma_dest.sel_h_in.focus();
	}
	
function cancelaModHor()
	{
	document.getElementById('modif_horario').style.display = 'none';
	}
