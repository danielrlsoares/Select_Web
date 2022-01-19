<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';
$erros=array();

if(isset($_GET['id'])):
	$id = $_GET['id'];
	
	$sql = "SELECT * FROM associacao WHERE cod_associacao=$id";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;

if(isset($_POST['btn-alterar'])):
	$id = $_POST['id'];
	$senha1 = mysqli_escape_string($connect, $_POST['senha1']);
	$senha1 = md5($senha1);
	$senha2 = mysqli_escape_string($connect, $_POST['senha2']);
	
	if(empty($senha1) or empty($senha2)):
		$erros[] = "<li style='color:red;font-size:10pt;'>Todos os campos devem ser preenchidos</li>";
	else:
		$sql = "SELECT * FROM associacao WHERE cod_associacao=$id AND senha_associacao='$senha1'";
		$resultado = mysqli_query($connect, $sql);	
		if(mysqli_num_rows($resultado) == 1):
			$senha2 = md5($senha2);
			$sql = "UPDATE associacao SET senha_associacao='$senha2'";
			if(mysqli_query($connect, $sql)):
				$_SESSION['mensagem'] = "Senha alterada com sucesso!";
				header('Location: catadores.php');
			else:
				$_SESSION['mensagem'] = "Erro ao alterar a senha!";
				header('Location: perfil.php');
				die(mysqli_error($connect));
	endif;
		else:
			$erros[] = "<li style='color:red;font-size:10pt;'>Senha antiga incorreta!</li>";
		endif;
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

	<h3 class="header_slogan">Alterar Senha</h3>
	
	<article class="container">
		<form action="senha.php" method="post">
		<div>
			<input type="hidden" name="id" value="<?php echo $dados['cod_associacao']; ?>"/>
			<input type="password" name="senha1" placeholder="Digite a antiga senha"/>
			<input type="password" name="senha2" placeholder="Digite a nova senha"/>
		</div>
		
		<?php
		if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
		?>
		
		<div class="button">
			<button type="submit" name="btn-alterar" class="continuar">Alterar</button>
		</div>

		</form>
	</article>
</body>

</html>
