<?php
	if(empty($_SESSION['usuario'])){
		header('header: ../index.php');
	}
    $ruta = '../';
	session_start();
    require("encabezado.php");
    require("conexiones.php");
	
	$nombreArticuloBD='';
	$id = 0;
if(!empty($_GET['id'])){
	$id = $_GET['id'];
	$conexion = conectar();
	if($conexion){
		$q = 'SELECT nombre FROM articulo
			  WHERE id_articulo = ?
			 ';
			 //recauda data segun el id
		$sentencia = mysqli_prepare($conexion,$q);
		mysqli_stmt_bind_param($sentencia,'i',$id);
		mysqli_stmt_execute($sentencia);
		mysqli_stmt_bind_result($sentencia, $nombreArticuloBD);
		mysqli_stmt_fetch($sentencia);
	desconectar($conexion);
	}
}	
	
	if(!empty($nombreArticuloBD)){//verifica que el articulo con ese nombre tenga id y no este vacio
		echo('<main class="text-center">');
			echo('<h1>Eliminar artículo</h1>');
			echo('<p>¿Esta seguro de que quiere eliminar el articulo'. $nombreArticuloBD . '?</p>');
			
			echo('<section class=" d-flex justify-content-center">');
			echo('<a href="articulo_eliminar_ok.php?id='.$id.'; >" class="btn btn-info m-3 ">Aceptar </a>');//redirige a la comprobacion con el id
			echo('<a href="articulo_listado.php" class="btn btn-secondary m-3">Cancelar</a>');
			echo('</section>');
		echo('</main>');
	}else{
		echo('<h1 class="text-center bg-danger p-2 ">Error al encontrar articulo</h1>');
	}
	
?>
<?php

    require("pie.php");
?>