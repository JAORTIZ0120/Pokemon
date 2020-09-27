<?php 
	if (empty($_POST)) {
		header("Location: http://localhost/Pokemon/");
	}
	include "Conexion.php";

	$usuario_validar = $_POST['dato1'];

	$consulta = $conexion->prepare("SELECT email FROM usuarios WHERE email = '$usuario_validar' ");

	$consulta->execute();

	if ($consulta->rowCount() == 0) {
		$data ['disponibilidad'] = "USUARIO##DISPONIBLE";
		echo json_encode($data);
		die();
	}else{
		$data ['disponibilidad'] = "USUARIO##NO##DISPONIBLE";
		echo json_encode($data);
		die();
	}

 ?>