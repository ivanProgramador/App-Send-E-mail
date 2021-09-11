<?php

    print_r($_POST);

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

    		//
    	}
    }




?>