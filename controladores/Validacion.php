<<?php 
	include '../persistencia/userDAO.php';
	$usuarioDAO = new UsuarioDAO();

	$usuario = $_POST['usuario'] ?? null;
	$contraseña = $_POST['contraseña'] ?? null;
	session_start();
	$_SESSION['usr'] = $usuario;
	$filas = $usuarioDAO->login($usuario, $contraseña);

	if ($filas) {
		header('location: ../vista/html/empleado.php');
	}else{
		header('location: ../vista/html/Login.php');
	}
?>