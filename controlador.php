<?php
require "vistas.php";
require "modelo.php";
/*
Aplicación CreateReadUpdateDelete
PHP tiene 2 métodos de envío de datos: POST y GET
Create  Afecta BD     INSERT (SQL)  POST  Modelo
Read    No Afecta BD  SELECT (SQL)  GET   Vista
Update  Afecta BD     UPDATE (SQL)  POST  Modelo
Delete  Afecta BD     DELETE (SQL)  POST  Modelo
*/
$transaccion = $_POST["transaccion"];
//echo $transaccion." recuerden que AJAX se ejecuta en el servidor";
function ejecutarTransaccion($transaccion)
{
	if($transaccion=="alta")
	{
		//Mostrar el formulario de alta

	}
	else if($transaccion=="insertar")
	{
		//Procesar los datos del formulario de alta e insertarlos en MySQL

	}
	else if($transaccion=="eliminar")
	{
		//Eliminar de MySQL el registro solicitado

	}
	else if($transaccion=="editar")
	{
		//Traer los datos del registro a modificar en un formulario

	}
	else if($transaccion=="actualizar")
	{
		//Modificar en MySQL los datos del registro modificado

	}
}
ejecutarTransaccion($transaccion);
?>