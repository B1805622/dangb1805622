<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/OAuth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailerxacnhan{

    public function xacnhandon($tieude, $noidung, $maildathang)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        // print_r($mail);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output bat tinh nang gui mail thanh coong( neu khong show thi de 0)
            $mail->isSMTP();                                      // Set mailer to use SMTP 
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'lmhaidang2501@gmail.com';                 // SMTP username
            $mail->Password = 'ulkdbjipsxyhguib';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('lmhaidang2501@gmail.com', 'Dang FOOD');
            // $mail->addCC('lmhaidang2501@gmail.com');
            // $mail->addAddress('lmhaidang2501@gmail.com', 'Hai Dang');     // Add a recipient
            $mail->addAddress($maildathang);
            // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tieude;
            $mail->Body    = $noidung;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent'; // tin nhan da dc gui thanh cong
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo; //tin nhan gui that bai
        }
    }
}

class Mailer{
    
    public function dathangmail($tieude, $noidung, $maildathang){
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        // print_r($mail);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output bat tinh nang gui mail thanh coong( neu khong show thi de 0)
            $mail->isSMTP();                                      // Set mailer to use SMTP 
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'lmhaidang2501@gmail.com';                 // SMTP username
            $mail->Password = 'ulkdbjipsxyhguib';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('lmhaidang2501@gmail.com', 'Dang FOOD');
            // $mail->addCC('lmhaidang2501@gmail.com');
            // $mail->addAddress('lmhaidang2501@gmail.com', 'Hai Dang');     // Add a recipient
            $mail->addAddress($maildathang);
            // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tieude;
            $mail->Body    = $noidung;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent'; // tin nhan da dc gui thanh cong
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo; //tin nhan gui that bai
        }
    }
}
