<?php 
	if (empty($_POST)) {
		header("Location: http://localhost/Pokemon/");
	}
	include "Conexion.php";

	$email = $_POST['dato1'];
	$pass = md5($_POST['dato2']);
	// validamos seguridad evitando consultas vacias

	if (!empty($email) && !empty($pass)) {
		
		$consulta = $conexion->prepare("SELECT username, email FROM usuarios WHERE email=? AND password=?");
		//preparamos la consulta y la ejecutamos
		$consulta->execute([$email,$pass]);

		if ($consulta->rowCount()!=0) {
			// si la consulta devuelve los datos solicitados inicamos la sesion 
			session_start();

			$_SESSION['user'] = $consulta->fetchAll()[0];

			$dat['statement'] = "OK##SESSION##START";
			echo json_encode($dat);
		}else{
			$dat['statement'] = "EROR##SESSION##START";
			echo json_encode($dat);
		}
	}


 ?>