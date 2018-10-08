//Constante
var READY_STATE_COMPLETE = 4;
var OK = 200;

//Variables
var ajax = null;
var btnInsertar = document.querySelector("#insertar");
var precarga = document.querySelector("#precarga");
var respuesta = document.querySelector("#respuesta");

//Funciones
function objetoAjax()
{
	if(window.XMLHttpRequest)
	{
		return new XMLHttpRequest();
	}
	else if(window.ActiveXObject)
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function ejecutarAJAX(datos)
{
	ajax = objetoAjax();
	ajax.onreadystatechange=enviarDatos;
	ajax.open("POST","controlador.php");
	/*
	http://es.wikipedia.org/wiki/Multipurpose_Internet_Mail_Extensions
	http://sites.utoronto.ca/webdocs/HTMLdocs/Book/Book-3ed/appb/mimetype.html
	*/
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(datos);
}

function enviarDatos()
{
	precarga.style.display = "block";
	precarga.innerHTML = "<img src='img/loader.gif' />";

	/*
	http://es.wikipedia.org/wiki/Anexo:Códigos_de_estado_HTTP
	http://librosweb.es/ajax/capitulo_7/metodos_y_propiedades_del_objeto_xmlhttprequest.html
	*/
	if(ajax.readyState == READY_STATE_COMPLETE)
	{
		if(ajax.status == OK)
		{
			//console.log(ajax);
			//alert("wiii");
			//alert(ajax.responseText);
		}
		else
		{
			//console.log(ajax);
			//alert("nooo");
		}	

	}
}

function altaHeroe(evento)
{
	evento.preventDefault();
	var datos = "transaccion=alta";
	ejecutarAJAX(datos);
}

function alCargarElDocumento()
{
	btnInsertar.addEventListener("click",altaHeroe);
}

//Eventos
window.addEventListener("load",alCargarElDocumento);