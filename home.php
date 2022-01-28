<!DOCTYPE html>
<html>
<head>
	<title>Select - Home</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
	<meta charset="utf-8"/>
</head>
	
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
					<th>Foto do Lixo</th>
					<th>Tempo de espera</th>
					<th>Solicitador</th>
					<th>Material</th>
					<th>Endereco</th>
					<th>Selecionar Catador</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				$sql0="SELECT * FROM retirada WHERE pendente=true ORDER BY data_hora_solicitacao ASC";
				$resultado0=pg_query($connect, $sql0);
				
				while($dados_ret = pg_fetch_array($resultado0)):
					$id_soli=$dados_ret['cod_solicitacao'];
					$sql1="SELECT EXTRACT(day FROM intervalo)*60*24 + EXTRACT(hour FROM intervalo)*60 + EXTRACT(minute FROM intervalo) as demora FROM (SELECT CURRENT_TIMESTAMP-data_hora_solicitacao intervalo FROM retirada WHERE cod_solicitacao=$id_soli) as nome";
					$demora_array = pg_query($connect, $sql1);
					$demora=pg_fetch_array($demora_array);
					
					$email_usu=$dados_ret['usuario_email_usuario'];
					$sql2="SELECT nome_usuario, cpf_usuario FROM usuario WHERE email_usuario='$email_usu'";
					$resultado1 = pg_query($connect, $sql2);
					$dados_usu = pg_fetch_array($resultado1);
				?>
				<tr class="consulta_row">
					<td rowspan=2><a href="ver_foto.php?id=<?= $id_soli ?>"><img src="<?php echo $dados_ret['foto_material']; ?>" height="55"></a></td>
					<td rowspan=2><?php echo $demora['demora']." min"; ?></td>
					<td><?php echo $dados_usu['nome_usuario']; ?></td>
					<td rowspan=2><?php echo $dados_ret['material']; ?></td>
					<td rowspan=2><a href="endereco_solicitacao.php?id=<?= $dados_ret['endereco_cod_endereco'] ?>">Ver Endereço</a></td>
					
					<td rowspan=2>
						<form action="atende.php" method="post" class="no_decoration">
							<select name="catador" width="70%">
							<?php 
							$id = $_SESSION['email_associacao'];
							$sql3 = "SELECT cod_catador, nome_catador FROM catador WHERE associacao_email_associacao='$id'";
							$resultado2 = pg_query($connect, $sql3);
							while($dados = pg_fetch_array($resultado2)):
							?>
								<option value="<?php echo $dados['cod_catador']; ?>"><?php echo $dados['nome_catador']; ?></option>
							<?php 
							endwhile; 
							?>
							 </select>
							 <input type="hidden" name="id" value="<?php echo $dados_ret['cod_solicitacao']; ?>">
							<button class="float-btn" id="check" type="submit" name="btn-continuar"><img src="imagens/check.png" class="icon"></button>
						</form>
					</td>	
				</tr>
				<tr class="consulta_row"><td><?php echo $dados_usu['cpf_usuario']; ?></td></tr>
				<?php
				endwhile;
				pg_close($connect);
				?>
			</tbody>
		</table>
	</article>
</body>

</html>
