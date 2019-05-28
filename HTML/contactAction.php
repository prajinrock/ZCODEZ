<?php



if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    $secret = '6Lf6K34UAAAAAIT8LO2RMheSvO8atXah_rGuj7IQ';

    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);

    $responseData = json_decode($verifyResponse);



    if ($responseData->success) {

        require 'PHPMailer/PHPMailerAutoload.php';



        $name = isset($_POST['name']) ? $_POST['name'] : "";

        $subject = isset($_POST['subject']) ? $_POST['subject'] : "";

        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";

        $email = isset($_POST['email']) ? $_POST['email'] : "";

        $message = isset($_POST['message']) ? $_POST['message'] : "";



        $mail = new PHPMailer;

        $mail->SMTPDebug = 3;                               // Enable verbose debug output

//We have received the details submitted. Our customer care representative will contact you soon.



        $mail->setFrom('noreply@ui2k.com', $name);

//        $mail->addAddress('musafar@codeatech.com');

//        $mail->addCc('noushad@codeatech.com');

        $mail->addAddress('prajinrock@gmail.com');

        $mail->addReplyTo($email, $name);



        $mail->isHTML(true);                                  // Set email format to HTML



        $mail->Subject = $subject;

        $mail->Body = "Hello, you have received an enquiry from luminallc.com. Check out the details below.<br><br>"

            . "Name: " . $name . "<br>"

            . "Phone: " . $phone . "<br>"

            . "Email: " . $email . "<br><br>"

            . "Message: " . $message;

//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



        if (!$mail->send()) {

            echo '<br>Message could not be sent.<br>';

            echo 'Mailer Error: ' . $mail->ErrorInfo;

        } else {

            echo 'Message has been sent.';

        }

    } else {

//        Verification failed.

    }

} else {

//    Captcha not clicked.

}



$url = "success.html";

echo '<script type="text/javascript">';

echo 'window.location.href="' . $url . '";';

echo '</script>';

exit;

