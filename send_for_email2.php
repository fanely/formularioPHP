<?php
if(isset($_POST['email'])) {
//saber ip y $pais
//error_reporting(E_ALL & ~E_NOTICE);
//if(empty($_POST['checkip'])){
  $ippais = $_SERVER["REMOTE_ADDR"];
//}else{
//  $ippais = $_POST['checkip'];
//}
//    $pais = (getCountryFromIP($ippais,"NamE"));
//echo 'ip es = '.$ippais;
//echo '<br> y su pais es'.$pais;

    // correos requeridos
    $email_to = "webmaster@improfoods.com";
    $email_subject = "Formulario de la pagina improfoods.com";


    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted.";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }


    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    $comments = $_POST['comments']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }

  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Form details below.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Apellidos: ".clean_string($last_name)."\n";
    $email_message .= "E-mail: ".clean_string($email_from)."\n";
    $email_message .= "Telefono: ".clean_string($telephone)."\n";
    $email_message .= "Comentarios: ".clean_string($comments)."\n";
    $email_message .= "IP: ".clean_string($ippais)."\n";
  //  $email_message .= "Pais: ".clean_string($pais)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

?>
Gracias por contactarnos, pronto te responderemos.

<!-- include your own success html here -->


<?php

}
 header( "refresh:5;url=index.html" );

?>
