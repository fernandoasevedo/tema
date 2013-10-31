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


/**
 * User: Cleriston Dantas
 * Date: 28/03/13
 * Time: 21:57
 * To change this template use File | Settings | File Templates.
 */

class Session
{
    public static function init()
    {
        session_start();
    }

    public static function destroy($chave =false)
    {

        if($chave){
            if(is_array($chave)){
                for($i = 0; $i < count($chave); $i++){
                    if(isset($_SESSION[$chave[$i]])){
                        unset($_SESSION[$chave[$i]]);
                    }
                }
            }else{
                if(isset($_SESSION[$chave])){
                    unset($_SESSION[$chave]);
                }
            }
        }else{
            session_destroy();
        }
    }

    public static function set($chave, $valor)
    {

        if(!empty($chave))
        $_SESSION[$chave] = $valor;
    }

    public static function get($chave)
    {
        if(isset($_SESSION[$chave]))
            return $_SESSION[$chave];
    }

    public static function acesso($level)
    {

        if(!Session::get('autenticacao')){
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }

    }

    public static function acessoView($level)
    {
        if(!Session::get('autenticacao')){
            return false;
        }

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){
            return false;
        }
        return true;
    }

    public static function getLevel($level)
    {

        $nivel['admin'] = 3;
        $nivel['sigmei'] = 2;
        $nivel['outro'] = 1;

        if(!array_key_exists($level, $nivel)){
            throw new Exception('Erro no acesso');
        }else{
            return $nivel[$level];
        }
    }

    public static function acessoGrupos(array $level, $noAdmin = false)
    {
        if(!Session::get('autenticacao')){
            header('location:' . BASE_URL . 'error/access/5050');
            exit;
        }

        if($noAdmin == false){
            if(Session::get('level') == 'admin'){
                return;
            }
        }
        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return;
            }
        }
        header('location:' . BASE_URL . 'error/access/5050');
    }

    public static function acessoViewGrupo(array $level, $noAdmin = false)
    {
        if(!Session::get('autenticacao')){
            return false;
        }

        if($noAdmin == false){
            if(Session::get('level') == 'admin'){
                return true;
            }
        }
        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return true;
            }
        }
        return false;
    }
}
