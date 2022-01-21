<!DOCTYPE html>
<html>
<?php
require_once 'dbconnect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: index.php');
endif;

$id = $_SESSION['cod_associacao'];
$erros=array();
?>

<head>
	<title>Select - Perfil</title>
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
				<li class="active"><a href="home.php">Home</a></li>
				<li><a href="perfil.php">Perfil</a></li>
				<li><a href="dicas.html">Ajuda</a></li>					
				<li><a href="logout.php">Sair</a></li>
		   </div>
		</ul>
	</nav>

	<h3 class="header_slogan">Dados Cadastrais</h3>
	
	<article class="container">
	</article>
</body>

</html>
