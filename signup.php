<?php 
	include("includes/functions.php");
?>
<?php
	global $error_in_name,$error_in_email,$error_in_mobile;
	
		$fname = mysql_entities_fix_string($_POST['fname']);
		//$lname = mysqli_real_escape_string($connection,(mysql_entities_fix_string($_POST['lname'])));
		$email = mysql_entities_fix_string($_POST['email']);
		$mobile = mysql_entities_fix_string($_POST['mobile']);
		$message = mysql_entities_fix_string($_POST['message']);

		$validation_of_fname=valid_name($fname);
		//$validation_of_lname=valid_name($lname);
		$validation_of_email=valid_email($email);
		$validation_of_mobile=valid_mobile($mobile);
		$check=0;
		if($validation_of_fname==1 && $validation_of_email==1 && $validation_of_mobile==1)
		{
			$check=1;
		}
		else
		{
			$check=0;
		}
		if ($check==1) 
		{
				require 'PHPMailer-master/PHPMailerAutoload.php';
	 
				$mail = new PHPMailer;
				 
				$mail->isSMTP();                                      
				$mail->Host = 'smtp.gmail.com';                       
				$mail->SMTPAuth = true;                               
				$mail->Username = 'codecraft2k15@gmail.com';                   
				$mail->Password = 'saappp2015';               
				$mail->SMTPSecure = 'tls';                            
				$mail->Port = 587;                                    
				$mail->setFrom('codecraft2k15@gmail.com', 'CODE CRAFT');
				$mail->addAddress("codecraft2k15@gmail.com");       
				$mail->WordWrap = 50; 
				$mail->isHTML(true);                                  
				 
				$mail->Subject = 'A Response received.';
				$mail->Body    = "Hello from".$fname." ".$email." ".$mobile.".The message is  $message";
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';	

				if(!$mail->send()) {
				   echo 'Message could not be sent.';
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				   exit;
				}
				else
				{
					echo "Thank you for your response";
				}
			}	
		else
			echo "$validation_of_email $validation_of_mobile";

?>
