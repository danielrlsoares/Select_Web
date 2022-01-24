<!DOCTYPE html>
<html>
<?php
require_once 'dbconnect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: index.php');
endif;

$id = $_SESSION['email_associacao'];
$sql = "SELECT * FROM associacao WHERE email_associacao='$id'";
$resultado = pg_query($connect, $sql);
$dados = pg_fetch_array($resultado);
$erros=array();
?>

<head>
	<title>Select - Home</title>
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

	<h3 class="header_slogan"><?php echo $dados['nome_associacao'] ?></h3>
	
	<article class="container">
		<table class="consulta">
			<thead>
				<tr class="consulta_row">
					<th>Rua</th>
					<th>CEP</th>
					<th>Número</th>
					<th>Complemento</th>
					<th>UF</th>
					<th>Cidade</th>
					<th>Bairro</th>
					<th>Referência</th>
				</tr>
			</thead>
			<tbody>

				<?php
				$id = $_GET['id'];
				$sql = "SELECT * FROM endereco WHERE cod_endereco=$id";
				$resultado = pg_query($connect, $sql);
				$dados = pg_fetch_array($resultado);
				?>
				<tr class="consulta_row">
					<td><?php echo $dados['rua']; ?></td>
					<td><?php echo $dados['cep']; ?></td>
					<td><?php echo $dados['numero']; ?></td>
					<td><?php echo $dados['complemento']; ?></td>
					<td><?php echo $dados['uf']; ?></td>
					<td><?php echo $dados['cidade']; ?></td>
					<td><?php echo $dados['bairro']; ?></td>
					<td><?php echo $dados['referencia']; ?></td>
				</tr>
				<?php 
				pg_close($connect);
				?>
			</tbody>
		</table>
	</article>
</body>

</html>
