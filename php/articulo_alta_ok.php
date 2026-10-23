<?php
	session_start();
	if(empty($_SESSION['usuario'])){
		header('header: ../index.php');
	}
	$ruta = '../';
	require_once("encabezado.php");
	require_once('conexiones.php');
	$conexion = conectar();
	if($conexion){
		if(!empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio'])){//verifico si los datos no estan vacios
		$nombreBD = $_POST['nombre'];
		$categoriaBD = $_POST['categoria'];
		$precioBD = $_POST['precio'];
			if(!empty($_FILES['imagen']['size'])){//verifico si la foto no esta vacia
				$nombre =$_FILES['imagen']['name'];
				function cambiarNombre($nombre,$nombreBD){//funcion para cambiar el nombre de la foto y ponerle un numero al azar por si los productos se repiten
					$arreglo = explode('.',$nombre);
					$tamaño = count($arreglo);
					$extension = $arreglo[$tamaño - 1];
					$nombreNuevo = $nombreBD . mt_rand(1,100) . '.' . $extension;
					return($nombreNuevo);
				}
				$cambioNombre = cambiarNombre($nombre,$nombreBD);//llamo a la funcion
				$carpeta = '../img/articulos/';
				$destino = $carpeta . $cambioNombre;
				$rutaTmp = $_FILES['imagen']['tmp_name'];
				$articulo = move_uploaded_file($rutaTmp , $destino); 
				if(!file_exists($carpeta)){//verifico si existe la carpeta,sino la creo
					mkdir($carpeta);
				}
				$fotoBD = $cambioNombre;
			}else{
				$fotoBD = 'sin_imagen.png';
			}
		$consulta = 'INSERT INTO articulo(nombre,categoria,precio,foto)
					 VALUES (?,?,?,?)
		';//consulta para asignar los valores del articulo
		$sentencia = mysqli_prepare($conexion,$consulta);
		mysqli_stmt_bind_param($sentencia,'ssss',$nombreBD,$categoriaBD,$precioBD,$fotoBD);
		$q = mysqli_stmt_execute($sentencia);
	}
}
	
	desconectar($conexion);
	if($q){
	echo('<section class="text-center"><a href="articulo_listado.php" class="btn btn-primary col-2 p-2 mb-4">Volver al inicio</a></section>');
	}
?>