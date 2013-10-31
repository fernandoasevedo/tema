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

class topicoController extends Controller{

    public function __construct(){
        parent::__construct();


        $this->_topicos = $this->loadModel('topico');
        $this->_bing = $this->loadModel('bing');

    }

    public function index()
    {

        $id = 1;

        $this->_view->assign('titulo','Hackathon - Tópico');
        $this->_view->setCss(array('index'));

        $grafico = $this->_topicos->getGraphic( $id );


        $this->_view->assign('graficotitulo', $grafico['topico']);

        $frequencia = json_encode( $grafico['freq']);
        $this->_view->assign('topicos', $frequencia );

        $meses = json_encode( $grafico['mes'] );
        $this->_view->assign('meses', $meses );

        $deputadosRelacionados = $this->_topicos->getDeputadosRelacionados( $id );
        $this->_view->assign('deputados', $deputadosRelacionados );

        /* Pegando os discursos relacionados ao tópico */
        $discursos = $this->_topicos->getDiscursosRelacionados( $id );
        $this->_view->assign('discursos', $discursos );


        //$noticias = $this->_bing->search( $grafico['topico'] );

        //$this->_view->assign('noticias', $noticias );

        $this->_view->renderizar('index', 'topico');

    }

    public function id($idTopico){

        $this->_view->assign('titulo','Hackathon - Tópico');
        $this->_view->setCss(array('index'));

        $grafico = $this->_topicos->getGraphic( $idTopico );


        $this->_view->assign('graficotitulo', $grafico['topico']);

        $frequencia = json_encode( $grafico['freq']);
        $this->_view->assign('topicos', $frequencia );

        $meses = json_encode( $grafico['mes'] );
        $this->_view->assign('meses', $meses );

        /* Carregando os deputados que discursaram nesse tema */
        $deputadosRelacionados = $this->_topicos->getDeputadosRelacionados( $idTopico );
        $this->_view->assign('deputados', $deputadosRelacionados );

        /* Pegando os discursos relacionados ao tópico */
        $discursos = $this->_topicos->getDiscursosRelacionados( $idTopico );
        $this->_view->assign('discursos', $discursos );

        /* Listando as notícias relacionadas por meio do Bing */
        $noticias = $this->_bing->search( $grafico['topico'] );
        $this->_view->assign('noticias', $noticias );

        $this->_view->renderizar('index', 'topico');

    }


}
