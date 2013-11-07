<?php 
/**
 * Description of ImagemModel
 *
 * @author Andrew
 */
//solicita o modelo a ser controlado
require_once("..\..\Models\PostagemModel.php");
require_once("..\..\Controllers\ImagemController.php");
require_once("..\..\Data Objects\Postagem.php");
require_once("..\..\Controllers\TagController.php");
//utiliza a namespace de Imagem
use Data\Object\Postagem;
class PostagemController {
	public function createPostagem(){
		
		$criarPostagem = new Postagem();
	
		$criarPostagem->titulo = $_REQUEST['txtTitulo'];
		$criarPostagem->texto = $_REQUEST['txtDescricao'];
		//atribui a data e hora atuais do servidor para o atributo do objeto
		$tz_object = new DateTimeZone('America/Sao_Paulo');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);     
		$criarPostagem->dataCriacao =  $datetime->format('Y\-m\-d\ H:i:s');
		
		$criarPostagem->isAtivo = true;
		$criarPostagem->tipoPostagem = intval($_REQUEST['tipoPostagem']);
		
		$objPostagem = new PostagemModel();
		$idImagem = $objPostagem->create($criarPostagem);
                
		/*$imagem = new ImagemController();
		$param['idPostagem'] = $idImagem;
		
		$imgFlag = 0;
		for ($idImg = 1;$imgFlag<1;$idImg++){
		if ( !empty( $img['imagem_'.$idImg]['name'] )){
		$imagem->createImagem($param,$img,$idImg);
		}
		else
		$imgFlag = 1;
		}*/
		
		/*$tag = new TagController();
		$tagFlag=0;
		for ($count=1;$tagFlag<1;$count++){
		if (!empty($param['tag_'.$count])){
		$param['tag'] = $param['tag_'.$count];
		$tag->createTag($param);
		}
		else{
		$tagFlag=1;
		}
		}*/
		
		$titulo = $criarPostagem->titulo;
		$this->criarArquivoPostagem($idImagem, $titulo);
		
             header("Location: ../../Views/painel.html");
	}
	
	public function criarArquivoPostagem($id,$titulo){
		$filename = "$titulo-$id.php";
		if(file_exists($filename)){
		$content = file_get_contents($filename);
		} 
		else {
		$content = "";
		}
		$content = '<?php require_once("..\..\Controllers\PostagemController.php"); 
			$controller = new PostagemController();
			$meuId = '.$id.' ;
			$controller->conteudoPaginas($meuId);
			?>';
		$file = @fopen($filename, "w+");
		@fwrite($file, $content);
		@fclose($file);
		
	}
	
			public function MostraImagens($imgs){
			$result='';
				if (!is_null($imgs)){
						foreach($imgs as $img){
							$result.= "<li>$img</li>";}
						}
						return $result;
		}
				public function MostraTags($tag){
				$result='';
						if (!is_null($tag)){
						foreach($tag as $tag){
							$result .= "<li>
							<a href='busca.php?buscar=$tag->tag'>$tag->tag</a>
							</li>";
							}
						}
						return $result;
		}
	
	
	
	public function conteudoPaginas($id){
$tagController = new TagController();
$imagemController = new ImagemController();

$post = $this->readPostagemId($id);

$param = array("id"=>$id , "operacao"=>0);
$imagens = $imagemController->readImagem($param);
$imagens = $this->showImagensIndex($imagens);
$tags = $tagController->readTag($param);
echo '<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Fran Letzel Fotografia</title>
		<link rel="stylesheet" type="text/css" href="common/styles/reset.css">
		<link rel="stylesheet" type="text/css" href="common/styles/site.css">
		<link rel="stylesheet" type="text/css" href="common/styles/post.css">
	</head>
	<body>
	<div id="geral">
		<header>
			<h1>Fraan Letzel Fotografia</h1>
			<!-- Imagem no topo -->
			<nav>
				<ul>
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="postagem.php?tipoPostagem=1">Artigos</a>
					</li>
					<li>
						<a href="postagem.php?tipoPostagem=2">Eventos</a>
					</li>
					<li>
						<a href="contato.html">Contato</a>
					</li>
					<li>
						<a href="busca.php">Arquivo</a>
					</li>
				</ul>
			</nav>
		</header>
		<main id="main">
			<!--talvez caiba um mustache.render para os articles-->
			<article id="penultimate">
				<h2>'.$post['titulo'].'</h2>
				<p>'.$post['texto'].'</p>
				<ul id="imagens">
				'.$this->MostraImagens($imagens)
					.'
				</ul>
				<nav id="taglist">
					<ul>
						'. $this->MostraTags($tags)  .'
					</ul>
				</nav>
			</article>
		</main>
		<aside>
			<!-- para as sections um mustache.render tambem pode ser legal-->
			<section id="feeds">
				<h3>Titulo Section 1</h3>
				<nav>
					<ul>
						<li>
							<br><a href="http://www.facebook.com/fraanletzel"><img src="common\images\facebook.jpg"></a>
						</li>				
						<li>
							<br><a href="https://twitter.com/fraanletzel"><img src="common\images\twitter.jpg"></a>
						</li>
						<li>
							<br><a href="http://www.flickr.com/photos/fraanletzel/"><img src="common\images\flickr.jpg"></a>
						</li>
						<li>
							<br><a href="http://fraanletzel.tumblr.com/"><img src="common\images\tumblr.jpg"></a>
						</li>	
					</ul>
				</nav>
			</section>
			<section id="parceiros">
				<h3>Visite também</h3>
					<nav>
						<ul>
							<li>
								<br><a href="http://www.facebook.com/OficialOtagames"><img src="common\images\otagames.jpg"></a>
							</li>
							<li>
								<br><a href="http://www.facebook.com/bandaryujinsantos"><img src="common\images\ryujin.jpg"></a>
							</li>
							<li>
							<br><a href="http://www.facebook.com/SoGalhofas"><img src="common\images\sogalhofas.jpg"></a>
							</li>
						</ul>
					</nav>
			</section>
		</aside>
		<footer>
			&copy; Exodia Corporation
				| Fraan letzel Fotografia
					<time pubdate="pubdate">2013-25-06</time>
						
			<div id="login">
				<a href="login.html">Login</a>
			</div>
		</footer>
	</div>
		<script type="text/javascript" src="common/scripts/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="common/scripts/core.js"></script>
	</body>
</html>';



}
	
	
	
	
	
	
	
	
	
	
	public function readPostagemId($idPostagem){
		$postagemModel = new PostagemModel();	
		$postagem = $postagemModel->read('id',$idPostagem, 1);
		return $post1 =array( "titulo" => $postagem[0]->titulo, "texto" => $postagem[0]->texto , "dataCriacao" => $postagem[0]->dataCriacao ,  "isAtivo" => $postagem[0]->isAtivo , "idTipoPostagem"=>$postagem[0]->idTipoPostagem);
		}
		
	public function readPostagemIndex(){
		$postagemModel = new PostagemModel();
		
		$imagemController = new ImagemController();
		
		$tag = new TagController();
		
		$postagem = $postagemModel->read('dataCriacao','', 2);	
		

		$param1 = array("id"=>$postagem[0]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens1 = $imagemController->readImagem($param1);
		$tags1= $tag->readTag($param1);
		
		
		$param2 = array("id"=>$postagem[1]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens2 = $imagemController->readImagem($param2);
		$tags2= $tag->readTag($param2);
		
		
		return $arrayIndex = array("postagem"=>$postagem , "imagens_1"=>$imagens1 , "imagens_2"=>$imagens2, "tags_1"=>$tags1, "tags_2"=>$tags2);
	}
	
	public function readPostagemTipo($idTipo){
		$postagemModel = new PostagemModel();
		
		$imagemController = new ImagemController();
		$tag = new TagController();
		$postagem = $postagemModel->read("idTipoPostagem",$idTipo, 3);	
		

		$param1 = array("id"=>$postagem[0]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens1 = $imagemController->readImagem($param1);
		$tags1= $tag->readTag($param1);
		
		$param2 = array("id"=>$postagem[1]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens2 = $imagemController->readImagem($param2);
		$tags2= $tag->readTag($param2);
		
		$param3 = array("id"=>$postagem[2]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens3 = $imagemController->readImagem($param3);
		$tags3= $tag->readTag($param3);
		
		$param4 = array("id"=>$postagem[3]->id , "operacao"=>0); //id da postagem e tipo da operação de busca(busca por id da postagem = 0);
		$imagens4 = $imagemController->readImagem($param4);
		$tags4= $tag->readTag($param4);
		
		return $arrayIndex = array("postagem"=>$postagem , "imagens_1"=>$imagens1 , "imagens_2"=>$imagens2, "imagens_3"=>$imagens3,"imagens_4"=>$imagens4,"tags_1"=>$tags1, "tags_2"=>$tags2,"tags_3"=>$tags3, "tags_4"=>$tags4);
	}
	
	public function showImagensIndex($imagem){
	$i=0;
	$lista=[];
	if (!is_null($imagem)){
	foreach($imagem as $img){
	if ($i<3){
	$lista[] = '<img src = "..\PHP\ImagemView.php?id='.$img->id.'&operacao=1"/>';
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
		return $postagem = $postagemModel->read("idTipoPostagem","1", 3);
	}
	public function buscar ($param){
		$postagemModel = new PostagemModel();
		$tagController = new TagController();
		$tagsPostagens=[];
		//$imagemController = new ImagemController();
		$tags = $tagController->readTagNome($param);
		$postagens = $postagemModel->read("titulo",$param,4);
		foreach($tags as $tag){
			$tagsPostagens[] = $postagemModel->read("id",$tag->idPostagem,1);
		}

		
		
		$postagensTags=[];
		foreach($tagsPostagens as $postTags){
				$postagensTags[]=$postTags[0];
			foreach($postTags as $postTags2){
			$same = false;
				foreach ($postagensTags as $postTags3){
				if ($postTags2 == $postTags3){
					$same=true;
					break;
				}
				}
			if ($same=false){
				$postagensTags[]= $postTags2;
			}
			}
		}
		
		
		
		/*for ($c = 0;$c < count($tagsPostagens);$c++){
			for ($c2;$c2<count($tagsPostagens[$c]);$c2++){
				
			}
		}*/
		
		$result = array_merge($postagens,$postagensTags);
		//$postFinal[]=$result[0];
		for($c=0;$c<count($result);$c++){

			$same = false;
			for($c2=$c+1;$c2<count($result);$c2++){
				if ($result[$c]->id==$result[$c2]->id){
					$same=true;
					break;
				}
			}
			if ($same==false){
			$postFinal[]=$result[$c];
			}
		}
		
		//$result = array("porTitulo"=>$postagens, "porTags"=>$postagensTags);

		/*$imagem[];
		foreach($postagens as $posts){
			$paramImagem = array("id"=>$posts->id , "operacao"=>0);
			$imagem[] = $imagemController($paramImagem);
		}*/
		//print_r($postFinal);
		return $postFinal;
		
	}

}
?>