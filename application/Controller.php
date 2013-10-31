<?php

/*
 * Copyright 2013 de Catalão/Thiago Faleiros, Cleriston Dantas, Fernando Nóbrega
 * Este arquivo é parte do programa TEMA. 
 * O TEMA é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos da
 * GNU General Public License como publicada pela Fundação do Software Livre (FSF); 
 * na versão 3 da Licença. Este programa é distribuído na esperança que possa
 * ser útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a licença para maiores detalhes. Você deve ter recebido uma cópia da
 * GNU General Public License, sob o título "LICENCA.txt",
 * junto com este programa, se não, acesse http://www.gnu.org/licenses
 **/

/*
 *====================================
 *	Autor: Cleriston Dantas
 *	Descrição: 
 *	terça, 19 de março de 2013
 *	Ccontroller.php
 *====================================
 */

abstract class Controller
{
	protected $_view;
	
	public function __construct(){
		$this->_view = new View(new Request);
	}	

	abstract public function index();

	protected function loadModel($modelo){
		$modelo = $modelo . 'Model';
		$rootModelo = ROOT . 'models' . DS . $modelo . '.php';

		if(is_readable($rootModelo)){
			require_once $rootModelo;
			$modelo = new  $modelo;
			return $modelo;
		}else{
			throw new Exception("Erro do modelo");
			
		}
	}

    protected function getLibrary($lib)
    {
        $rootLib = ROOT . 'libs' . DS . $lib . '.php';

        if(is_readable($rootLib)){
            require_once $rootLib;
        }
        else{
            throw new Exception('Erro de biblioteca');
        }
    }

    protected function getTexto($valor){
        if(isset($_POST[$valor]) && !empty($_POST[$valor])){
            $_POST[$valor] = htmlspecialchars($_POST[$valor], ENT_QUOTES);
            return $_POST[$valor];
        }
        return '';
    }

    protected function getInt($valor)
    {
        if(isset($_POST[$valor]) && !empty($_POST[$valor])){
            $_POST[$valor] = filter_input(INPUT_POST, $valor, FILTER_VALIDATE_INT);
            return $_POST[$valor];
        }

        return 0;
    }

    protected function redirecionar($root = false)
    {
        if($root){
            header('location:' . BASE_URL . $root);
            exit;
        }
        else{
            header('location:' . BASE_URL);
            exit;
        }
    }

    protected function filtrarInt($int){
        $int = (int) $int;

        if(is_int($int)){
            return $int;
        }else{
            return 0;
        }
    }

    protected function getPostParam($valor){
        if(isset($_POST[$valor])){
           return $_POST[$valor];
        }
    }

    protected function getSql($valor)
    {
        if(isset($_POST[$valor]) && !empty($_POST[$valor])){
            $_POST[$valor] = strip_tags($_POST[$valor]);

            if(!get_magic_quotes_gpc()){
                $_POST[$valor] = $_POST[$valor];
            }

            return trim($_POST[$valor]);
        }
    }

    protected function getAlphaNum($valor)
    {
        if(isset($_POST[$valor]) && !empty($_POST[$valor])){
            $_POST[$valor] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$valor]);
            return trim($_POST[$valor]);
        }

    }

    public function validarEmail($email)
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            return false;
        }

        return true;
    }
}
