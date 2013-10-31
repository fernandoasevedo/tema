<?php

/*
 * Copyright 2013 de Catalão/Thiago Faleiros, Cleriston Dantas, Fernando Nóbrega
 * Este arquivo é parte do programa TEMA. 
 * O TEMA é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos da
 * GNU General Public License como publicada pela Fundação do Software Livre (FSF); 
 * na versão 3 da Licença. Este programa é distribuído na esperança que possa
 * ser útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a licença para maiores detalhes. 
 * Você deve ter recebido uma cópia da
 * GNU General Public License, sob o título "LICENCA.txt",
 * junto com este programa, se não, acesse http://www.gnu.org/licenses
 **/


/*
 *====================================
 *	Autor: Cleriston Dantas
 *	Descrição: 
 *	terça, 19 de março de 2013
 *	Request.php
 *====================================
 */

class Request
{
	private $_controlador;
	private $_metodo;
	private $_argumentos;

	public function __construct()
	{
		if(isset($_GET['url']))
		{
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);
		
			$this->_controlador = strtolower(array_shift($url));
			$this->_metodo = strtolower(array_shift($url));
			$this->_argumentos = $url;
		}
		if(!$this->_controlador)
		{
			$this->_controlador = DEFAULT_CONTROLLER;
		}
		
		if(!$this->_metodo)
		{
			$this->_metodo = 'index';
		}

		if(!isset($this->_argumentos))
		{
			$this->_argumentos = array();
		}
	}

	public function getControlador()
	{
		return $this->_controlador;
	}

	public function getMetodo()
	{
		return $this->_metodo;
	}

	public function getArgs()
	{
		return $this->_argumentos;
	}

}
