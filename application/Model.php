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


	class Model{

		protected $_db;

		public function __construct(){
			$this->_db = new Database();
		}
        /**
         * Retorna uma string de inserção de dados no banco de dados
         *
         * @author Fernando Asevedo
         * @param $table Nome da tabela
         * @param $data Array contendo os dados a serem inseridos (chave = nome da coluna)
         */
        function _getInsert( $table_name, $data ){

            $query = "INSERT into ".$table_name;
            $column = "";
            $values = "";
            $first = true;
            foreach( $data as $c => $v ){
                if( $first ){
                    $first = false;
                }else{
                    $column.=", ";
                    $values.=", ";
                }

                $column.=$c;
                if( $v == NULL )
                    $values.="NULL";
                else
                    $values.="'". $v ."'";
            }

            return $query." (".$column.") VALUES (".$values.");";
        }

        /**
         * Retorna uma string de busca de dados no banco de dados
         *
         * @author Fernando Asevedo
         * @param $table Nome da tabela
         * @param $chave Um array contendo as chaves para busca
         */
        function _getSelect( $table_name, $chave ){

            $query = "SELECT * FROM ".$table_name. " WHERE ";
            $column = "";
            $values = "";
            $first = true;
            foreach( $chave as $c => $v ){
                if( $first )
                    $first = false;
                else
                    $query.=" AND ";

                $query.= $c."=". $v ;
            }

            return $query;
        }

        public function update(  $tabela, $chave, $update )
        {

            $query = "UPDATE $tabela";
            $set = "SET ";
            $where = "WHERE ";

            $first = true;
            foreach( $chave as $c => $v ){
                if( $first )
                    $first = false;
                else
                    $where.=" AND ";

                $where.= $c."=". $v;
            }
            $first = true;
            foreach( $update as $c => $v ){
                if( $first )
                    $first = false;
                else
                    $set.=", ";

                $set.= $c."='". $v ."'";
            }

            return $this->_db->exec( $query." ".$set." ".$where  );
        }


	}
 ?>
