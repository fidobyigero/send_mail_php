<!--@author Fidele -->


<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'C:\xampp\htdocs\mailer\vendor\autoload.php';

    //Grab data and send..
    if (isset($_POST['subject']) && isset($_POST['message']) && isset($_POST['receiver'])) {
    	$subject = $_POST['subject'];
        $message = $_POST['message'];
        $receiver = $_POST['receiver'];
        $mailer = new Sender($subject,$message,$receiver);
        $mailer -> send();
	}

	//Sender class definition
   class Sender {
	   var $sub;
	   var $msg;
	   var $to;

	   public function Sender($subject,$message,$receiver){
		   $this->sub = $subject;
		   $this->msg = $message;
		   $this->to = $receiver;
	   }

	   public function send(){
			try {
			//Initialize PHPMailer and set SMTP protocol
				$mail = new PHPMailer(TRUE);
				$mail->isSMTP();
				//$mail->SMTPDebug = 1;//to allow debugging
				$mail->SMTPAuth = TRUE;
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;
				$mail->Host = 'smtp.gmail.com';
				$mail->Username = 'sender@gmail.com';
				$mail->Password = 'sender-password';//Allow Less secure apps in Gmail for for GSMTP to work!

	      //Set Email requirements, header and body
	         $mail->IsHTML(true);
	         $mail->setFrom($mail->Username, $mail->Username);
	         $mail->addAddress($this->to, $this->to);
	         $mail->Subject = $this->sub;
	         $mail->Body = $this->msg;

	      //Send the Email and catch eexceptions
	         if($mail->send()){
	            echo('Email successfully sent!');
	         }
	      } catch (Exception $e) {
	         echo 'LocalException: '.$e->errorMessage();
	      }
      }
   }

?>
