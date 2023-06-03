<<?php 
	class UsuarioDAO{
		/*
		private $server = "bd-aries.mysql.database.azure.com";
		private $user = "Administrador";
		private $pass = "Aries123";
		private $db = "vidreria";
		*/

		private $server = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "bd_aries";

		public function conectar(){
			$mysqli = new mysqli($this->server,
                                $this->user,
                                $this->pass,
                                $this->db);
			return $mysqli;
		}

		public function consulta($csql){
			$conexion = $this->conectar();
			$resultado = $conexion->query($csql);

			return $resultado;
		}

		public function login($usuario, $password){
			$conexion = $this->conectar();
			$consulta = "SELECT * FROM usuario where usuario = '$usuario' and contrasena = '$password'";
			$resultado = mysqli_query($conexion, $consulta);
			$filas = mysqli_num_rows($resultado);
			return $filas;
		}
	}
 ?>