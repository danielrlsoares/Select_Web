<!DOCTYPE html>
<html>
<?php
require_once 'dbconnect.php';
session_start();

if(!isset($_SESSION['logado'])):
	header('Location: index.php');
endif;

$id = $_SESSION['email_associacao'];
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
				<li><a href="home.php">Home</a></li>
				<li class="active"><a href="perfil.php">Perfil</a></li>
				<li><a href="dicas.html">Ajuda</a></li>					
				<li><a href="logout.php">Sair</a></li>
		   </div>
		</ul>
	</nav>

	<h3 class="header_slogan">Dados Cadastrais</h3>
	
	<article class="container">
		<table class="consulta">
			<thead>
				<tr class="consulta_row">
					<th>Nome</th>
					<th>Email</th>
					<th>Telefone</th>
				</tr>
			</thead>
			<tbody>
				<?php
				require_once 'dbconnect.php';
				$sql="SELECT * FROM associacao WHERE email_associacao='$id'";
				$resultado=pg_query($connect, $sql);
				$dados = pg_fetch_array($resultado);
				?>
				<tr class="consulta_row">
					<td><?php echo $dados['nome_associacao']; ?></td>
					<td><?php echo $dados['email_associacao']; ?></td>
					<td><?php echo $dados['telefone_associacao']; ?></td>
					
					<td><button class="float-btn" id="edit" onclick="window.location.href = 'editar_associacao.php'"><img src="imagens/edit.png" class="icon"></button></td>
					<td><button class="float-btn" id="delete" onclick="window.location.href = 'delete_associacao.php'"><img src="imagens/delete.png" class="icon"></button></td>
					<td><button class="float-btn" id="local" onclick="window.location.href = 'endereco.php?id=<?= $dados['endereco_cod_endereco'] ?>'"><img src="imagens/local.png" class="icon"></button></td>
				</tr>
			</tbody>
			<tr><td colspan=6><button class="cadastrar" onclick= "window.location.href = 'catadores.php'">Catadores Associados</button></td></tr>
			<?php 
			pg_close($connect);
			?>
		</table>
		
	</article>
</body>

</html>
