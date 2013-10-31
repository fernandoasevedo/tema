<?php
/**
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

/**
 * User: Cleriston Dantas
 * Date: 03/04/13
 * Time: 09:03
 */
ini_set('display_errors', 1);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
try{
require_once APP_PATH . 'Config.php';
require_once APP_PATH . 'Request.php';
require_once APP_PATH . 'Bootstrap.php';
require_once APP_PATH . 'Controller.php';
require_once APP_PATH . 'Model.php';
require_once APP_PATH . 'View.php';
require_once APP_PATH . 'Registro.php';
require_once APP_PATH . 'Database.php';
require_once APP_PATH . 'Session.php';
require_once APP_PATH . 'Hash.php';
    Session::init();
    Bootstrap::run(new Request);
}
catch(Exception $e){
    echo $e->getMessage();
}
