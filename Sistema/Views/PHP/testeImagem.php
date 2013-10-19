<?php 
/**
 * Description of Connection
 *
 * @author Andrew
 *
 * Somente para testes
 */


require_once("..\Controllers\ImagemController.php"); 
 $controller = new ImagemController();  ?>

<html>
<head>
<title>Entrada de Imagens</title>
</head>
<body>
<form enctype='multipart/form-data' action='testeImagem.php'
method='POST'>
Imagem <input type='file' name='imagem_1' size='50'><br>
Nome do Link<input type='text' name='link' size='50'><br>
Id do tipo de imagem *Ja deve estar criada no banco<input type='text' name='idTipoImagem' size='50'><br>
Id da Postagem *Ja deve estar criada no banco<input type='text' name='idPostagem' size='50'><br>
<input type='submit' value='Gravar'>
</form>

<br>
<br>
<form enctype='multipart/form-data' action='testeImagem.php'
method='GET'>
Id da imagem a ser mostrada<input type='text' name='id' size='50'>
<input type='submit' value='Mostrar'>
</form>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$controller->createImagem($_POST,$_FILES,'1');
echo "gravado com sucesso!";
}
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
print '<img src = "ImagemView.php?id='.$_GET["id"].'&operacao=0"/>';
}
?>
</body>
</html>