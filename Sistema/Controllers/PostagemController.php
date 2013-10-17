<?php 
/**
 * Description of ImagemModel
 *
 * @author Andrew
 */
//solicita o modelo a ser controlado
require_once("..\Models\PostagemModel.php");
require_once("..\Controllers\ImagemController.php");
require_once("..\Data Objects\Postagem.php");
//utiliza a namespace de Imagem
use Data\Object\Postagem;
class PostagemController {
	public function createPostagem($param,$img){
		
		$criarPostagem = new Postagem();
	
		$criarPostagem->titulo = $param['titulo'];
		$criarPostagem->texto = $param['texto'];
		//atribui a data e hora atuais do servidor para o atributo do objeto
		$tz_object = new DateTimeZone('America/Sao_Paulo');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);     
		$criarPostagem->dataCriacao =  $datetime->format('Y\-m\-d\ H:i:s');
		
		$criarPostagem->isAtivo = $param['isAtivo'];
		$criarPostagem->tipoPostagem = $param['tipoPostagem'];
		
		$objPostagem = new PostagemModel();
		$idImagem = $objPostagem->create($criarPostagem);
		
		$imagem = new ImagemController();
		$param['idPostagem'] = $idImagem;
		
		$imgFlag = 0;
		for ($idImg = 1;$imgFlag<1;$idImg++){
		if ( !empty( $img['imagem_'.$idImg]['name'] )){
		$imagem->createImagem($param,$img,$idImg);
		}
		else
		$imgFlag = 1;
		}
		
	}
	public function readPostagemId($idPostagem){
		$postagemModel = new PostagemModel();	
		$postagem = $postagemModel->read('id',$idPostagem, 1);
		return $post1 =array( "titulo" => $postagem[0]->titulo, "texto" => $postagem[0]->texto , "dataCriacao" => $postagem[0]->dataCriacao ,  "isAtivo" => $postagem[0]->isAtivo , "idTipoPostagem"=>$postagem[0]->idTipoPostagem);
		}
		
	public function readPostagemIndex(){
		$postagemModel = new PostagemModel();
		
		$imagemController = new ImagemController();
		
		$postagem = $postagemModel->read('dataCriacao','', 2);	
		

		$param1 = array("id"=>$postagem[0]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens1 = $imagemController->readImagem($param1);
		
		$param2 = array("id"=>$postagem[1]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens2 = $imagemController->readImagem($param2);
		
		return $arrayIndex = array("postagem"=>$postagem , "imagens_1"=>$imagens1 , "imagens_2"=>$imagens2);
	}
	
	public function readPostagemTipo($idTipo){
		$postagemModel = new PostagemModel();
		
		$imagemController = new ImagemController();
		
		$postagem = $postagemModel->read("idTipoPostagem",$idTipo, 3);	
		

		$param1 = array("id"=>$postagem[0]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens1 = $imagemController->readImagem($param1);
		
		$param2 = array("id"=>$postagem[1]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens2 = $imagemController->readImagem($param2);
		
		$param3 = array("id"=>$postagem[2]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens3 = $imagemController->readImagem($param3);
		
		$param4 = array("id"=>$postagem[3]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens4 = $imagemController->readImagem($param4);
		
		
		return $arrayIndex = array("postagem"=>$postagem , "imagens_1"=>$imagens1 , "imagens_2"=>$imagens2, "imagens_3"=>$imagens3,"imagens_4"=>$imagens4);
	}
	
	
	public function showImagensIndex($imagem){
	$i=0;
	$lista="";
	if (!is_null($imagem)){
	foreach($imagem as $img){
	if ($i<3){
	$lista[] = '<img src = "ImagemView.php?id='.$img->id.'&operacao=1"/>';
	$i++;
	}
	else{
	break;
	}
	
	}
	}
	return $lista;
	}
	
	
	public function listarTopicos($tipoPostagem){
		$postagemModel = new PostagemModel();
		return $psotagem = $postagemModel->read("idTipoPostagem","1", 3);
	}

}

?>