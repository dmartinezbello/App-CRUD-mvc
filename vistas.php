<?php 
require_once "conexion.php";

function listaEditoriales()
{
	//esta función generará el select de las editoriales
	//echo "listaEditoriales";
	$mysql = conexionMySQL();
	$sql = "SELECT * FROM editorial";
	$resultado = $mysql->query($sql);
	$lista = "<select id='editorial' name='editorial_slc' required>";
		$lista .= "<option value=''>- - -</option>";
		while($fila = $resultado->fetch_assoc())
		{
			//$lista .= "<option value='".$fila["id_editorial"]."'>".$fila["editorial"]."</option>";
			$lista .= sprintf(
				"<option value='%d'>%s</option>",
				$fila["id_editorial"],
				$fila["editorial"]
			);
		}
	$lista .= "</select>";
	$resultado->free();
	$mysql->close();
	
	return $lista;
}

function catalogoEditoriales()
{
	$editoriales = Array();
	$sql = "SELECT * FROM editorial";
	$mysql = conexionMySQL();
	
	if($resultado = $mysql->query($sql))
	{
		while($fila = $resultado->fetch_assoc())
		{
			$editoriales[$fila["id_editorial"]]=$fila["editorial"];
		}
		$resultado->free();
	}
	$mysql->close();
	//print_r($editoriales);
	return $editoriales;
}
//catalogoEditoriales();
/*
Pasos Para conectarme a MySQL con PHP
1)Objeto de Conexión: $mysql = conexionMySQL();
2)Consulta SQL: $sql = "SELECT * FROM  heroes ORDER BY id_heroe DESC";
3)Ejecutar la consulta: $resultado = $mysql->query($sql)
4)Mostrar Resultados: $fila = $resultado->fetch_assoc()
*/
function mostrarHeroes()
{
	$editorial = catalogoEditoriales();
	
	$mysql = conexionMySQL();
	$sql = "SELECT * FROM heroes ORDER BY id_heroe DESC";
	if($resultado = $mysql->query($sql))
	{
		//echo "WIIII";
		//Compruebo que el query me regrese registros
		$totalRegistros = mysqli_num_rows($resultado);
				
		if($totalRegistros==0)
		{
			$respuesta = "<div class='error'>No existe registros de Super Héroes. La Base de Datos esta vacía.</div>";	
		}
		else
		{
				
			$tabla = "<table id='tabla-heroes' class='tabla'>";
			$tabla .= "<thead>";
				$tabla .= "<tr>";
					$tabla .= "<th>Id Héroe</th>";
					$tabla .= "<th>Nombre</th>";
					$tabla .= "<th>Imagen</th>";
					$tabla .= "<th>Descripción</th>";
					$tabla .= "<th>Editorial</th>";
					$tabla .="<th></th>";
					$tabla .= "<th></th>";
				$tabla .= "</tr>";
			$tabla .= "</thead>";
			$tabla .= "<tbody>";
			while($fila = $resultado->fetch_assoc())
			{
				$tabla .= "<tr>";
					$tabla .= "<td>".$fila["id_heroe"]."</td>";
					$tabla .= "<td><h2>".$fila["nombre"]."</h2></td>";
					$tabla .= "<td><img src='img/".$fila["imagen"]."' /></td>";
					$tabla .= "<td><p>".$fila["descripcion"]."</p></td>";
					$tabla .= "<td><h3>".$editorial[$fila["editorial"]]."</h3></td>";
					$tabla .="<td><a href='#' class='editar' data-id='".$fila["id_heroe"]."'>Editar</a></td>";
					$tabla .= "<td><a href='#' class='eliminar' data-id='".$fila["id_heroe"]."'>Eliminar</a></td>";
				$tabla .= "</tr>";
			}
			$resultado->free();
			$tabla .= "</tbody>";
			$tabla .= "</table>";
			
			//Explicar que el echo no soporta imprimir funciones cuando ponga mostrarTipo
			$respuesta = $tabla;
		}
	}
	else
	{
		//echo "NOOOOO";
		$respuesta = "<div class='error'>Error: No se ejecuto la consulta a la Base de Datos</div>";
	}
	$mysql->close();
	return printf($respuesta);
}
?>