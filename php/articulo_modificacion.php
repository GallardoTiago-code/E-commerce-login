<?php
	session_start();
    $ruta = '../';
	
    require("encabezado.php");
	require_once("conexiones.php");
	if(empty($_SESSION['usuario'])){
		header('header: ../index.php');
	}
	          
	$logueado = $_SESSION['usuario'];
	$foto = $_SESSION['foto'];
		$ruta = '../img/usuarios/';
		
		if (empty($foto)) {
			$fotoMostrar = $ruta . 'usuario_default.png';
		} else {
			$fotoMostrar = $ruta . $foto;	
		}

	
	if (!empty($_GET['id'])){//verifica que el id no este vacio
		$id_articulo = $_GET['id'];
		$conexion = conectar();
		
		if($conexion){
			$sql = 'SELECT nombre, categoria, precio, foto
					FROM articulo
					WHERE id_articulo = ?';
					//recauda los datos de los parametros mediante el id
			$sentencia = mysqli_prepare($conexion, $sql);
			mysqli_stmt_bind_param($sentencia, 'i', $id_articulo);
			mysqli_stmt_execute($sentencia);
			
			mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto);//Da los valores en cada categoria
            mysqli_stmt_fetch($sentencia);
			desconectar($conexion);
		}
	}
	
?>

<main class="container py-3">
        <section class="d-flex justify-content-center">
            <form class="p-4 border rounded w-50" action="articulo_modificacion_ok.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-center mb-4">Modificación de Artículo</legend>

                    <input type="hidden" name="id_articulo" value="">

                    <label for="nombre" class="form-label">Nombre del artículo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control mb-3" required value="<?php echo $nombre;?>">

                    <label for="categoria" class="form-label">Categoría</label>
                    <input type="text" id="categoria" name="categoria" class="form-control mb-3" required value="<?php echo $categoria;?>">

                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" step="0.01" id="precio" name="precio" class="form-control mb-3" required value="<?php echo $precio;?>">

                    <label for="imagen" class="form-label">Subir imagen del artículo</label>
                    <input type="file" id="imagen" name="imagen" class="form-control mb-4">
					
					<input type="hidden" name="id" value="<?php echo $id_articulo;?>">
					<input type="hidden" name="fotoActual" value="<?php echo $foto;?>">

                    <button type="submit" class="btn btn-primary w-100">Modificar</button>
                </fieldset>
            </form>
        </section>
    </main>

<?php
    require("pie.php");
?>