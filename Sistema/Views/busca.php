<!DOCTYPE html>
<?php 
/**
 * Description of Connection
 *
 * @author Andrew
 *
 * Somente para testes
 */
require_once("..\Controllers\PostagemController.php"); 
 $controller = new PostagemController();
 if (isset($_GET["buscar"])){
 $pagBusca = $controller->buscar($_GET["buscar"]);
 }
 /*else if($_SERVER['REQUEST_METHOD'] == 'POST'){
 $pagBusca = $controller->buscar($_POST["txtBusca"]);
 }*/
 ?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Fran Letzel Fotografia</title>
		<link rel="stylesheet" type="text/css" href="common/styles/reset.css">
		<link rel="stylesheet" type="text/css" href="common/styles/site.css">
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
						<a href="busca.php?buscar=">Arquivo</a>
					</li>
				</ul>
				<div>
					<form method="get" id="busca" action="#">
						<input type="text" id="txtBusca" name="buscar" value="Pesquise postagens..."/>
						<input type="submit" id="btnBusca" name="ok" value=""/>
					</form>
				</div
			</nav>
		</header>
		<main id="main">
			<section>
				<article>
					<h2>Arquivos do site</h2>
					<ul id="resultado">
					<?php
						 /*if ($_SERVER['REQUEST_METHOD'] == 'POST' or isset($_GET["buscar"])){
						foreach ($pagBusca as $post){
							echo "<li><a href=#>$post->titulo</a></li>";
						}
						foreach ($pagBusca["porTags"] as $post){
							echo "<li><a href=#> $post->titulo </a></li>";
						}
						}*/
						
						if ($_SERVER['REQUEST_METHOD'] == 'POST' or isset($_GET["buscar"])){
						//print_r($pagBusca);
						foreach ($pagBusca as $post){
							echo "<li><a href='$post->titulo-$post->id.php'>$post->titulo</a></li>";
						}
						}
					?>
					</ul>
				</article>
			</section>
		</main>
		<aside>
			<!-- para as sections um mustache.render tambem pode ser legal-->
			<section id="feeds">
				<h3>Feeds</h3>
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
</html>