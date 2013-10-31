<?php

/*
 * Copyright 2013 de Catalão/Thiago Faleiros, Cleriston Dantas, Fernando Nóbrega
 * Este arquivo é parte do programa TEMA. 
 * O TEMA é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos da
 * GNU General Public License como publicada pela Fundação do Software Livre (FSF); 
 * na versão 3 da Licença. Este programa é distribuído na esperança que possa
 * ser útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a licença para maiores detalhes. Você deve ter recebido uma cópia da
 * GNU General Public License, sob o título "LICENCA.txt",
 * junto com este programa, se não, acesse http://www.gnu.org/licenses
 **/

/**
 * User: Cleriston Dantas
 * Date: 29/03/13
 * Time: 10:27
 * To change this template use File | Settings | File Templates.
 */

class Hash
{
    public static function getHash($algoritmo, $data, $key)
    {
        $hash = hash_init($algoritmo, HASH_HMAC, $key);
        hash_update($hash, $data);

        return hash_final($hash);
    }

    public static function getHashPadrao($algoritmo, $data, $key){
        $hash = hash_init($algoritmo, HASH_HMAC, $key);
        hash_update($hash, $data);

        return hash_final($hash);
    }
}
