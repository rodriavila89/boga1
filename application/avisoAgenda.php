<?php

    define ('__HOST','localhost');
    define ('__DB_USER','root');
    define ('__DB_PASS','root');
    define ('__BASE_DATOS','litigar');  

     error_reporting(E_ALL);
    //require();
    require 'phpmailer/class.phpmailer.php';
    //require('phpmailer/')
    $sql = "select * from agenda 
            where aviso = 1 
            and hora_aviso >= NOW()
            and hora_aviso < DATE_ADD( now(), INTERVAL 1 Minute )";
     
    $base = new PDO('mysql:host='.__HOST.';dbname='.__BASE_DATOS.'', __DB_USER, __DB_PASS);
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $base->prepare('SELECT * FROM agenda');
    $sql->execute();
    $resultado = $sql->fetchAll();
    foreach ($resultado as $row) {
        echo $row["id"];
    }
    
    // CUENTA DE info@litigaronline.com en GOOGLE
    define ('CUENTA_INFO_FROM_NAME', 'Litigaronline');
    define ('CUENTA_INFO_FROM', 'info@litigaronline.com');
    define ('CUENTA_INFO_HOST', 'ssl://smtp.gmail.com');
    define ('CUENTA_INFO_PUERTO', 465);
    define ('CUENTA_INFO_USUARIO', 'info@litigaronline.com');
    define ('CUENTA_INFO_PASSWORD', 'pipo120');                
                    
    //GMAIL_LOGIN = 'newsletter_3@litigaronline.com'
    //GMAIL_PASSWORD = 'pipo12345'
                    
        
	 	function enviar_mail_info($email,$asunto=null,$cuerpo=null){

    	    $mail = new PHPMailer();  
    	    $mail-> From = CUENTA_INFO_FROM;
    	    $mail-> FromName = CUENTA_INFO_FROM_NAME;
    	    $mail->IsSMTP();
    	    $mail->Host = CUENTA_INFO_HOST;
    	    $mail->Port = CUENTA_INFO_PUERTO;
    	    $mail->SMTPAuth = true;
    	    $mail->SMTPSecure = "ssl";
    	    $mail->Username = CUENTA_INFO_USUARIO;
    	    $mail->Password = CUENTA_INFO_PASSWORD;
    	    if ($asunto == null){
    	    	$mail->Subject = "Aviso de agenda";
    	    }else{
    				$mail->Subject = $asunto;
    			}	
    			$mail->AddAddress($email);
    	    $mail->IsHTML (true);
    	    $body = CORREO_CABECERA;
    	    $body .=  $cuerpo;
    	    $body .= " <br /><br />";
    	    $body .= CORREO_PIE;
    	    $mail->Body = $body;
    
    			if(!$mail->Send()){
    			        return 'No se ha podido envir el correo '. $mail->ErrorInfo;
    			}
    			else {
    			       return 'Se ha enviado el correo';
    			}
   }
?>