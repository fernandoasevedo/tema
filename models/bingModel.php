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
 */

class bingModel extends Model {


    public function __construct() {
        parent::__construct();
    }


    public function search( $query ){

        $accountKey = "<APPIKEY>";
        $ServiceRootURL =  'https://api.datamarket.azure.com/Bing/SearchWeb/';                    
        $WebSearchURL = $ServiceRootURL . 'Web?$format=json&Query=';

        $cred = sprintf('Authorization: Basic %s', 
        base64_encode($accountKey . ":" . $accountKey) );

        $context = stream_context_create(array(
            'http' => array(
            'header'  => $cred
            )
        ));

        $request = $WebSearchURL ."'".urlencode( str_replace(' OR ', ' ', $query ) )."'";

        //var_dump( $request );


        $response = file_get_contents($request, 0, $context);

        $jsonobj = json_decode($response);

        return $jsonobj;
    }


}
