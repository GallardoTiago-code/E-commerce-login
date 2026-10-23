<?php
	function conectar(){//establece conexion con la BD llamada labo2
		$servidor = 'localhost';
		$usuario = 'root';
		$clave = '';
		$nombreBaseDato = 'labo2';
		
		 set_error_handler(function(){
			throw new Exception('Error');
		});
		
		try{
			$conexion = mysqli_connect($servidor,$usuario,$clave,$nombreBaseDato);//conexion con los parametros del servidor
		}
		
		catch(Exception $e){
			$conexion = false;//si ocurre un fallo de conexion retorna falso
		}
		return($conexion);
	}
	
	function desconectar($conexion){//cierre de conexion
		if($conexion){//verifica que exista para despues cerrarla
		mysqli_close($conexion);
		}
	}
?>