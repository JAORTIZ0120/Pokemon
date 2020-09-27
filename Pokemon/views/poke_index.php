<?php 
	session_start();

	if (empty($_SESSION['user'])) {
		header("Location: http://localhost/Pokemon/");
	}

 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="utf-8">
 	<title>POKEMON</title>
 	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 	<link rel="stylesheet" href="../css/estilos.css">

 	<link rel="shortcut icon" href="../img/pokebola.png" />
 </head>
 <body>
 	<!-- Image and text -->
 	<nav class="navbar navbar-light bg-light">
 	  <a class="navbar-brand" href="#">
 	    <img src="../img/titulo.png" width="200" height="50" class="d-inline-block align-top" alt="" loading="lazy">
 	  </a>
 	  <form class="form-inline">
 	  	<div class="text-center">
 	  		<center><p class="cambiar_color_user"><?php echo $_SESSION['user'][1]; ?></p></center>
 	  		<a href="../php/destroy_sesion.php" class="cerrar btn btn-danger">Cerrar Sesion</a>
 	  	</div>

 	  </form>
 	</nav>


 	<br><br><br>
 	<center>
 		<div  class="container ">
 			<div class="row text-center" id="ponerpo" onclick="">
 					<!--EN ESTE CONTENEDOR SE HUBICARAN LOS POKEMONES EXTRAIDOS DE LA API-->
 			</div>	
 		</div>
 	</center>

 	<script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
 	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
 	<script type="text/javascript">
 		
 		$(document).ready(function() {
 			traePokemon()
 		
 		});
 		
 		
 		
 		function traePokemon() {
 		 contador = 0
 		 for (var i = 1; i <893; i++) {
 		 	//SE UTILIZA EL BUCLE FOR PARA ACCEDER A LOS 893 POKEMONES EXISTENTES EN LA POKEAPI, CAVE ACLARAR QUE CIERTO NUMERO DE POKEMONES NO CUENTAN CON IMAGEN EN LA API
 				fetch(`https://pokeapi.co/api/v2/pokemon/${i}`)
 				.then(function (response){
 					response.json()
 					.then(function (pokemon){
 						
 						imagen = pokemon.sprites.front_default
 						nombre_pokemon = pokemon.name
 						texto=" <div class='card col-md-4 mb-2 mr-0 text-center' >"
 						texto+=" <img src='"+imagen+"' class='card-img-top' alt='...'>"
 						texto+="	<div class='card-body'>"
 						texto+="		<input type='button' class='btn btn-outline-success' value='"+nombre_pokemon+"' onclick='detallesPoke($(this).val())'>"
 						texto+="	</div>"
 						texto+=" </div>"
 						
 						$("#ponerpo").append(texto)

 					})
 				})
 			}
 		}


 		function detallesPoke(name) {
 			//FUNCION UTILIZADA PARA ENVIAR EL DATO DEL POKEMON QUE SEA SELECCIONADO PARA HACER LA REDIRECCION A LA PAGINA DE DETALLES_POKEMON.PHP PARA ASI EXTRAER EXCLUSIVAMENTE LOS DATOS DEL POKEMON POR MEDIO DE SU NOMBRE
 			nombre = name

 			document.location.href = "detalles_pokemon.php?dato1=" + nombre + "&";
 			
 			
 		}

 		//CODIGO REALIZDO POR JHON ALEXIS ORITZ ATEHORTUA 


 	</script>
 </body>
 </html>