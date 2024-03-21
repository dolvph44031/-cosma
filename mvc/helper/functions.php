<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $content)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'dolvph44031@fpt.edu.vn';                     //SMTP username
        $mail->Password   = 'Ledinh2003';                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('dolvph44031@fpt.edu.vn', 'COSMA');
        $mail->addAddress($to);     //Add a recipient
        //Content
        $mail->isHTML(true);                             //Set email format to HTML
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $content;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        return $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}






function redirect($url='index.php'){
    header('Location: '.$url);
    exit();
}

function view($file, $folder='client', $data=[]){

    extract($data);

    require _WEB_PATH_ROOT."/views/$folder/$file.php";

}

function layout($file, $folder='client', $data=[]){
    extract($data);
    require _WEB_PATH_ROOT."/public/$folder/layouts/$file.php";

}