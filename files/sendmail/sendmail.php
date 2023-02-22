<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('en', 'phpmailer/language/');
	$mail->IsHTML(true);

	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = '';                     //SMTP username
	$mail->Password   = '';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	

		//От кого письмо
		$mail->setFrom('', 'revenue mates'); // Указать нужный E-mail
		//Кому отправить
		$mail->addAddress(''); // Указать нужный E-mail
		//Тема письма
		$mail->Subject = 'Revenue Mates - new client';
	
		//Тело письма
		$theme .= 'new client';
		
		$body = 'Info:';
		
		if (trim(!empty($_POST['name']))) {
			$Name .= '<strong>Name:</strong> ' . $_POST['name']; // Встив свої назви полів
		}
		if (trim(!empty($_POST['femail']))) {
			$Email .= '<strong>Email:</strong> ' . $_POST['femail']; // Встив свої назви полів
		}
	
		if (trim(!empty($_POST['fphone']))) {
			$Tel .= '<strong>Phone:</strong> ' . $_POST['fphone']; // Встив свої назви полів
		}
		if (trim(!empty($_POST['ftextarea']))) {
			$Mes .= '<strong>Message:</strong> ' . $_POST['ftextarea']; // Встив свої назви полів
		}
	
		$mail->msgHTML("<html><body>
			<h1>$body</h1>
			<p>$Name</p>
			<p>$Tel</p>
			<p>$Email</p>
			<p>$Mes</p>
			</html></body>");
	
		//Отправляем
		if (!$mail->send()) {
			$message = 'Помилка';
		}else {
			$message = 'Данні відправленні!';
		}
	
		$response = ['message' => $message];
	
		header('Content-type: application/json');
		echo json_encode($response);
	?>