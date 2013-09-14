<?php
/**
 * Description of TagModel
 *
 * @author Rafael
 */
class TagModel implements Application\ICrud{
    public function create(Data\Object\Tag $object) {
        try{            
            //query de insert 
            $query="INSERT INTO tag(tag,idPostagem) VALUES ('$object->tag',$object->idPostagem)";
            //instancia conexão
            $mysqli = Application\Connection::Open();
            //executa o insert
            $mysqli->query($query);
            //fecha o mysqli
            $mysqli->close();
            return $mysqli->affected_rows > 0;
        }
        catch(Exception $ex){
            throw new Exception("Erro ao executar operação no banco. Mensagem: ".$ex->getMessage());
        }
    }

    public function delete($key, $value,$isText) {
        try{
            //variavel para criação da query
            $query="DELETE FROM tag WHERE $key = ";            
            //se o tipo de dado de value for texto, este valor precisa na query
            //estar entre aspas, do contrário a operação não será realizada
            if ($isText)
                $query += "'$value'";
            else
                $query += $value;
            //instanciar interface com banco
            $mysqli = Application\Connection::Open();
            //executar operação
            $mysqli->query($query);
            //fecha conexão
            $mysqli->close();
            return $mysqli->affected_rows > 0;
        }
        catch(Exception $ex){
            throw new Exception("Erro ao deletar Tag. Mensagem: ".$ex->getMessage());
        }
    }

    public function read($key, $value,$isText) {
        try{
            //query de busca base
            $query="SELECT id, tag, idPostagem FROM tag WHERE $key = ";
            
            //finalização da query
            if ($isText)
                $query += "'$value'";
            else
                $query += $value;
            
            //conexão
            $conn = Application\Connection::Open();
            //executa o select, o resultado é guardado num mysqli_result
            $result = $conn->query($query);
            //laço para criar o array de Data Objects
            /*
             * fetch_assoc() pega os valores da posição atual na tabela e guarda
             * no array $row, depois da ultima posição não tem nenhum valor,
             * entao ele nao retorna nada ao array, gerando um resultado false
             * pra condição
             */
            while($row=$result->fetch_assoc()){
                $object = new Data\Object\Tag();
                $object->id = $row['id'];
                $object->tag = $row['tag'];
                $object->idPostagem = $row['idPostagem'];
                //escrever a atribuição abaixo faz com que o php entenda que
                //está adicionando um novo item no array
                $lista[] = $object;
            }
            //fechando result e conexão
            $result->close();
            $conn->close();
            //retornando array
            return $lista;
        }
        catch(Exception $ex){
            throw new Exception("Erro na leitura de dados. Mensagem: ".$ex->getMessage());
        }
    }

    public function update(Data\Object\Tag $object) {
        try{
            //query de update base
            $query="UPDATE tag SET ";
            //se os valores de $object nao forem nulos ou vazios, adicioná-los na condição
            if (!(is_null($object->tag) || empty($object->tag)))
                $query += "tag = '$object->tag'";
            if (!(is_null($object->idPostagem) || empty($object->idPostagem)))
                $query += "idPostagem = $object->idPostagem";
            //id da tag deve vir obrigatoriamente para atualizar a tag,
            //ou não há update
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
            throw new Exception("Erro durante atualização. Mensagem: ".$ex->getMessage());
        }
    }
}

?>
