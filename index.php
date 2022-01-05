<!DOCTYPE html>
<html>

<head>
	<title>Select - Login</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
	<meta charset="utf-8"/>
</head>

<body>
	<nav class="navbar">
		<!-- LOGO -->
		<div class="logo"><figure><img src="imagens/logo.png" class="logo"></figure></div>
		<!-- NAVIGATION MENU -->
		<ul class="nav-links">
			<!-- NAVIGATION MENUS -->
			<div class="menu">
				<li class="active"><a href="index.php">Entrar</a></li>
				<li><a href="sobre.html">Sobre</a></li>					
				<li><a href="desenvolvedores.html">Desenvolvedores</a></li>
		   </div>
		</ul>
   </nav>
	<div class="body_content">
		<h3 class="header_slogan">Login</h3>
	</div>
	<article class="container">
		<form action="login.php" method="post">
		<div>
			<input type="text" id="login" placeholder="Email"/>
			<input type="password" id="passw" placeholder="Senha"/>
		</div>
		<div class="button">
			<button type="submit" class="entrar">Entrar</button>
		</div>
		<div class="button">
			<button type="button" class="cadastrar" onclick= "window.location.href = 'cadastro.php'">Cadastrar-se</button>
		</div>
		</form>
	</article>
</body>

</html>
