<?php
/**
* Desription of PostagemModel
*
* @author Lucas
*/
require_once("..\Application\Connection.php");
require_once("..\Data Objects\Imagem.php");
require_once("..\Application\ICrud.php");
use Application\Connection;
use Data\Object\Postagem;
use Application\ICrud;
class PostagemModel implements Application\ICrud{
     public function create($object) {
         try{
             //query de insert
             $query="INSERT INTO postagem(titulo,texto,dataCriacao,isAtivo,idTipoPostagem) VALUES ('$object->titulo','$object->texto','$object->dataCriacao',$object->isAtivo,$object->tipoPostagem)";
             //instancia conexao
			 $conn = new Connection();
			 $dbArray = $conn->Open();
             $mysqli = new mysqli($dbArray['address'],$dbArray['dbuser'],$dbArray['dbpassword'],$dbArray['dbname']);
             //executa o insert
             $mysqli->query($query);
             //fecha o mysqli
			 $idGerado = $mysqli->insert_id;
             $mysqli->close();
             return $idGerado;
             }
         catch(Exception $ex){
              throw new Exception("Erro ao executar a operação no banco. Mensagem: ".$ex->getMessage());
              }
         }
         
    public function delete($key, $value, $isText) {
         try{
             //varivel de delete
             $query="DELETE FROM postagem WHERE $key = ";
             //se o tipo de dado de value for texto, este valor precisa na query
             //estar entre aspas, do contrario a operação não será realizada
             /*if ($isText)
                $query += "'value'";
             else
                $query += $value;
				*/
             //instanciar interface com o banco
             //$mysqli = Application\Connection::Open();
			$mysqli = new mysqli("localhost", "root", "", "fotografia");
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
         
     public function read($key, $value, $operacao) {
         try{
             //query de busca base
			 $query="";
			 switch ($operacao){
				//Selecionar Postagens mesmo ocultas
				case 0:
					$query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE $key = ".$value;
				break;
				//Selecionar Postagens ativas
				case 1:
					$query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE  isAtivo = 1 AND $key = ".$value;
				break;
				//Selecionar ultimas duas postagens ativas
				case 2:
					$query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE  isAtivo = 1 ORDER BY id DESC LIMIT 2";
				break;
				//Selecionar ultimas quatros postagens ativas
				case 3:
					$query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE isAtivo = 1 AND  $key = ".$value ." ORDER BY id DESC LIMIT 4";
				break;				
				//Efetuar busca
				case 4:
					$query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE  isAtivo = 1 AND ($key LIKE '%$value%') ORDER BY dataCriacao DESC";
				break;
				
			 }
			 
			/* if ($operacao == 1){
             $query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem WHERE $key = ".$value;
             }
			 elseif($operacao == 2){
			  $query="SELECT id, titulo, texto, dataCriacao, isAtivo, idTipoPostagem FROM postagem ORDER BY id DESC LIMIT 2";
			 }*/
			 
			 
			 
             //finalização da query
                
             //conexão
			 $conn = new Connection();
			 $dbArray = $conn->Open();
             $mysqli = new mysqli($dbArray['address'],$dbArray['dbuser'],$dbArray['dbpassword'],$dbArray['dbname']);
             //executa o select, o resultdo é guardado num msqli_result
             $result = $mysqli->query($query);
             //laço para criar o array de Data Objects
             /*
              * fetch_assoc() pega os valores da posição atual na tabela e guarda
              * no array $row, depois da ultima posição não tem nenhum valor,
              * então ele não retorna nada ao array, gerando um resultado false
              * pra condição
              */
			  $lista=array();
              while($row=$result->fetch_assoc()){
                 $object = new Data\Object\Postagem();
                 $object->id = $row['id'];
                 $object->titulo = $row['titulo'];
                 $object->texto = $row['texto'];
                 $object->dataCriacao = $row['dataCriacao'];
                 $object->isAtivo = $row['isAtivo'];
                 $object->idTipoPostagem = $row['idTipoPostagem'];
                 //ecrever  atribuição abaixo faz com que o php entenda que
                 //esta adicionando um novo item no array
                 $lista[] = $object;
              }
              //fechando o result e conexão
              $result->close();
              $mysqli->close();
              //retornando array
              return $lista;
             }
         catch(Exception $ex){
             throw new Exception("Erro na leitura de dados. Mensagem: ".$ex->getMessage());
             }
         }
             
     public function update($object){
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
