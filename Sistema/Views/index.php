<!DOCTYPE html>
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
						<a href="index.html">Home</a>
					</li>
					<li>
						<a href="postagem.html?tipoPostagem=1">Artigos</a>
					</li>
					<li>
						<a href="postagem.html?tipoPostagem=2">Eventos</a>
					</li>
					<li>
						<a href="contato.html">Contato</a>
					</li>
					<li>
						<a href="busca.html">Arquivo</a>
					</li>
				</ul>
				<div>
					<form method="post" id="busca" action="#">
						<input type="text" id="txtBusca" name="txtBusca" value="Pesquise postagens..."/>
						<input type="submit" id="btnBusca" name="btnBusca" value=""/>
					</form>
				</div
			</nav>
		</header>
		<main id="main">
			<!--talvez caiba um mustache.render para os articles-->
			<article id="last">
				<h2 id="title">Título</h2>
				<p id="text">"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				</p>
				<nav id="taglist">
					<ul>
						<li>
							<a href="#">Tag1</a>
						</li>
						<li>
							<a href="#">Tag2</a>
						</li>
					</ul>
				</nav>
				<a href="#">Leia mais..</a>
			</article>
			<article id="penultimate">
				<h2>Título</h2>
				<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
				<ul id="miniImagens">
					<li>
						<img src="common\images\evento2-a.jpg">
					</li>
					<li>
						<img src="common\images\evento2-b.jpg">
					</li>
					<li>
						<img src="common\images\evento2-d.jpg">
					</li>
				</ul>
				<nav id="taglist">
					<ul>
						<li>
							<a href="#">Tag1</a>
						</li>
						<li>
							<a href="#">Tag2</a>
						</li>
					</ul>
				</nav>
				<a href="#">Leia mais..</a>
			</article>
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