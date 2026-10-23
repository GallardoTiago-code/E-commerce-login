<?php
	session_start(); //inicializo la session
	if(empty($_SESSION['usuario'])){ //redireccion al inicio
		header('header: ../index.php');
	}
    $ruta = '../';
    require("encabezado.php");
	require_once('conexiones.php');
	
	$logueo = $_SESSION['usuario'];
	$foto = $_SESSION['foto'];
	$ruta ='../img/usuarios/';
	
	if(empty($foto)){
		$fotoDesignada = 'usuario_default.png';
	}else{
		$fotoDesignada = $logueo . '.jpg';
	}
	$conexion = conectar(); //conexion con la BD
	if($conexion && !empty($_GET['id'])){
		$id = $_GET['id'];
		$consulta = 'SELECT id_articulo,nombre,categoria,precio,foto
					 FROM articulo
					 WHERE id_articulo = ?
		';//segun el id del articulo devuelve datos
		$sentencia = mysqli_prepare($conexion,$consulta);
		mysqli_stmt_bind_param($sentencia,'i',$id);
		mysqli_stmt_execute($sentencia);
		mysqli_stmt_bind_result($sentencia,$nombre,$categoria,$precio,$foto);
		mysqli_stmt_store_result($sentencia);
		$cantidadFilas = mysqli_stmt_num_rows($sentencia);
		if($cantidadFilas > 0){ //Condicion para busquedas que tengan 1 articulo como minimo
			mysqli_stmt_fetch($sentencia);
		}
	}
	desconectar($conexion);
	
?>
<header>
		<section class="d-flex justify-content-end">
			<article>
				<p class="fs-4 fw-bold m-2"><?php echo $logueo ?></p><!--Utilizo la vaiable global para traer el nombre de usuario-->
			</article>
			<article class="col-1">
				<img class="w-50 rounded-circle" src="<?php echo $ruta?><?php echo $fotoDesignada; ?>"><!--Utilizo la vaiable global para traer el de la foto de usuario-->
			</article>
			<article class="pe-5 pt-2 me-3">
				<a class="btn btn-dark " href="logueo_cierre.php">Cerrar Sesion</a>
			</article>
		</section>
</header>
<main class="container py-3">
        <section class="d-flex justify-content-center">
            <form class="p-4 border rounded w-50" action="articulo_alta_ok.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-center mb-4">Alta de Artículo</legend>

                    <label for="nombre" class="form-label">Nombre del artículo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control mb-3" required>

                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" id="categoria" name="categoria" class="form-control mb-3" required>

                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" required>

                    <label for="imagen" class="form-label">Subir imagen del artículo</label>
                    <input type="file" id="imagen" name="imagen" class="form-control mb-4" required>

                    <button type="submit" class="btn btn-primary w-100">Dar de alta</button>
                </fieldset>
            </form>
        </section>
    </main>

<?php
    require("pie.php");
?>