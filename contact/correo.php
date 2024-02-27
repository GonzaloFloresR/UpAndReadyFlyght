<?php

// Verificar si se recibió data del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Verificar que la data proviene del formulario
    $referer = $_SERVER['HTTP_REFERER'];
    $form_url = 'https://www.upandreadyflight.com/contact/';
	$form_url1 = 'https://www.upandreadyflight.com/contact/?success=true';
	$form_url2 = 'https://www.upandreadyflight.com/contact/?success=false_url';
	$form_url3 = 'https://www.upandreadyflight.com/contact/?success=false_data';
	
    
    if ($referer !== $form_url && $referer !== $form_url1 && $referer !== $form_url2 && $referer !== $form_url3) {
        // Devolver un JSON con un mensaje de error
        echo 'false_url';
        exit();
    }
    
    // Recibir data del formulario
    $name = validate_input($_POST["name"]);
    $phone = validate_input($_POST["phone"]);
    $message = validate_input($_POST["message"]);
    $visto = validate_input($_POST["visto"]);
    
    // Validar que los campos no estén vacíos
    if (empty($name) || empty($phone) || empty($message) || empty($visto)) {
        // Devolver un JSON con un mensaje de error
        echo 'false_data';
        exit();
    }
    
    // Formatear el mensaje en HTML
    $email_message = "
    <!DOCTYPE html>
	<html lang='en'>
		<head>
    		<meta charset='UTF-8'>
    		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    		<link rel='stylesheet' href='https://www.upandreadyflight.com/css/style.css'>
			<style>
				body{ 
					width: 100%;
					height: auto;
					overflow: hidden;
					margin: 0px;
					padding: 0px;
				}
				
				#conteiner{
				width: 500px;
				margin: 0px auto;
				background-color: white;
				font-size:16px;
				}
				
				h2 {
				background-color: black;
				color:white;
				font-weight: 300;
				padding: 10px 0px;
				text-align: center;
				margin: 10px 0px 0px 0px;;
				}
				
				p {
					border-bottom: 1px solid black;
					padding: 15px 10px;
					font-weight: 300;
					color: black;
				}
				
				p strong{
					width: 90px;
					display: inline-block;
					font-weight: 500;
				}
				
				.logo{
					width: 500px;
					height: auto;	
					background-color: black;
					padding: 10px 0px;
				}
				
				.logo img {
					width: 120px;
					height: auto;
					margin: 0px auto;
					display: block;
				}
			</style>
    	</head>
    	<body>
		    <div id='conteiner'>
    		<h2>Contact Form UpAndReadyFlight</h2>
    		<p><strong>Name:</strong> $name</p>
    		<p><strong>Phone:</strong> $phone</p>
    		<p><strong>Message:</strong> $message</p>
			<div class='logo'>
				<img src='https://www.upandreadyflight.com/img/ur-gold-icon-1.png'>
			</div>
			</div>
    	</body>
    </html>
    ";
    
    // Cabeceras adicionales
    $headers = "MIME-Version: 1.0" . "\r\n" .
			   "Content-type:text/html;charset=UTF-8" . "\r\n" .
			   "From: info@upandreadyflight.com" . "\r\n" .
               "Reply-To: brett@upandreadyflight.com" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    
    // Correos electrónicos a los que se enviará la data
    $to_emails = array('L39cfi@gmail.com', 'info@upandreadyfight.com', 'gonzalof@hotmail.com');
    
    // Enviar correo electrónico a cada destinatario
    foreach ($to_emails as $to_email) {
        mail($to_email, "Contact Form UpAndReadyFlight", $email_message, $headers);
    }
    
    // Devolver un JSON con un mensaje de éxito
    echo 'success';
    exit();
}

// Función para validar la data recibida del formulario
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
