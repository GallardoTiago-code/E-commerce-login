<?php
	session_start(); //
	require_once('conexiones.php');
	
	if(empty($_SESSION['usuario'])){//verificacion por si el dato usuario de index.php esta vacio
		header('header: ../index.php');
	}
    $ruta = '../';
    require_once("encabezado.php");

		$usuario = $_SESSION['usuario'];
		$foto = $_SESSION['foto'];
		$ruta = '../img/usuarios/';
		$default = 'usuario_default.png';
		//Establezco los datos de los parametros
		
		if (empty($foto)) {
			$fotoMostrar = $ruta . 'usuario_default.png';
		} else {
			$fotoMostrar = $ruta . $foto;	
		}
		//seleccion de foto segun el nombre de usuario
?>

<main class="container">
	<header class="bg-dark">
		<section class="d-flex justify-content-end align-items-center text-white">
			<article>
				<p class="m-1 fs-4"><?php echo $usuario?></p>
			</article>
			<article class="col-1 text-center">
				<img class="w-50" src="<?php echo $fotoMostrar?>">
			</article>
			<article class="me-3">
				<a class="btn btn-info " href="logueo_cierre.php">Cerrar Sesion</a><!--redirige a logueo cierre para ejecutar la funcion de cierre de session-->
			</article>
		</section>
	</header>
    <section class="row">
        <form action="" method="get" class="p-5 d-flex justify-content-start align-items-center">
            <label for="categoria" class="form-label me-3">Filtrar por categoría:</label>
            <select id="categoria" name="categoria" class="form-select w-25 me-3">
                <option value="">Ninguna</option>
                <option value="Celulares">Celulares</option>
                <option value="Electrodomésticos">Electrodomésticos</option>
                <option value="Televisores">Televisores</option>
            </select>
            <input type="text" name="busqueda" placeholder="Buscar..." class="form-control w-25 me-3">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </section>
    <section>
        <article class="row text-center">
            <section class="d-flex justify-content-center pt-3">
                <table class="table table-bordered table-hover table-striped w-auto">
                    <caption class="caption-top text-center bg-dark text-white">Listado de articulos</caption>
                    <tr>
                        <th class="bg-secondary text-white">Foto</th>
                        <th class="bg-secondary text-white">Producto</th>
                        <th class="bg-secondary text-white">Categoria</th>
                        <th class="bg-secondary text-white">Precio</th>
                        <th class="bg-secondary text-white">Modificar</th>
                        <th class="bg-secondary text-white">Eliminar</th>
                    </tr>
                    
                    <?php
					   $eliminar = '../img/eliminar.png';
					   $modificar = '../img/modificar.png';
                       $conexion = conectar();
					   if($conexion){
							$categoria = null;
							$busqueda = null;
							//inicializo en null
						if (!empty($_GET['categoria'])) {
							$categoria = $_GET['categoria'];
						}
						if (!empty($_GET['busqueda'])) {
							$busqueda = $_GET['busqueda'];
						}
						if ($categoria && $busqueda) {
						$consulta = 'SELECT id_articulo,foto, nombre, categoria, precio 
									FROM articulo 
									WHERE categoria = ? AND nombre LIKE ?
									';
						$sentencia = mysqli_prepare($conexion, $consulta);
						$busquedaSimilar = '%' . $busqueda . '%';
						mysqli_stmt_bind_param($sentencia, 'ss', $categoria, $busquedaSimilar); 
						//busqueda segun categoria y nombre de articulo
						} else if ($categoria) {
						$consulta = 'SELECT id_articulo,foto, nombre, categoria, precio 
								FROM articulo 
								WHERE categoria = ?'; 
						$sentencia = mysqli_prepare($conexion, $consulta);
						mysqli_stmt_bind_param($sentencia, 's', $categoria); 
						//busqueda segun categoria
						} else if ($busqueda) {	
							$consulta = 'SELECT id_articulo,foto, nombre, categoria, precio 
									FROM articulo 
									WHERE nombre LIKE ?'; 
							$sentencia = mysqli_prepare($conexion, $consulta);
							$busquedaSimilar = '%' . $busqueda .'%'; 
							mysqli_stmt_bind_param($sentencia, 's', $busquedaSimilar); 	
							//busqueda segun nombre de articulo
						} else {
							$consulta = 'SELECT id_articulo,foto, nombre, categoria, precio 
									FROM articulo'; 
							$sentencia = mysqli_prepare($conexion, $consulta);
						}	
						//busqueda completa sin importar
						mysqli_stmt_execute($sentencia);
						mysqli_stmt_bind_result($sentencia,$idBD,$fotoBD, $nombreBD, $categoriaBD, $precioBD);
						while (mysqli_stmt_fetch($sentencia)){
							$fotoMostrar = '';
							if(empty($fotoBD)){
								$fotoMostrar = '../img/articulos/sin_imagen.png';
							}else{
								$fotoMostrar = '../img/articulos/' . $fotoBD;
							}
							$precioFormato = number_format($precioBD, 2, ',', '.');
							echo '<tr>';
								   echo ('<td><img src="' . $fotoMostrar . '" width="50"></td>');
								   echo ('<td>' . $nombreBD . '</td>');
								   echo ('<td>' . $categoriaBD . '</td>');
								   echo ('<td>$' . $precioFormato . '</td>');
								   echo ('<td><a href="articulo_modificacion.php?id=' . $idBD . '"><img class="p-4" src="../img/modificar.png" alt="Modificar" ></a></td>');
								   echo ('<td> <a href="articulo_eliminar.php?id=' . $idBD . '"><img  class="p-4" src="../img/eliminar.png" alt="Eliminar" ></a></td>');
							echo '</tr>';
							}
							//escribe cada articulo en relacion de filas
					}
					   desconectar($conexion);
                    ?>
                </table>
            </section>
			<section class="text-center">
			<a href="articulo_alta.php" class="btn btn-primary col-2 p-2 mb-4">Alta de Objeto</a>
			</section>
        </article>
    </section>
</main>

<?php
    require("pie.php");
?>