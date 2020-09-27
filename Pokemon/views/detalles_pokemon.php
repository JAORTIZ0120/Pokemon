<?php 
	session_start();
	if (empty($_SESSION['user'])) {
		header("Location: http://localhost/Pokemon/");
	}

	$pokemon = $_GET['dato1']
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>POKEMON</title>
 	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
 	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
 	<link rel="shortcut icon" href="../img/pokebola.png" />
 	<script src="https://kit.fontawesome.com/88e2f49abe.js" crossorigin="anonymous"></script>
 </head>
 <body id="body_detalles">
 	
 	<a href="#" id="volver" class="btn btn-success"><i class="fas fa-location-arrow"></i> VOLVER CON LOS POKEMONES</a>
 	<input id="nombre_pokemon" type="text" value="<?php echo $pokemon ?>"><!--ESTE INPUT SE UTILIZA COMO MEDIO PARA PASAR EL NOMBRE DEL POKEMON DESDE PHP A JS -->
 	
 	<div class="col-md-6 text-center mx-auto " id="detallespokemon">
 		<!-- EN ESTE CAMPO SE IMPRIME LA INFORMACION DEL POKEMON-->
 	</div>


 	<script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
 	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
 	<script type="text/javascript">
 		$(document).ready(function() {
 			pokemonDetails()
 			$("#nombre_pokemon").hide()
 		});

 		function pokemonDetails() {
 			pokemon = $("#nombre_pokemon").val()
 			//UTILIZANDO EL METODO FETCH LOGRAMOS ACCEDER DE UNA MANERA RAPIDA Y SENCILLA A LA POKE API
 			fetch(`https://pokeapi.co/api/v2/pokemon/${pokemon}`)
 			.then(function (response){
 				//REALIZAMOS UNA LLAMADA CON EL METODO THEN PARA RECIBIR LA RESPUESTA CON LOS DATOS DEL POKEMON PARA CONVERTIRLOS A UN FORMATO JSON Y DE ESTA MANERA ACCEDER A ELLOS 
 				response.json()
 				.then(function (pokemon){
 					
 					imagen = pokemon.sprites.front_default
 					nom = pokemon.name
 					nombre_pokemon = nom.toUpperCase()
 					habilidades = pokemon.abilities
 					texto = "<div class='col-md-5 mx-auto'>"
 					texto+= "		<img class='w-50 h-10' src='"+imagen+"'>"
 					texto+="     <h1>"+nombre_pokemon+"</h1> <br>"
 					texto+="      <h3>Habilidades</h3>"
 					for (var i = 0; i < habilidades.length; i++) {
 						texto+="<p class='habilidad'>  "+habilidades[i]['ability']['name']+"</p>"
 					}
 					texto+= "</div>"
 					$("#detallespokemon").append(texto)
 					
 					
 					

 				})
 			})

 			
 		}

 		$("#volver").click(function(event) {
 			window.location.assign("http://localhost/Pokemon/views/poke_index.php")
 		});
 		//CODIGO REALIZDO POR JHON ALEXIS ORITZ ATEHORTUA 
 	</script>
 	
 
 </body>
 </html>
 		
