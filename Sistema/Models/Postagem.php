<?php
/**
* Desription of PostagemModel
*
* @author Lucas
*/
class PostagemModel implements Application\ICrud{
     public function create(Data\Object\Postagem $object) {
         try{
             //query de insert
             $query="INSERT INTO postagem(titulo,texto,dataCriacao,isAtivo,isTipoPostagem) VALUES ('$object->titulo','$object->texto',$object->dataCriacao,$object->isAtivo,$object->isTipoPostagem)";
             //instancia conexao
             $mysqli = Application\Connection::Open();
             //executa o insert
             $mysqli->query($query);
             //fecha o mysqli
             $mysqli->close();
             return $mysqli->affected_rows > 0;
             }
         catch(Exception $ex){
              throw new Exception("Erro ao executar a operação no banco. Mensagem: ".$ex->getMessage());
              }
         }
         
     public function delete($key, $value, $isText) {
         try{
             //varivel de delete
             $query="DELETE FROM postagem WHERE $key = "
             //se o tipo de dado de value for texto, este valor precisa na query
             //estar entre aspas, do contrario a operação não será realizada
             if ($isText)
                $query += "'value'";
             else
                $query += $value;
             //instanciar interface com o banco
             $mysqli = Application\Connection::Open();
             //executar operação
             $mysqli->query($query);
             //fecha conexão
             $mysqli->close();
             return $mysqli->affected_rows > 0;
             }
         catch(Exception $ex){
             throw new Exception("Erro ao deletar Postagem. Mensagem: ".$ex->getMessage());
             }
         }
         
     public function read($key, $value, $isText) {
         try{
             //query de busca base
             $query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE $key = ";
             
             //finalização da query
             if ($isText)
                $query += "'value'";
             else
                $query += $value;
                
             //conexão
             $conn = Application\Connection::Open();
             //executa o select, o resultdo é guardado num msqli_result
             $result = $conn->query($query);
             //laço para criar o array de Data Objects
             /*
              * fetch_assoc() pega os valores da posição atual na tabela e guarda
              * no array $row, depois da ultima posição não tem nenhum valor,
              * então ele não retorna nada ao array, gerando um resultado false
              * pra condição
              */
              while($row=$result->fetch_assoc()){
                 $object = new Data\Object\Postagem();
                 $object->id = $row['id'];
                 $object->titulo = $row['titulo'];
                 $object->texto = $row['texto'];
                 $object->dataCriaco = $row['dataCriacao'];
                 $object->isAtivo = $row['isAtivo'];
                 $object->idTipoPostagem = $row['idTipoPostagem'];
                 //ecrever  atribuição abaixo faz com que o php entenda que
                 //esta adicionando um novo item no array
                 $lista[] = $object;
              }
              //fechando o result e conexão
              $result->close();
              $conn->close();
              //retornando array
              return $lista;
             }
         catch(Exception $ex){
             throw new Exception("Erro na leitura de dados. Mensagem: ".$ex->getMessage());
             }
         }
             
     public function update(Data\Object\Postagem $object){
         try{
             //query de update base
             $query="UPDATE postagem SET ";
             //se os valores de object nao forem nulos ou vazios,adiciona-los na condição
             if (!(is_null($object->titulo) || empty($object->titulo)))
                 $query += "titulo = '$object->titulo'";
             if (!(is_null($object->texto) || empty($object->texto)))
                 $query += "texto = '$object->texto'";
             if (!(is_null($object->dataCriacao) || empty($object->dataCriacao)))
                 $query += "dataCriacao = $object->dataCriacao";
             if (!(is_null($object->isAtivo) || empty($object->isAtivo)))
                 $query += "isAtivo = $object->isAtivo";
             if (!(is_null($object->idTipoPostagem) || empty($object->idTipoPostagem)))
                 $query += "idTipoPostagem = $object->idTipoPostagem";
             //adicionando o id da postagem a query
             $query += "WHERE id = $object->id";
             //instanciar
             $conn = Application\Connection::Open();
             //executar
             $conn->query($query);
             //fechar a instancia
             $conn->close();
             return $conn->affected_rows > 0;
             }
         catch(Exeception $ex){
             throw new Exception("Erro durante a atualização. Mensagem: ".$ex.getMessage());
             }
         }
     }
?>
