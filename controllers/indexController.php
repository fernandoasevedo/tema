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
 *	indexController.php
 *====================================
 */

class indexController extends Controller
{

	public function __construct(){
		parent::__construct();
    
        $this->_deputados = $this->loadModel('deputado');
        $this->_topicos = $this->loadModel('topico');
        $this->_index = $this->loadModel('index');


	}

    public function index()
    {
        $this->_view->assign('titulo','Hackathon - Início');
        $this->_view->setCss(array('index'));

        $deputados =$this->_deputados->getAllDeputados();
        $this->_view->assign('deputados', $deputados);

        $deputadosRandom = $this->_deputados->random( 10 );
        $this->_view->assign('deputadosRandom', $deputadosRandom );


        if( $this->getInt('send') ){
            $search = $this->getPostParam('search');
            
            $topicos = $this->_topicos->getTopicosCom( $search );
            $this->_view->assign('topicos', $topicos );
        }
        $this->_view->renderizar('index', 'inicio');

    }


}
