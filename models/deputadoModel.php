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
 * Date: 28/10/13
 * Time: 16:13
 */

class deputadoModel  extends Model {


    public function __construct() {
        parent::__construct();
    }

    public function random( $size ){

        $dados = $this->_db->query("
            SELECT nome, nomeCompleto, ideCadastro, urlFoto FROM Deputado ORDER BY RAND(), nome LIMIT $size 
        ");        

        return $dados->fetchAll();
    }


    public function getAllDeputados() {

        $query = $this->_db->query("SELECT nome , nomeCompleto , ideCadastro, urlFoto from Deputado order by nome asc");
        return $query->fetchAll();


    }

    public function getDeputado($ideCadastro) {

        $query = $this->_db->query("SELECT * from Deputado where ideCadastro = $ideCadastro");
        return $query->fetchAll();


    }

    /**
    * @return Todos os discurso do deputado
    * @param $id O identificador do deputado
    */
    public function getDiscursos( $id ){

        $query = "
            SELECT Di.*
            FROM Discurso as Di
            WHERE Di.Deputado_id = $id
            ORDER BY Di.data DESC
        ";

        $dados = $this->_db->query( $query );
        return $dados->fetchAll();
    }

    /**
    * @return Todos os topicos (assuntos) que o deputado está relacionado
    * @param $id O indentificado do deputado
    */
    public function getTopicos( $id ){

        $query = "
            SELECT  DISTINCT( T.id ),
                    T.top_10_terms  
            FROM    Discurso as Di,
                    Discurso_has_Topico as DT,
                    Topico as T
            WHERE   Di.Deputado_id = $id
                    AND Di.id = DT.Discurso_id
                    AND DT.correlacao = 1
                    AND DT.Topico_id = T.id";

        $dados = $this->_db->query( $query );
        $dados = $dados->fetchAll();

        $output = array( "dados"=> $dados, "cloud"=> '');

        $filter = array('presidente', 'estado', 'deputado', 'sras', 'pode', 'tem', 'ser', 'srs','sra');

        $cloud = array();
        $total = array();
        foreach( $dados as $topico ){            
            $terms = explode( ' ', $topico['top_10_terms'] );
            for( $i = 0; $i < count( $terms ); $i++ )
                if( in_array( $terms[$i], $filter ) == 0 )
                    array_push( $total, $terms[ $i ] );
        }
        $cloud = array_count_values( $total );
        $output['cloud'] = $cloud;

        return $output;

        
    }



    /**
    * @return Todos os discurso do deputado e de um determinado tópico
    * @param $id O identificador do deputado
    * @param $idTopico O identificador do tópico
    */
    public function getDiscursosTopico( $id, $idTopico ){

        $query = "
            SELECT  Di.*
            FROM    Discurso as Di,
                    Discurso_has_Topico as DT
            WHERE   Di.Deputado_id = $id
                    AND Di.id = DT.Discurso_id
                    AND DT.Topico_id = $idTopico
                    AND DT.correlacao = 1
            ORDER BY Di.data DESC
        ";

        $dados = $this->_db->query( $query );
        return $dados->fetchAll();
    }
}

