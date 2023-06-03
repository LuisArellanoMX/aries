<?php
    class PedidoDAO{
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

        public function registro($idProducto, $nombre, $direccion, $telefono){
            $conexion = $this->conectar();
            $consulta = "INSERT INTO pedido VALUES (null,'$idProducto', 1, '$nombre', '$direccion', '$telefono')";
            $resultado = mysqli_query($conexion, $consulta);
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