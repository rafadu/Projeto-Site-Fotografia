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
<<<<<<< HEAD
    private $dbuser='root';
    private $dbpassword='';
    private $dbname='fotografia';
=======
    private $dbuser='agenda';
    private $dbpassword='agenda';
    private $dbname='estudos';
>>>>>>> 857f7718dd038bff1c2eed9447c132b11a651313
    
    //abre a conexão com o banco de dados e retorna um objeto mysqli que permite
    //fazer as operações com o database (gera uma interface para realizar as 
    //operações)
    public static function Open(){
        return new mysqli($this->address,  $this->dbuser, $this->dbpassword, $this->dbname);
    }
    
    //OBS:não esqueça de fechar o mysqli depois
}

?>
