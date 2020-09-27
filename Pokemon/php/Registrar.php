<?php 
	if (empty($_POST)) {
		header("Location: http://localhost/Pokemon/");
	}
	include "Conexion.php";

	$nombre = strtoupper($_POST['dato1']);
	$correo = $_POST['dato2'];
	$password = md5($_POST['dato3']) ;

	$consulta = $conexion->prepare("INSERT INTO usuarios(username, email, password)VALUES(?,?,?)");

	$consulta->bindParam(1, $nombre);
	$consulta->bindParam(2, $correo);
	$consulta->bindParam(3, $password);

	if ($consulta->execute()) {
		$datos['estado'] = "OK##USUARIO##INSERTADO";
		echo json_encode($datos);
		die();
	}else{
		$datos['estado'] = "ERROR##INSERTANDO";
		echo json_encode($datos);
		die();
	}

 ?>