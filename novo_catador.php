<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';
session_start();

if(isset($_POST['btn-continuar'])):
	$erros = array();
	$id_ass = $_SESSION['email_associacao'];
	$nome=pg_escape_string($connect,$_POST['nome']);
	$cpf=pg_escape_string($connect,$_POST['cpf']);
	$dat_nasc = date('Y-m-d', strtotime($_POST['dat_nasc']));
	$email=pg_escape_string($connect,$_POST['email']);
	$telefone=pg_escape_string($connect,$_POST['telefone']);
		
	if(empty($nome) or empty($cpf) or empty($dat_nasc)):
		$erros[] = "<li style='color:red;font-size:10pt;'>Todos os campos devem ser preenchidos</li>";
	else:
		$sql="INSERT INTO catador(nome_catador, cpf_catador, email_catador, telefone_catador, dat_nasc_catador, associacao_email_associacao) VALUES ('$nome', '$cpf', '$email', '$telefone', '$dat_nasc', '$id_ass')";
		if(pg_query($connect, $sql)):
			$_SESSION['mensagem'] = "Cadastrado com sucesso!";
			header('Location: catadores.php');
		else:
			$_SESSION['mensagem'] = "Erro ao cadastrar!";
			die(pg_last_error($connect));
		endif;
	endif;
endif;
pg_close($connect);	
?>

<head>
	<title>Select - Perfil</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
	<script>
		function mascara_cpf(i){
   
		   var v = i.value;
		   
		   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
			  i.value = v.substring(0, v.length-1);
			  return;
		   }
		   
		   i.setAttribute("maxlength", "14");
		   if (v.length == 3 || v.length == 7) i.value += ".";
		   if (v.length == 11) i.value += "-";

		}
		
	</script>
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

	<h3 class="header_slogan">Adicionar Catador</h3>
	
	<article class="container">
	<form action="novo_catador.php" method="post" class="decoration">
		<div>
			<input type="text" name="nome" placeholder="Nome Completo"/>
			<input oninput="mascara_cpf(this)" type="text" name="cpf" placeholder="CPF"/>
			<input type="text" name="email" placeholder="Email"/>
			<input type="text" name="telefone" placeholder="Telefone"/>
			Data de Nascimento: <input type="date" name="dat_nasc" class="small">
		</div>
		
		<?php
		if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
		endif;
		?>
		
		<div class="button">
			<button type="submit" name="btn-continuar" class="continuar">Continuar</button>
		</div>

		</form>
	</article>

</body>
</html>
