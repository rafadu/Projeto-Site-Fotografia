<!DOCTYPE html>
<?php 
/**
 * Description of Connection
 *
 * @author Andrew
 *
 * Somente para testes
 */
require_once("\..\..\Controllers\PostagemController.php"); 
 $controller = new PostagemController();  
 $pagInicial = $controller->readPostagemIndex();
 $post1 = $pagInicial["postagem"][0];$post2 = $pagInicial["postagem"][1];
 $imagens_1 = $controller->showImagensIndex($pagInicial["imagens_1"]);
 $imagens_2 = $controller->showImagensIndex($pagInicial["imagens_2"]);
 $tag_1 = $pagInicial["tags_1"];
 $tag_2 = $pagInicial["tags_2"];
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
						<a href="busca.php">Arquivo</a>
					</li>
				</ul>
			</nav>
		</header>
		<main id="main">
			<!--talvez caiba um mustache.render para os articles-->
			<article id="last">
				<h2 id="title"><?php echo $post1->titulo; ?></h2>
				<p id="text"><?php echo $post1->texto; ?></p>
				<ul id="miniImagens">
					<?php 
						if (!is_null($imagens_1)){
						foreach($imagens_1 as $img)
							echo "<li>$img</li>";
						}
					?>
					
					
				</ul>
				<nav id="taglist">
					<ul>
						<?php 
						if (!is_null($tag_1)){
						foreach($tag_1 as $tag){
							echo "<li>
							<a href='busca.php?buscar=$tag->tag'>$tag->tag</a>
							</li>";
							}
						}
					?>
					</ul>
				</nav>
				<a href="#">Leia mais..</a>
			</article>
			<article id="penultimate">
				<h2><?php echo $post2->titulo; ?></h2>
				<p><?php echo $post2->texto; ?></p>
				<ul id="miniImagens">
					<?php 
						if (!is_null($imagens_1)){
						foreach($imagens_2 as $img)
							echo "<li>$img</li>";
						}
					?>
					
					
				</ul>
				<nav id="taglist">
					<ul>
						<?php 
						if (!is_null($tag_2)){
						foreach($tag_2 as $tag){
							echo "<li>
							<a href='busca.php?buscar=$tag->tag'>$tag->tag</a>
							</li>";}
						}?>
					</ul>
				</nav>
				<a href="#">Leia mais..</a>
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
	</body>
</html>