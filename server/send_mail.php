

<?php

if(isset($_POST['contact-send'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
        header('location: ../contact.php?error=Enter a valid email');
    
    }else{

        ini_set("sendmail_from",$email);

        $to = "saudqureshi183@gmail.com";

        $headers =  'MIME-Version: 1.0' . "\r\n"; 
        $headers .= //email id . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        /* $headers = "From".$email; */

        $body = "";

        $body .= "From :". $name. "\r\n";
        $body .= "Email: :". $email. "\r\n";
        $body .= "Message :". $message. "\r\n";

        if(mail($to,$subject,$body,$headers)){

            header('location: ../contact.php?mail_success=We will contact you back shortly');
        }/* else{

            header('location: ../contact.php?mail_failed=Error occured, please try again');
        } */

    }
}else{

    header('location: contact.php');
}


?>