 <?php

/*
// Check for empty fields
if(empty($_POST['nombre'])      ||
   empty($_POST['email'])     ||
   empty($_POST['asunto'])     ||
   empty($_POST['mensaje'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
      //echo "No arguments Provided!";
      $return["error"] = true;
   }*/
   
$nombre = strip_tags(htmlspecialchars($_POST['nombre']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$asunto = strip_tags(htmlspecialchars($_POST['asunto']));
$mensaje = strip_tags(htmlspecialchars($_POST['mensaje'])); 
 
 /* 
// Create the email and send the message
$to = 'adrian.magliola@gmail.com.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: adrian.magliola@gmail.com.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";   

mail("adrian.magliola@gmail.com","email@email.com","aaa");

$return["error"] = false;        */



require("../PHPMailer-master/PHPMailerAutoload.php");
$mail = new PHPMailer();

//Luego tenemos que iniciar la validación por SMTP:
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";  
$mail->Username = "digipayargentina@gmail.com";  
$mail->Password = "digipay2016"; 
$mail->Port = 465;  

// $mail->Host = "ci1.toservers.com";  
// $mail->Username = "hgdoro@ilh-research.com";  
// $mail->Password = "WuG9VvSBj4"; 
// $mail->Port = 465;  



$mail->From = "info@elserver.com"; // Desde donde enviamos (Para mostrar)
$mail->FromName = "Nombre";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
//$mail->AddAddress("nyndecoratuvida@gmail.com ");
$mail->AddAddress("adrian.magliola@gmail.com");
 
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Beex: Contacto WEB"; // Este es el titulo del email.

$body = "<strong>Nombre: </strong>".$nombre."<br>";
$body .= "<strong>Email: </strong>".$email."<br>";

if(isset($asunto))
   $body .= "<strong>Asunto: </strong>".$asunto."<br>";

$body .= "<strong>Mensaje: </strong>".$mensaje."<br>";


$mail->Body = $body;  
$exito = $mail->Send(); // Envía el correo.

//También podríamos agregar simples verificaciones para saber si se envió:
if($exito){
   //$resultado = "El correo fue enviado correctamente, el mismo será respondido a la brevedad. <br> Muchas gracias por su consulta.";
   $return["error"] = false;
}else{
   //$resultado = "Hubo un inconveniente. Por favor, intentá nuevamente o escribrinos a nuestro email: <b> nyndecoratuvida@gmail.com  </b> <br> Muchas gracias por su consulta.";
   $return["error"] = true;
}
 
print json_encode($return);   
?>