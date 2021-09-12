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

    		return $this->$atributo;


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
    $mail->Host       = 'smtp.gmail.com';                     //informando nome do servidor smtp
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'webcurso31@gmail.com';                     //email que vai ser usado como base
    $mail->Password   = 'Europa40';                               //senha
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('webcurso31@gmail.com', 'Curso remetente');
    $mail->addAddress($mensagem->__get('para')); 



        //Add a recipient
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $mensagem->__get('assunto'); // assunto
    $mail->Body    = $mensagem->__get('mensagem'); //conteudo
    $mail->AltBody = 'E necessario usar um client que suporte html para ver o conteudo total dessa mensagem';

    $mail->send();
    echo 'E-mail enviado com sucesso';
} catch (Exception $e) {
    echo "Não foi possivel enviar este E-mail tente novamente mais tarde.<br> Detalhes do erro: {$mail->ErrorInfo}";
}











?>