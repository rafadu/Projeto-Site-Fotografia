<?php
require_once("..\Application\Connection.php");
require_once("..\Data Objects\Tag.php");
require_once("..\Application\ICrud.php");
/**
 * Description of TagModel
 *
 * @author Rafael
 */
use Application\Connection;
use Data\Object\Imagem;
use Application\ICrud;
class TagModel implements ICrud{
    public function create($object) {
        try{
            //query de insert
            $query="INSERT INTO tag(tag,idPostagem) VALUES ('$object->tag',$object->idPostagem)";
			 $conn = new Connection();
			 $dbArray = $conn->Open();
             $mysqli = new mysqli($dbArray['address'],$dbArray['dbuser'],$dbArray['dbpassword'],$dbArray['dbname']);
            $mysqli->query($query);
            //fecha o mysqli
            $mysqli->close();
            //return $mysqli->affected_rows > 0;
        }
        catch(Exception $ex){
            throw new Exception("Erro ao executar opera��o no banco. Mensagem: ".$ex->getMessage());
        }
    }

    public function delete($key, $value,$isText) {
        try{
            //variavel para cria��o da query
            $query="DELETE FROM tag WHERE $key = ";
            //se o tipo de dado de value for texto, este valor precisa na query
            //estar entre aspas, do contr�rio a opera��o n�o ser� realizada
            if ($isText)
                $query += "'$value'";
            else
                $query += $value;
            //instanciar interface com banco
            $mysqli = Application\Connection::Open();
            //executar opera��o
            $mysqli->query($query);
            //fecha conex�o
            $mysqli->close();
            return $mysqli->affected_rows > 0;
        }
        catch(Exception $ex){
            throw new Exception("Erro ao deletar Tag. Mensagem: ".$ex->getMessage());
        }
    }

    public function read($key, $value, $isText) {
        try{
            //query de busca base
            $query="SELECT id, tag, idPostagem FROM tag WHERE $key = '$value'";

            //finaliza��o da query
            /*if ($isText)
                $query += "'$value'";
            else
                $query += $value;*/

            //conex�o
            //--$conn = Application\Connection::Open();
			 $conn = new Connection();
			 $dbArray = $conn->Open();
             $mysqli = new mysqli($dbArray['address'],$dbArray['dbuser'],$dbArray['dbpassword'],$dbArray['dbname']);
            //executa o select, o resultado � guardado num mysqli_result
            $result = $mysqli->query($query);
            //la�o para criar o array de Data Objects
            /*
             * fetch_assoc() pega os valores da posi��o atual na tabela e guarda
             * no array $row, depois da ultima posi��o n�o tem nenhum valor,
             * entao ele nao retorna nada ao array, gerando um resultado false
             * pra condi��o
             */
            $lista=array();
            while($row=$result->fetch_assoc()){
                $object = new Data\Object\Tag();
                $object->id = $row['id'];
                $object->tag = $row['tag'];
                $object->idPostagem = $row['idPostagem'];
                //escrever a atribui��o abaixo faz com que o php entenda que
                //est� adicionando um novo item no array
                $lista[] = $object;
            }
            //fechando result e conex�o
            $result->close();
            $mysqli->close();
            //retornando array
            return $lista;
        }
        catch(Exception $ex){
            throw new Exception("Erro na leitura de dados. Mensagem: ".$ex->getMessage());
        }
    }

    public function update($object) {
        try{
            //query de update base
            $query="UPDATE tag SET ";
            //se os valores de $object nao forem nulos ou vazios, adicion�-los na condi��o
            if (!(is_null($object->tag) || empty($object->tag)))
                $query += "tag = '$object->tag'";
            if (!(is_null($object->idPostagem) || empty($object->idPostagem)))
                $query += "idPostagem = $object->idPostagem";
            //id da tag deve vir obrigatoriamente para atualizar a tag,
            //ou n�o h� update
            $query += "WHERE id = $object->id";
            //instanciar
            $conn = Application\Connection::Open();
            //executar
            $conn->query($query);
            //fechar instancia
            $conn->close();
            return $conn->affected_rows > 0;
        }
        catch(Exception $ex){
            throw new Exception("Erro durante atualiza��o. Mensagem: ".$ex->getMessage());
        }
    }
}

?>
