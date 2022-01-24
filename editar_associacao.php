<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';
session_start();

$id = $_SESSION['email_associacao'];
$sql = "SELECT * FROM associacao WHERE email_associacao='$id'";
$resultado = pg_query($connect, $sql);
$dados = pg_fetch_array($resultado);

if(isset($_POST['btn-confirmar'])):
	$erros=array();
	$id=$_SESSION['email_associacao'];
	$nome=pg_escape_string($connect,$_POST['nome']);
	$email=pg_escape_string($connect,$_POST['email']);
	$telefone=pg_escape_string($connect,$_POST['telefone']);
	
	$sql="UPDATE associacao SET nome_associacao='$nome', email_associacao='$email', telefone_associacao='$telefone' WHERE email_associacao='$id'";
	
	if(pg_query($connect, $sql)):
			$_SESSION['mensagem'] = "Editado com sucesso!";
			header('Location: perfil.php');
		else:
			$_SESSION['mensagem'] = "Erro ao editar!";
			die(pg_last_error($connect));
	endif;
endif;
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

	<h3 class="header_slogan">Alterar Dados</h3>

	
	<article class="container">
		<form action="editar_associacao.php" method="post" class="decoration">
		<div>
			<input type="text" name="nome" value="<?php echo $dados['nome_associacao']; ?>"/>
			<input type="text" name="email" value="<?php echo $dados['email_associacao']; ?>"/>
			<input type="text" name="telefone" value="<?php echo $dados['telefone_associacao']; ?>"/>
			<a href="senha.php">Alterar Senha</a>
		</div>
		
		<?php
		if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
		?>
		
		<div class="button">
			<button type="submit" name="btn-confirmar" class="continuar">Confirmar</button>
		</div>

		</form>
	</article>

</body>
</html>

