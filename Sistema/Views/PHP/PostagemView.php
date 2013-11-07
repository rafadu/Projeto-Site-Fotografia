<?php 
/**
 * Description of Connection
 *
 * @author Andrew
 *
 * Somente para testes
 */
require_once("..\..\Controllers\PostagemController.php"); 
 $controller = new PostagemController();  ?>
<html>
<head>
<meta charset="utf-8"/>
<title>Entrada de Postagens</title>
</head>
<body>
<form enctype='multipart/form-data' action='PostagemView.php'
method='POST'>
Título<input type='text' name='txtTitulo' size='50'><br>
Texto<input type='text' name='txtDescricao' size='50'><br>
Imagem <input type='file' name='imagem_1' size='50'><br>
Imagem <input type='file' name='imagem_2' size='50'><br>
Imagem <input type='file' name='imagem_3' size='50'><br>
Imagem <input type='file' name='imagem_4' size='50'><br>
Tipo Imagem<input type='text' name='idTipoImagem' size='50'><br>
Ativo<input type='text' name='isAtivo' size='50'><br>
Tipo de Postagem<input type='text' name='tipoPostagem' size='50'><br>
Tag 1<input type='text' name='tag_1' size='50'><br>
Tag 2<input type='text' name='tag_2' size='50'><br>
<input type='submit' value='Gravar'>
</form>
</body>
</html>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$controller->createPostagem($_POST,$_FILES);
$controller->criarArquivoPostagem(30,'Well');
//$postagem = $controller->readPostagemId(1);
/*
$pagInicial = $controller->readPostagemIndex();

//$postagem = $controller->listarTopicos(1);
//exemplo de recuperação da postagem com todo o seu conteudo pelo seu ID

/*echo $postagem["titulo"]."<br/>";
echo $postagem["texto"]."<br/>";
echo $postagem["dataCriacao"]."<br/>";
echo "<br/>gravado com sucesso!";*/
//exemplo de postagens da pagina inicial automatizadas
/*
$post1 = $pagInicial["postagem"][0];$post2 = $pagInicial["postagem"][1];
echo $post1->titulo."<br/>";
echo $post1->texto."<br/>";
echo $post1->dataCriacao."<br/>";
$imagens_1 = $controller->showImagensIndex($pagInicial["imagens_1"]);
foreach ($imagens_1 as $imgs){
print $imgs;
}

echo $post2->titulo."<br/>";
echo $post2->texto."<br/>";
echo $post2->dataCriacao."<br/>";
$imagens_2 = $controller->showImagensIndex($pagInicial["imagens_2"]);
foreach ($imagens_2 as $imgs){
print $imgs;
}
*/
//exemplo de listagem por topicos (artigo ou evento)
/*foreach($postagem as $item){
echo $item->titulo."<br/>";
echo $item->texto."<br/>";
echo $item->dataCriacao."<br/>";
}
*/

}
?>