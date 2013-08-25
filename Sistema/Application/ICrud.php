<?php

/**
 *
 * @author Rafael
 * 
 * Determina as operações básicas com banco de dados
 * C -> Create - INSERT
 * R -> Read - SELECT
 * U -> Update - UPDATE
 * D -> Delete - DELETE
 */
namespace Application;
    interface ICrud {
        //put your code here
    
        public function create($classe);
        public function read($key,$value);
        public function update($classe);
        public function delete($key,$value);
    }

?>
