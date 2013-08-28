<?php

/**
 * Description of Connection
 *
 * @author Rafael
 */
namespace Application;
class Connection {
    //classe de conexão com o banco de dados, sempre instanciar
    //ao realizar uma operação lá
    private $address='localhost';
    private $dbuser='agenda';
    private $dbpassword='agenda';
    private $dbname='estudos';
    
    //abre a conexão com o banco de dados e retorna um objeto mysqli que permite
    //fazer as operações com o database (gera uma interface para realizar as 
    //operações)
    public static function Open(){
        return new mysqli($this->address,  $this->dbuser, $this->dbpassword, $this->dbname);
    }
    
    //OBS:não esqueça de fechar o mysqli depois
}

?>
