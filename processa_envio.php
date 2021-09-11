<?php

    
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

    if ($mensagem-> mensagemValida()) {
    	
    	echo "Mensagem é valida";

    }else{

    	echo "Mensagem não é valida";
    }






?>