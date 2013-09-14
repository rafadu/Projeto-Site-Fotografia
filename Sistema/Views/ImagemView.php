<?php
require_once("..\Controllers\ImagemController.php");
$controller = new ImagemController();
$lista = $controller->readImagem($_GET);
$imagem = $lista[0]->imagem;
header("Content-type:image/*");
echo $imagem;
