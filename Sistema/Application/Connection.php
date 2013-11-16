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
    private $dbuser='root';
    private $dbpassword='';
    private $dbname='fotografia';
    
    //abre a conexão com o banco de dados e retorna um objeto mysqli que permite
    //fazer as operações com o database (gera uma interface para realizar as 
    //operações)
    public function Open(){
	$conn = array("address"=>$this->address,  "dbuser"=>$this->dbuser, "dbpassword"=>$this->dbpassword, "dbname"=>$this->dbname);
    return($conn);
    }
    
    //OBS:não esqueça de fechar o mysqli depois
}

?>
