<?php
	session_start();
	require_once('conexiones.php');
?>
<?php
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    //hacer cuestiones
		$usu = $_POST['username'];
		$clave = sha1($_POST['password']);
	$conectar = conectar();
	if($conectar){
		$consulta =  'SELECT usuario, pass, foto
					  FROM usuario
					  WHERE usuario = ? AND pass = ?
		';
		$sentencia = mysqli_prepare($conectar,$consulta);
		mysqli_stmt_bind_param($sentencia,'ss',$usu,$clave);
		$q = mysqli_stmt_execute($sentencia);
		mysqli_stmt_bind_result($sentencia,$usuarioBD,$passBD,$fotoBD);
		mysqli_stmt_fetch($sentencia);
		desconectar($conectar);
		if($q){
			if($usu === $usuarioBD && $clave === $passBD){
				$_SESSION['usuario'] = $usuarioBD;
				$_SESSION['foto'] = $fotoBD;
				header('refresh:0;url=articulo_listado.php');
			}else{
				echo('<p>Usuarios Incorrectos</p>');
				header('refresh:2;url=../index.php');
			}
		}
	}
}

?>