<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMON</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">

    <link rel="shortcut icon" href="img/pokebola.png" />
</head>
<body class="body_index">
    

<div class="container center-block" id="login">
	<div class="col-md-4 mx-auto">
		<img id="imgtitulo" src="img/titulo.png">
	</div>
	
   <div class="mx-auto col-md-6 text-center">
   	<form action="#" method="POST" id="form_inicar">
   	  <div class="form-group">
   	  	<center>
   	  		<div class="mensaje">
   	  			<p >Parece que alguno de los datos ingresados es incorrecto por favor verifica!</p>
   	  		</div>
   	  	</center>
   	    <label for="exampleInputEmail1">Correo Electronico</label>
   	    <input type="email" class="form-control" id="correo" aria-describedby="emailHelp" required="">
   	  </div>
   	  <div class="form-group">
   	    <label for="exampleInputPassword1">Constraseña</label>
   	    <input type="password" class="form-control" id="password"  autocomplete="off" required="">
   	  </div>
   	  <center>
   	  	<div >
   	  		<p>No estas registrado? Click <a href="views/RegistrarUsuario.php">aqui</a> para hacerlo!</p>
   	  	</div>
   	  </center>

   	  <center>
   	  	<button type="submit" class="btn" id="btn_iniciar">INICIAR</button>
   	  </center>
   	  
   	</form>
   </div>

   <div  id="gif" class="col-md-2 mx-auto">
   	 <img src="img/loading.gif">
   </div>
</div>


<script type="text/javascript" src="js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#gif").hide()
		$(".mensaje").hide()
	});

	$("#form_inicar").submit(function(event) {
		event.preventDefault()
		$("#gif").show()
		email = $("#correo").val()
		password = $("#password").val();

		if (email!="" && password!="") {
			$.ajax({
				url: 'php/start_sesion.php',
				type: 'POST',
				dataType: 'json',
				data: {dato1:email, dato2:password},
			})
			.done(function(dat) {
				if (dat['statement'] == "OK##SESSION##START") {
					//escondemos el gift y vaciamos todos los campos del formulario 
					$("#gif").hide()
					$("#correo").val("")
					$("#password").val("")
					window.location.assign("views/poke_index.php")
				}else{
					$("#gif").hide()
					$("#correo").val("")
					$("#password").val("")
					$(".mensaje").show()
					$("#correo").focus()
				}
			})
			.fail(function(dat) {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			

		}
	});

	$("#correo").change(function(event) {
		$(".mensaje").hide()
	});
</script>



    
</body>
</html>