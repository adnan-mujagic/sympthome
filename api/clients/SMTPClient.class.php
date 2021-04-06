
<?php
require_once dirname(__FILE__)."/../../vendor/autoload.php";
require_once dirname(__FILE__)."/../config.php";

class SMTPClient{
  private $mailer;
  public function __construct(){
    $transport = (new Swift_SmtpTransport(Config::SMTP(), Config::SMTP_PORT(), 'tls'))->setUsername(Config::SMTP_USERNAME())->setPassword(Config::SMTP_PASSWORD());
    $this->mailer = new Swift_Mailer($transport);

  }

  public function send_confirmation_email($user){
    // Create a message
    $message = (new Swift_Message('Activate Your Account'))
      ->setFrom(['adnanmujagic@outlook.com' => 'Sympthome'])
      ->setTo([$user["email"]=>$user["first_name"]])
      ->setBody('Hello, '.$user["first_name"].", please visit this link to activate your account: http://localhost:8080/api/confirm/".$user["token"]);

    $result = $this->mailer->send($message);
    return $result;
  }

  public function send_activation_successful_email($user){
      $message = (new Swift_Message('Account Activated Succesfully'))
    ->setFrom(['adnanmujagic@outlook.com' => 'Sympthome'])
    ->setTo([$user["email"] => $user["first_name"]])
    ->setBody('Hello '.$user["first_name"].", it is our pleasure to say that your account has been successfully activated. ")
    ;
    $result = $this->mailer->send($message);
    return $result;
  }


  public function send_passowrd_recovery_token_email($user){
    // Create a message
    $message = (new Swift_Message('Reset Your Password'))
      ->setFrom(['adnanmujagic@outlook.com' => 'Sympthome'])
      ->setTo([$user["email"]=>$user["first_name"]])
      ->setBody('Hello, '.$user["first_name"].", please visit this token to reset the password: ".$user["token"]." .Your token will expire in five minutes, so make sure you do it quickly!");

    $result = $this->mailer->send($message);
    return $result;
  }
}
 ?>
