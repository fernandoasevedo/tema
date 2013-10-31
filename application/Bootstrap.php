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
 *	Bootstrap.php
 *====================================
 */
class Bootstrap
 {
 	public static function run(Request $requisicao)
 	{
 		$controller = $requisicao->getControlador() . 'Controller';
 		$rootControlador = ROOT . 'controllers'. DS . $controller . '.php';
 		$metodo = $requisicao->getMetodo();
 		$args = $requisicao->getArgs();

//Verifica se arquivos da raiz existem e se são válidos
 		if(is_readable($rootControlador))
 		{
 			require_once $rootControlador;
 			$controller = new $controller;

 			if(is_callable(array($controller, $metodo)))
 			{
 				$metodo = $requisicao->getMetodo();
 			}else{
 				$metodo = 'index';
 			}

 			if(isset($args))
 			{
 				call_user_func_array(array($controller, $metodo), $args);
 			}else{
 				call_user_func(array($controller, $metodo));
 			}
 		}else{
 			throw new Exception("Não encontrado");
 			
 		}

 	}
 }
