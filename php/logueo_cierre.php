<?php

	session_start();

	if (!empty($_SESSION['usuario'])) {
		session_destroy();//destruye la session eliminando los datos guardados
	}
	
	echo '<h2>Cerrando sesion</h2>';
	header('refresh:2; ../index.php');
	exit();//cierra la session

?>