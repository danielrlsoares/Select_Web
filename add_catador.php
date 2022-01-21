<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';

if(isset($_POST['btn-continuar'])):
	$erros = array();
	$nome=pg_escape_string($connect,$_POST['nome']);
	$cpf=pg_escape_string($connect,$_POST['cpf']);
	$dat_nasc = date('Y-m-d', strtotime($_POST['dat_nasc']));
	$sexo= $_POST['sexo'];
	
	$formatos = array("png", "jpeg", "jpg");
	$extensao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);

	if(in_array($extensao, $formatos)):
		$pasta = "arquivos/";
		$temporario = $_FILES['arquivo']['tmp_name'];
		$novonome = uniqid().".$extensao";
		
		if(move_uploaded_file($temporario, $pasta.$novonome)):
			$erros[] = "<li style='color:red;font-size:10pt;'>Upload Concluído</li>";
		else:
			$erros[] = "<li style='color:red;font-size:10pt;'>Erro no Upload!</li>";
		endif;
	else:
		$erros[] = "<li style='color:red;font-size:10pt;'>Formsto de arquivo não permitido</li>";
	endif;
	
	if(empty($nome) or empty($cpf) or empty($dat_nasc) or empty($sexo)):
		$erros[] = "<li style='color:red;font-size:10pt;'>Todos os campos devem ser preenchidos</li>";
	else:
		$sql="INSERT INTO catador(nome_catador, cpf_catador, sexo, dat_nasc, status) VALUES ('$nome', '$cpf', '$sexo', '$dat_nasc', 'ativo')";
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
		<form action="add_catador.php" method="post" enctype="multipart/form-data">
		<div>
			<input type="text" name="nome" placeholder="Nome Completo"/>
			<input oninput="mascara_cpf(this)" type="text" name="cpf" placeholder="CPF"/>
			Sexo:<br>
			<input type="radio" name="sexo" value="M" class="smaller"/>Masculino
			<input type="radio" name="sexo" value="F" class="smaller"/>Feminino
			<br>
			Data de Nascimento: <input type="date" name="dat_nasc" class="small">
			Foto: <input type="file" name="arquivo">
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
