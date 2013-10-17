<?php
require_once("..\Controllers\ImagemController.php");
header("Content-type:image/*");
$controller = new ImagemController();

$lista = $controller->readImagem($_GET);

echo $imagem = $lista[0]->imagem;

