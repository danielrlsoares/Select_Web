<!DOCTYPE html>
<html>

<head>
	<title>Select - Cadastro</title>
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
		<h3 class="header_slogan">Cadastro</h3>
	</div>
	<article class="container">
		<form action="cadastro.php" method="post">
		<div>
			<input type="text" id="nome" placeholder="Nome da Associação"/>
			<input type="text" id="login" placeholder="Email"/>
			<input type="text" id="telefone" placeholder="Telefone"/>
			<input type="password" id="password" placeholder="Senha"/>
			<!--Aqui deve vir o campo para cadastrar o endereço, com a ajuda da base de dados de GPS do Google-->
		</div>
		<div class="button">
			<button type="submit" class="continuar">Continuar</button>
		</div>
		<div class="button">
			<button type="button" class="cancelar" onclick= "window.location.href = 'login.php'">Cancelar</button>
		</div>
		</form>
	</article>
</body>
</html>
