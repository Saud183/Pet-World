<?php

include('connection.php');

// if user has already registered then take user to account page
if(isset($_SESSION['logged_in']) ){

    header('location: account.php');
    exit;
 
 }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$reset_token){

    // include php mailer required files

    $mail = new PHPMailer(true);


    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = //Your email address;                     //SMTP username
        $mail->Password   = //Password of the email address;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom(//email id, //Name);

        $mail->addAddress($email);     //Add a recipient
       
        $mail->addReplyTo(//email id, //Name);
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link from Pet World';

        $mail->Body    = "We have recieved a password reset request from you. <br>
        Use the below link to reset the password <br>
        <a href='http://localhost:8000/update_password.php?email=$email&reset_token=$reset_token'> Click Here </a> <br> <br>
        The above link will be valid for a day";

    
        $mail->send();
        
        return true;

    } catch (Exception $e) {
        return false;
    }


}

if(isset($_POST['send_btn'])){

    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param('s',$email);

    if($stmt->execute()){

        $stmt->bind_result($user_id,$user_name,$user_email,$user_password,$user_reset_token,$user_reset_token_expiry);
        $stmt->store_result();

        if($stmt->num_rows() == 1){

            $reset_token = bin2hex(random_bytes(16));

            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');

            $email = $_POST['email'];

            $stmt1 = $conn->prepare("UPDATE users SET user_reset_token=?, user_reset_token_expiry=? WHERE user_email=?");
            $stmt1->bind_param('sss',$reset_token,$date,$email);

            if($stmt1->execute() && sendMail($email,$reset_token)){

                header('location: ../login.php?message=Email has been sent to the email address');


            }else{

                header('location: ../forgot_password.php?error=Server Down, please try again later');
            }



        }else if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
            
            header('location: ../forgot_password.php?error=Please enter a valid Email');
            
        }else{

            header('location: ../forgot_password.php?error=Email not registered');
        }

    }else{

        header('location: ../forgot_password.php?error=Server Down, please try again later');

    }

}else{

    header('location: ../login.php');

}

?>