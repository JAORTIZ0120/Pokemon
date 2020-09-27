<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEMON</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../img/pokebola.png" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body class="body_registrar">
    

<div class="container center-block" >
	<div class="col-md-4 mx-auto">
		<img id="imgtitulo" src="../img/titulo.png">
	</div>
	
   <div class="mx-auto col-md-6 text-center " id="register">
   	<form action="#" method="POST" id="form_registro" >
      <center>
            <div class="form-group col-md-9">
              <label for="exampleInputEmail1">Correo Electronico</label>
              <input type="email" class="form-control" id="correo" aria-describedby="emailHelp" required >
            </div>
            <small class=" alert-danger"  id="alert_no_disponible">Este correo no se encuentra disponible!</small>
            <small class=" alert-success"  id="alert_disponible">Correo disponible!</small>
            
             <div class="form-group col-md-9 ">
               <label for="exampleInputEmail1">Nombre de usuario</label>
               <input type="text" class="form-control" id="nombre" required>
             </div>
              <div class="form-group col-md-9">
                <label for="exampleInputPassword1">Constraseña</label>
                <input type="password" class="form-control" id="password"  autocomplete="off" required>
              </div>
             <div class="form-group col-md-9">
               <label for="exampleInputPassword1">Repetir Constraseña</label>
               <input type="password" class="form-control" id="password_repetida"  autocomplete="off" required>
             </div>
             <div >
              <p>Ya tienes cuenta? Click <a href="../index.php">aqui</a> para inicar sesion!</p>
             </div>
              
              <button type="submit" class="btn" id="btn_registrar">REGISTRAR</button>      
   	  </center>
   	  
   	</form>
   </div>

   <div id="loading" class="col-md-2 mx-auto">
   	 <img  src="../img/loading.gif">
   </div>
</div>


<script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#loading").hide()
    $("#alert_no_disponible").hide()
    $("#alert_disponible").hide()
  });


  $("#correo").change(function(event) {
    validar = $("#correo").val()
    $.ajax({
      url: '../php/validar_usuario.php',
      type: 'POST',
      dataType: 'json',
      data: {dato1:validar},
    })
    .done(function(data) {
      //validar que el correo este disponible
      if (data['disponibilidad'] == "USUARIO##DISPONIBLE") {
        $("#alert_disponible").show()

      }else{
        // deshabilita los campos para evitar que se pueda continuar el formulario sin haber corregido el campo 
        $("#nombre").prop('disabled', true)
        $("#password").prop('disabled',true)
        $("#password_repetida").prop('disabled', true)
        $("#btn_registrar").prop('disabled' , true )
        $("#alert_no_disponible").show()
        $("#correo").focus()

      }
    })
    .fail(function() {
      console.log("error");
    })

    
  });

//habilitar los campos denuevo cuando se presiona una tecla y el usuario este disponible
  $("#correo").keypress(function(event) {
    $("#alert_no_disponible").hide()
    $("#alert_disponible").hide()
    $("#nombre").prop('disabled', false)
    $("#password").prop('disabled',false)
    $("#password_repetida").prop('disabled', false)
    $("#btn_registrar").prop('disabled' , false )
    
  });



  $("#form_registro").submit(function(event) {
    event.preventDefault();
   //VALIDAMOS CAMPOS POR SEGURIDAD EVITANDO QUE ESTEN VACIAS Y QUE AMBOS CAMPOS DE CONTRASEÑA COINCIDAN
    if ($("#password").val() == $("#password_repetida").val()){
      nombre = $("#nombre").val()
      correo = $("#correo").val()
      password = $("#password").val()

      if (nombre!="" && correo!="" && password!="") {
        $("#loading").show()
        $.ajax({
          url: '../php/Registrar.php',
          type: 'POST',
          dataType: 'json',
          data: {dato1:nombre, dato2:correo, dato3:password},
        })
        .done(function(datos) {
          console.log("success");
          //recibimos la respuesta del servidor y validamos que se positiva para redirigir al usuario a la pagina de inicio de sesion
          if (datos['estado'] == "OK##USUARIO##INSERTADO") {
            $("#nombre").val("")
            $("#correo").val("")
            $("#password").val("")
            let timerInterval
            Swal.fire({
              icon: 'success',
              title: 'Exito',
              html: 'Te has registrado exitosamente',
              timer: 1500,
              timerProgressBar: true,
              willOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => {
                  const content = Swal.getContent()
                  if (content) {
                    const b = content.querySelector('b')
                    if (b) {
                      b.textContent = Swal.getTimerLeft()
                    }
                  }
                }, 100)
              },
              onClose: () => {
                clearInterval(timerInterval)
              }
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                window.location.assign("../index.php")
              }
            })
          }
        })
        .fail(function(datos) {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        
      }
    }else{
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'No se pudo registrar, porfavor valida los datos!',
          footer: ''
        })
    }
  });
  //CODIGO REALIZDO POR JHON ALEXIS ORITZ ATEHORTUA 


</script>
    
</body>
</html>