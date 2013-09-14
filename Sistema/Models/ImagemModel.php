<?php 
require_once("..\Application\Connection.php");
require_once("..\Data Objects\Imagem.php");
require_once("..\Application\ICrud.php");
/**
 * Description of ImagemModel
 *
 * @author Andrew
 */
use Application\Connection;
use Data\Object\Imagem;
use Application\ICrud;
class ImagemModel implements ICrud{
	public function create($object){
		try{
            //query de insert 
            $query="INSERT INTO imagem(imagem,link,idTipoImagem,idPostagem) VALUES ('$object->imagem','$object->link','$object->idTipoImagem',
			$object->idPostagem)";
            //instancia conexão
            //$mysqli = Application\Connection::Open(); Nao funcionando aqui, tentei alterar a classe para manter a logica em cima
			// dela porém não consegui@Andrew
			
			$mysqli = new mysqli("localhost", "root", "", "fotografia");
			
            //executa o insert
            $mysqli->query($query);
            //fecha o mysqli
            $mysqli->close();
           // return $mysqli->affected_rows > 0;
		}
        catch(Exception $ex){
            throw new Exception("Erro ao executar operação no banco. Mensagem: ".$ex->getMessage());
        }
	}
    public function delete($key, $value,$isText) {
        try{
            //variavel de delete
            $query="DELETE FROM imagem WHERE $key = ";            
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
            throw new Exception("Erro ao deletar Imagem. Mensagem: ".$ex->getMessage());
        }
    }
    public function read($key, $value,$isText) {
        try{
            //query de busca base
           // $query="SELECT id, imagem, link, idPostagem, idTipoImagem FROM imagem WHERE $key = ";
            $query= "SELECT  id ,  imagem ,  link ,  idTipoImagem ,  idPostagem FROM  imagem WHERE id = " . $value;	
            //finalização da query
            /* if ($isText)
                $query += "'$value'";
            else
                $query += $value;
			*/           
            //conexão	
            //$conn = Application\Connection::Open(); Nao funcionando aqui, tentei alterar a classe para manter a logica em cima
			// dela porém não consegui @Andrew
			
			$conn = new mysqli("localhost", "root", "", "fotografia");
			
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
                $object = new Data\Object\Imagem();
                $object->id = $row['id'];
                $object->imagem = $row['imagem'];
                $object->link = $row['link'];
                $object->idPostagem = $row['idPostagem'];
                $object->idTipoImagem = $row['idTipoImagem'];
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
    public function update($object) {
        try{
            //query de update base
            $query="UPDATE imagem SET ";
            //se os valores de $object nao forem nulos ou vazios, adicioná-los na condição
            if (!(is_null($object->imagem) || empty($object->imagem)))
                $query += "imagem = '$object->imagem'";
            if (!(is_null($object->idPostagem) || empty($object->idPostagem)))
                $query += "idPostagem = $object->idPostagem";
            if (!(is_null($object->link) || empty($object->link)))
                $query += "link = $object->link";
            if (!(is_null($object->idTipoImagem) || empty($object->idTipoImagem)))
                $query += "idTipoImagem = $object->idTipoImagem";
            //adicionando o id da imagem a query
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