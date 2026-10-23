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
		
function cambiarNombre($nombreOriginal, $nombreProducto) {
        $arreglo = explode('.', $nombreOriginal);
        $tamanio = count($arreglo);
        $extension = $arreglo[$tamanio - 1];
        
        $partesNombre = explode(' ', $nombreProducto);
        $nombreBase = implode('_', $partesNombre);
        $nombreNuevo = $nombreBase . '_' . mt_rand(1, 100) . '.' . $extension;
        return $nombreNuevo;
    }
?>
<?php	
	if (!empty($_GET['id'])){
		$id_articulo = $_GET['id'];
		$conexion = conectar();
		
		if($conexion){
			$sql = 'SELECT nombre, categoria, precio, foto
					FROM articulo
					WHERE id_articulo = ?';
			$sentencia = mysqli_prepare($conexion, $sql);
			mysqli_stmt_bind_param($sentencia, 'i', $id_articulo);
			mysqli_stmt_execute($sentencia);
			
			mysqli_stmt_bind_result($sentencia, $nombre, $categoria, $precio, $foto);
            mysqli_stmt_fetch($sentencia);
			desconectar($conexion);
		}
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
if(!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['categoria']) && !empty($_POST['precio']) ){
		
		$id = $_POST['id'];
		$nombre = $_POST['nombre'];
		$categoria = $_POST['categoria'];
		$precio = $_POST['precio'];
		$fotoActual = $_POST['fotoActual'];
		
		$rutaVieja = '../img/articulos/' . $fotoActual;
		$fotoBD = $fotoActual;
		$conexion = conectar();
		if($conexion){
            
			if (!empty($_FILES['imagen']['name'])) {
				$nombreOriginal = $_FILES['imagen']['name'];
                $rutaTmp = $_FILES['imagen']['tmp_name'];
                $carpeta = '../img/articulos/';
                
                $fotoBD = cambiarNombre($nombreOriginal, $nombre);
                $destino = $carpeta . $fotoBD;

                if (!file_exists($carpeta)) {
                    mkdir($carpeta);
                }
            
                if (move_uploaded_file($rutaTmp, $destino)) {
					if (!empty($fotoActual) && file_exists($rutaVieja) && $fotoActual != $fotoBD) {
                        unlink($rutaVieja);
                    }
                } else {
                    $fotoBD = $fotoActual;
                }
			
            
			} else if ($_FILES['imagen']['error'] == 4) {
                
                $fotoBD = '';
                if (!empty($fotoActual) && file_exists($rutaVieja)) {
                    unlink($rutaVieja);
                }
            }
			
			$sql = 'UPDATE articulo SET nombre = ?, categoria = ?, precio = ?, foto = ?
					WHERE id_articulo = ?';
			$sentencia = mysqli_prepare($conexion, $sql);
			mysqli_stmt_bind_param($sentencia, 'ssdsi', $nombre, $categoria, $precio, $fotoBD, $id);
			$resultado = mysqli_stmt_execute($sentencia);
            
            desconectar($conexion);
			
			if($resultado){
				echo '<p class="text-center fw-bold ">Modificacion Exitosa</p>';
				echo '<p class="text-center fw-bold ">Será redireccionado al listado</p>';
                header('refresh:3; url=articulo_listado.php');
			}else{
				echo 'Error al actualizar';
			}
		}else{
			echo 'Error de conexión.';
		}
} else {
        echo 'Faltan datos obligatorios para modificar.';
}
?>
<?php
	require_once('pie.php');
?>