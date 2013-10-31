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
 * User: Fernando Asevedo
 * Date: 28/10/13
 * Time: 16:13
 */

class topicoModel extends Model {


    public function __construct() {
        parent::__construct();
    }


    /**
    * Retorna todos so tópicos em ordem randômica
    */
    public function all(){

        $dados = $this->_db->query("
            SELECT * FROM Topico ORDER BY RAND()
        ");        

        return $dados->fetchAll();
    }

    /**
    * Retorna os dados para a construção do gráfico de análise de tópico
    * @param $id O id de tópico a ser analisado
    * @author Fernando Asevedo
    */
    public function getGraphic( $id ){
        
        $output = array(
            'topico' => '',
            'freq' => array(),
            'mes' => array()
        );


        $query = "SELECT * FROM Topico WHERE id=$id";
        $dados = $this->_db->query( $query );
        $dados = $dados->fetchAll();
        $output['topico'] = $dados[ 0 ]['top_10_terms'];

        $query = "
            SELECT  COUNT(D.id) AS freq,
                    MONTH(D.data) AS mes,
                    YEAR(D.data) as ano
            FROM    Discurso D inner join Discurso_has_Topico DT on D.id = DT.Discurso_id 
            WHERE   DT.Topico_id = $id and DT.correlacao = 1
            GROUP BY YEAR(D.data), MONTH(D.data)            
            ORDER BY data ";

        $dados = $this->_db->query( $query );
        $meses = array('','jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez');

        $months = array( 'month' => 0, 'year' => -1 );

        foreach( $dados->fetchAll() as $frequencia ){
            
            // Apenas para pegar o primeiro ano retornado na busca
            if( $months['year'] == -1 ){
                $months['year'] = (int) $frequencia['ano'];
            }
            
            $months = $this->nextMes( $months );
            
            while( $months['month']  != (int) $frequencia['mes'] ){

                array_push( $output['freq'], (int) 0 );
                $new_year = (string)$months['year'];
                $new_year = $new_year[ 2 ].$new_year[ 3 ];
                array_push( $output['mes'], $meses[ $months['month'] ] .'-'. $new_year);

                $months = $this->nextMes( $months );

            }
            
            $month = (int) $frequencia['mes'];
            $year = (int) $frequencia['ano'];


            array_push( $output['freq'], (int) $frequencia['freq'] );
            array_push( $output['mes'], $meses[ $frequencia['mes'] ] .'-'. $frequencia['ano'][2].$frequencia['ano'][3] );

        }


        return $output;
    }


    /**
    * Função usada para calcular a próxima data a partidar de um mês e ano
    * @param $months Um array contendo o mês e ano atual
    */
    public function nextMes( $months ){

        $next = array('month' => 1, 'year' => $months['year'] );

        $next['month'] = ($months['month'] + 1);

        if( $next['month'] == 13 ){
            $next['month'] = 1;            
            $next['year'] = $next['year'] + 1;
        }

        return $next;
    }



    /**
    * Retorna os deputados realacionados ao tópico
    * @param $id O id do tópico a ser analisado
    */
    public function getDeputadosRelacionados( $id ){

        $query = "
            SELECT  Dep.nome, 
                    Dep.ideCadastro,
                    count(Dep.id) AS freq,
                    Dep.urlFoto,
                    Dep.uf,
                    Dep.partido,
                    Dep.condicao
            FROM    Deputado Dep INNER JOIN Discurso D on Dep.id = D.Deputado_id 
                    INNER JOIN Discurso_has_Topico DT on D.id = DT.Discurso_id 
            WHERE   DT.Topico_id = $id and DT.correlacao = 1
            GROUP BY (Dep.id)
            ORDER BY COUNT(Dep.id) DESC";

        $dados = $this->_db->query( $query );
        return $dados->fetchAll();
        
    }


    /**
     * Retorna todos os discursos relacionados ao tópico selecioando
     * @param @id O número de identificação do tópioco selecionado
     */
    public function getDiscursosRelacionados( $id ){

        $query = "
            SELECT D.*
            FROM	Discurso_has_Topico as DT,
                    Discurso as D
            WHERE	D.id = DT.Discurso_id
                    AND DT.Topico_id = $id
                    AND DT.correlacao = 1";

        $dados = $this->_db->query( $query );
        return $dados->fetchAll();        
    }


    /**
    * @return Topicos relacionados à busca (uma ou mais palavras)
    * @para $search Uma string de busca
    */
    public function getTopicosCom( $search ){

        $query = "
            SELECT *
            FROM Topico
            WHERE top_10_terms LIKE '%$search%'
        ";
        $dados = $this->_db->query( $query );
        return $dados->fetchAll();       
    }
}
