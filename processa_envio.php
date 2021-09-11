<?php

   

    // IMPORTANDO AS CLASSES

    require './bibliotecas/PHPMailer/Exception.php';
    require './bibliotecas/PHPMailer/OAuth.php';
    require './bibliotecas/PHPMailer/PHPMailer.php';
    require './bibliotecas/PHPMailer/POP3.php';
    require './bibliotecas/PHPMailer/SMTP.php';

     //FAZENDO REFERENCIA AOS NAMESPACES
     
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;




    
    class Mensagem{

    	public $para = null;
    	public $assunto = null;
    	public $mensagem = null;

    	public function __get($atributo){

    		return $this->atributo;

    	}



    	public function __set($atributo,$valor){

    		$this->$atributo = $valor;

    	}

        
    	public function mensagemValida(){
          
          if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){

          	return false;
          	
          }

          return true;
    		
    	}


    }

    // criando um objeto com base na classe mensagem

    $mensagem = new Mensagem();

    // preenchendo os atributos usando o metodo set 

    $mensagem -> __set('para',$_POST['para']);
    $mensagem -> __set('assunto',$_POST['assunto']);
    $mensagem -> __set('mensagem',$_POST['mensagem']);

    if (!$mensagem-> mensagemValida()) {
    	echo "Mensagem não é valida";
    	die();
    }



//Criando uma instancia da classe PHPMailler e atribuindo 'true 'para ativar as opçoes dela


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Não foi possivel enviar este E-mail tente novamnte mais tarde.<br> Detalhes do erro: {$mail->ErrorInfo}";
}









?>