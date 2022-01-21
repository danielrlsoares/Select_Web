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
				<li class="active"><a href="perfil.php">Associação</a></li>
				<li><a href="catadores.php">Catadores</a></li>
				<li><a href="dicas.html">Ajuda</a></li>					
				<li><a href="logout.php">Sair</a></li>
		   </div>
		</ul>
	</nav>

	<h3 class="header_slogan">Endereço</h3>
	
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
				</tr>
			</thead>
			<tbody>

				<?php
				require_once 'dbconnect.php';

				if(isset($_GET['id'])):
					$id = $_GET['id'];
						
					$sql = "SELECT * FROM endereco WHERE cod_endereco=$id";
					$resultado = mysqli_query($connect, $sql);
					$dados = mysqli_fetch_array($resultado);
				endif;
				?>
				<tr class="consulta_row">
					<td><?php echo $dados['rua']; ?></td>
					<td><?php echo $dados['cep']; ?></td>
					<td><?php echo $dados['numero']; ?></td>
					<td><?php echo $dados['complemento']; ?></td>
					<td><?php echo $dados['uf']; ?></td>
					<td><?php echo $dados['cidade']; ?></td>
					<td><?php echo $dados['bairro']; ?></td>
					
					<td><button class="float-btn" id="edit" onclick="window.location.href = 'editar_endereco.php?id=<?= $dados['cod_endereco'] ?>'"><img src="imagens/edit.png" class="icon"></button></td>
				</tr>
				<?php 
				mysqli_close($connect);
				?>
			</tbody>
		</table>
	</article>
</body>

</html>