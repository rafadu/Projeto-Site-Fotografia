<?php 
/**
 * Description of ImagemModel
 *
 * @author Andrew
 */
//solicita o modelo a ser controlado e a entrada ao banco de dados
require_once("..\Models\ImagemModel.php");
require_once("..\Data Objects\Imagem.php");
//utiliza a namespace de Imagem
use Data\Object\Imagem;
class ImagemController{
	public function createImagem($param,$arq,$idImg){
		//atribui a variáveis os dados do arquivo de imagem recebido
		$arqImg = $arq["imagem_".$idImg]["tmp_name"];
		$tamanhoImg = $arq["imagem_".$idImg]["size"];
		$tipoImg = $arq["imagem_".$idImg]["type"];
		$nomeImg = $arq["imagem_".$idImg]["name"];
		
		//verifica se o arquivo foi passado
		 if ( $arqImg != "none" )
		{
		//abre o arquivo
		$fp = fopen($arqImg, "rb");
		//atribui a imagem junto com seu tamanho ao conteudo
		$conteudo = fread($fp, $tamanhoImg);
		$conteudo = addslashes($conteudo);
		//fecha o arquivo
		fclose($fp); 
		}
		//cria um objeto de Imagem
		$criarImagem = new Imagem();
		//atribui ao objeto criado os valores recebidos
		$criarImagem->imagem = $conteudo;
		$criarImagem->link = $nomeImg;
		$criarImagem->idTipoImagem = $param["idTipoImagem"];
		$criarImagem->idPostagem = $param["idPostagem"];
		//instancia e passa ao modelo o objeto a ser salvo no banco
		$objImagem = new ImagemModel();
		$objImagem->create($criarImagem);
	}
	
	
		public function readImagem($img){

		//verifica se o valor passado está em string ou não
		$isText = is_string($img["id"]);
		//instancia e passa ao modelo o objeto a ser pesquisado no banco
		$objImagem = new ImagemModel();
		//retorna o valor para a ser utilizado
		switch ($img["operacao"]){
		case 0:
				return $objImagem->read("idPostagem",$img["id"],$isText);
		break;
		case 1:
				return $objImagem->read("id",$img["id"],$isText);
		break;
		}
		return "Erro!";
	}
	

}
?>