<?php
	session_start();
	if(empty($_SESSION['usuario'])){
		header('header: ../index.php');
	}
    $ruta = '../';
    require("encabezado.php");
	require_once("conexiones.php");
	          
	$logueado = $_SESSION['usuario'];
	$foto = $_SESSION['foto'];
		$ruta = '../img/usuarios/';
		
		if (empty($foto)) {
			$fotoMostrar = $ruta . 'usuario_default.png';
		} else {
			$fotoMostrar = $ruta . $foto;	
		}
?>

<header>
		<section class="d-flex justify-content-end">
			<article>
				<p class="fs-4 fw-bold m-2"><?php echo $logueado ?></p>
			</article>
			<article class="col-1">
				<img class="w-50 rounded-circle" src="<?php echo $fotoMostrar; ?>">
			</article>
			<article class="pe-5 pt-3 me-3">
				<a class="btn btn-dark " href="logueo_cierre.php">Cerrar Sesion</a>
			</article>
		</section>
	</header>

<?php
	$conexion = conectar();
	
	if ($conexion && !empty($_GET['id'])){
		$id = $_GET['id'];
		$consulta = 'DELETE FROM articulo
					 WHERE id_articulo = ?';
					 //agarra el articulo y lo borra segun el id
		$sentencia = mysqli_prepare($conexion, $consulta);
		mysqli_stmt_bind_param($sentencia, 'i', $id);
		$resultado = mysqli_stmt_execute($sentencia);
		
		if ($resultado){//si se ejecuta la consulta entonces escribe
			echo '<p class="text-center fw-bold p-5">Eliminacion exitosa</p>';
			header('refresh:3; url=articulo_listado.php');
		}else{
			echo '<p>No se pudo eliminar</p>';
		}
	}else{
		echo 'no se realizo la eliminacion';
	}

?>
<?php?>