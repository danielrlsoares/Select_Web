<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';

if(isset($_GET['id'])):
	$id = $_GET['id'];
		
	$sql = "SELECT * FROM associacao WHERE cod_associacao=$id";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;

if(isset($_POST['btn-confirmar'])):
	$erros=array();
	$id=$_POST['id'];
	$nome=mysqli_escape_string($connect,$_POST['nome']);
	$email=mysqli_escape_string($connect,$_POST['email']);
	$telefone=mysqli_escape_string($connect,$_POST['telefone']);
	
	$sql="UPDATE associacao SET nome_associacao='$nome', email_associacao='$email', telefone_associacao='$telefone' WHERE cod_associacao=$id";
	
	if(mysqli_query($connect, $sql)):
			$_SESSION['mensagem'] = "Editado com sucesso!";
			header('Location: perfil.php');
		else:
			$_SESSION['mensagem'] = "Erro ao editar!";
			die(mysqli_error($connect));
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
				<li class="active"><a href="perfil.php">Associação</a></li>
				<li><a href="catadores.php">Catadores</a></li>
				<li><a href="dicas.html">Ajuda</a></li>					
				<li><a href="logout.php">Sair</a></li>
		   </div>
		</ul>
	</nav>

	<h3 class="header_slogan">Alterar Dados</h3>

	
	<article class="container">
		<form action="editar_associacao.php" method="post">
		<div>
			<input type="hidden" name="id" value="<?php echo $dados['cod_associacao']; ?>"/>
			<input type="text" name="nome" value="<?php echo $dados['nome_associacao']; ?>"/>
			<input type="text" name="email" value="<?php echo $dados['email_associacao']; ?>"/>
			<input type="text" name="telefone" value="<?php echo $dados['telefone_associacao']; ?>"/>
			<a href="senha.php?id=<?= $dados['cod_associacao'] ?>">Alterar Senha</a>
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

