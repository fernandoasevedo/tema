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



require_once ROOT . 'libs' . DS . 'smarty' . DS . 'libs' . DS . 'Smarty.class.php';



class View extends Smarty{
	private $_controlador;
    private $_js;
    private $_css;

	public function __construct(Request $requisicao){
        parent::__construct();
		$this->_controlador = $requisicao->getControlador();
        $this->_js = array();
        $this->_css = array();
	}

	public function renderizar($vista, $item = false){

        $this->template_dir = ROOT . 'views'. DS . 'layout' . DS.  DEFAULT_LAYOUT . DS;
        $this->config_dir = ROOT . 'views' . DS . 'layout' . DS. DEFAULT_LAYOUT . DS . 'configs';
        $this->cache_dir = ROOT . 'tmp' . DS . 'cache' . DS;
        $this->compile_dir = ROOT . 'tmp' . DS . 'template'. DS;



                $menu[]=array(
                    'id' => 'home',
                    'titulo' => 'Início',
                    'base' => BASE_URL.'index',
                );

                $menu[]=array(
                    'id' => 'sobre',
                    'titulo' => 'Sobre',
                    'base' => BASE_URL.'sobre',
                );


            if(Session::get('liberado')=='1'){
            }


            if(Session::get('autenticacao')){


            }



        $js = array();

        if(count($this->_js)){
            $js = $this->_js;
        }

        $css = array();
        if(count($this->_css)){
            $css = $this->_css;
        }

		$_params = array(
			'root_css' =>BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
			'root_img' =>BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
			'root_js' =>BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
			'menu' => $menu,
            'item' => $item,
            'js'=>$js,
            'css'=>$css,
            'root' => BASE_URL,
            'configs'=>array(
                'app_name' => APP_NAME,
                'app_slogan' => APP_SLOGAN,
                'app_company' => APP_COMPANY
            ));

		$rootView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.tpl';
			
		if(is_readable($rootView)){
		    $this->assign('_content', $rootView);
		}else{
			throw new Exception("Erro no View");
		}

        $this->assign("_layoutParams", $_params);
        $this->display('template.tpl');


	}
    public function setJs(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }

    public function Js(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0; $i < count($js); $i++){
                $this->_js[] = BASE_URL . 'public/js/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }

    public function Css(array $css)
    {
        if(is_array($css) && count($css)){
            for($i=0; $i < count($css); $i++){
                $this->_css[] = BASE_URL . 'public/css/' . $css[$i] . '.css';
            }
        } else {
            throw new Exception('Error de css');
        }
    }

    public function setCss(array $css)
    {
        if(is_array($css) && count($css)){
            for($i=0; $i < count($css); $i++){
                $this->_css[] = BASE_URL . 'views/' . $this->_controlador . '/css/' . $css[$i] . '.css';
            }
        } else {
            throw new Exception('Error de css');
        }
    }
}
