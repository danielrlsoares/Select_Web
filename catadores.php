<!DOCTYPE html>
<html>

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

	<h3 class="header_slogan">Catadores Associados</h3>
	
	<article class="container">
		<table class="consulta">
			<thead>
				<tr class="consulta_row">
					<th>Nome</th>
					<th>CPF</th>
					<th>Data de Nascimento</th>
					<th>Email</th>
					<th>Telefone</th>
				</tr>
			</thead>
			<tbody>
				<?php
				require_once 'dbconnect.php';
				session_start();
				
				$id = $_SESSION['email_associacao'];
				$sql="SELECT * FROM catador WHERE associacao_email_associacao='$id'";
				$resultado=pg_query($connect, $sql);
				while($dados = pg_fetch_array($resultado)):
				?>
				<tr class="consulta_row">
					<td><?php echo $dados['nome_catador']; ?></td>
					<td><?php echo $dados['cpf_catador']; ?></td>
					<td><?php echo $dados['dat_nasc_catador']; ?></td>
					<td><?php echo $dados['email_catador']; ?></td>
					<td><?php echo $dados['telefone_catador']; ?></td>
					
					<td><button class="float-btn" id="edit" onclick="window.location.href = 'editar_catador.php?id=<?= $dados['cod_catador'] ?>'"><img src="imagens/edit.png" class="icon"></button></td>
					<td><button class="float-btn" id="delete" onclick="window.location.href = 'delete_catador.php?id=<?= $dados['cod_catador'] ?>'"><img src="imagens/delete.png" class="icon"></button></td>
				</tr>
				<?php 
				endwhile;
				pg_close($connect);
				?>
			</tbody>
			<td colspan=6><button class="cadastrar" onclick= "window.location.href = 'novo_catador.php'">Adicionar Catador</button></td>
		</table>
		<br>
	</article>
</body>

</html>
