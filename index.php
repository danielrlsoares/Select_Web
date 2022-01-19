<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';
session_start();

if(isset($_POST['btn-entrar'])):
	$erros = array();
	$email = mysqli_escape_string($connect, $_POST['email']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	
	if(empty($email) or empty($senha)):
		$erros[] = "<li style='color:red;font-size:10pt;'>Todos os campos devem ser preenchidos</li>";
	else:
		$sql = "SELECT email_associacao FROM associacao WHERE email_associacao='$email'";
		$resultado = mysqli_query($connect, $sql);	
		
		if(mysqli_num_rows($resultado) > 0):
			$senha = md5($senha);
			$sql = "SELECT * FROM associacao WHERE email_associacao='$email' AND senha_associacao='$senha'";
			$resultado = mysqli_query($connect, $sql);
			
			if(mysqli_num_rows($resultado) == 1):
				$dados = mysqli_fetch_array($resultado);
				mysqli_close($connect);
				$_SESSION['logado'] = true;
				$_SESSION['cod_associacao'] = $dados['cod_associacao'];
				header('Location: perfil.php');
			else:
				$erros[] = "<li style='color:red;font-size:10pt;'>Senha incorreta</li>";
			endif;
		else:
			$erros[] = "<li style='color:red;font-size:10pt;'>Email não cadastrado</li>";
		endif;
	endif;
endif;
?>

<head>
	<title>Select - Login</title>
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
	
	<h3 class="header_slogan">Login</h3>

	<article class="container">
		<form action="index.php" method="post">
		<div>
			<input type="text" name="email" placeholder="Email"/>
			<input type="password" name="senha" placeholder="Senha"/>
		</div>
		
		<?php
		if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
		?>
		
		<div class="button">
			<button type="submit" name="btn-entrar" class="entrar">Entrar</button>
		</div>
		<div class="button">
			<button type="button" class="cadastrar" onclick= "window.location.href = 'cadastro.php'">Cadastrar-se</button>
		</div>
		</form>
	</article>
</body>

</html>
