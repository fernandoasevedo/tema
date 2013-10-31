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
 * User: Fernando Nóbrega
 * Date: 28/10/13
 * Time: 16:13
 * To change this template use File | Settings | File Templates.
 */

class deputadoController extends Controller{

    private $_deputado;


    public function __construct(){
        parent::__construct();
        $this->_deputado = $this->loadModel('deputado');

    }



    public function index()
    {

        $this->_view->assign('titulo','Hackathon - Deputado');
        $this->_view->setCss(array('index'));
        $this->_view->renderizar('index', 'deputado');

    }


    public function ide($ideCadastro, $idTopico){

        $this->_view->assign('titulo','Hackathon - Deputado');
        $this->_view->setCss(array('index'));

        //Obtém dados do determinado deputado do ideCadastro informado
        $deputado =$this->_deputado->getDeputado($ideCadastro);
        $this->_view->assign('deputado', $deputado);

        //Obtém todos os assuntos relacionados ao deputado
        $topicos =$this->_deputado->getTopicos( $deputado[ 0 ]['id'] );
        
        $this->_view->assign('topicos', $topicos['dados'] );        
        $this->_view->assign('cloud', $topicos['cloud'] );

        
        if($idTopico!="__"){
            //Obtém todos os discursos do deputado de um determinado tópico
            $topicoSelecionado = '';
            foreach( $topicos['dados'] as $topico ){
                if( $topico['id'] == $idTopico ){
                    $topicoSelecionado = $topico['top_10_terms'];
                    break;
                }
            }

            $this->_view->assign('topicoSelecionado', $topicoSelecionado );
            $discursos =$this->_deputado->getDiscursosTopico( $deputado[ 0 ]['id'], $idTopico );

        }else{
            //Obtém todos os discursos do deputado
            $discursos =$this->_deputado->getDiscursos( $deputado[ 0 ]['id'] );
        }

        $this->_view->assign('discursos', $discursos);

        $this->_view->renderizar('index', 'deputado');

    }



}
