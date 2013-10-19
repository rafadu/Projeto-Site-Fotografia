<?php 
require_once("..\Controllers\PostagemController.php"); 
$controller = new PostagemController();
?>
<html>
<head>
<title>title</title>
</head>
<body>
<form enctype='multipart/form-data' action='formImagem.php'
method='POST'>
Imagem <input type='file' name='imagem' size='50'><br>
<input type='submit' value='Gravar Imagem'>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$controller->criarImagemPostagem($_FILES);
echo "<br/>gravado com sucesso!";
}
?>
</html>