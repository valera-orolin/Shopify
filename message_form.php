<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$message = preg_replace("/ {2,}/", ' ', $message);
$message = preg_replace("/[.] /", ".<br> ", $message);
$message = preg_replace("/[?] /", "?<br> ", $message);
$message = preg_replace("/[!] /", "!<br> ", $message);
trim($message);

function isAbbr($word) {
    return preg_match('/^[A-Z|А-ЯЁ]{2,}$/u', $word);
}
function isNumber($word) {
    return preg_match('/^[0-9]{2,}$/', $word);
}

$words = explode(" ", $message);
echo "<p>";
echo "Имя: $name<br/>Email: $email<br/>Message:<br/>";
foreach ($words as $word) {
    if (isAbbr($word)) echo "<u>$word</u> ";
    else if (isNumber($word)) echo "<font color='blue'>$word </font>";
    else echo "$word ";
}

/***/

include 'password.php';
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "valera.orolin@gmail.com";
$mail->Password   = password\p::$password;

$mail->IsHTML(true);
$mail->AddAddress("$email", "User");
$mail->SetFrom("valera.orolin@gmail.com", "Shopify");
$mail->AddReplyTo("valera.orolin@gmail.com", "Shopify");
//$mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
$mail->Subject = "Shopify";
$content = "<b>Thank you for your feedback, $name!</b>";

$mail->MsgHTML($content);
$mail->Send();
/*
if(!$mail->Send()) {
  echo "Error while sending Email.";
  //var_dump($mail);
} else {
  echo "Email sent successfully";
}
*/
echo "</p>";
header('location: ' . $_SERVER['HTTP_REFERER']);