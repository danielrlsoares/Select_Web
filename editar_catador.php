<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';

if(isset($_GET['id'])):
	$id = $_GET['id'];
		
	$sql = "SELECT * FROM catador WHERE cod_catador=$id";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);
endif;

if(isset($_POST['btn-confirmar'])):
		$erros=array();
		$id = $_POST['id'];
		$nome=mysqli_escape_string($connect,$_POST['nome']);
		$cpf=mysqli_escape_string($connect,$_POST['cpf']);
		$dat_nasc = date('Y-m-d', strtotime($_POST['dat_nasc']));
		$sexo= $_POST['sexo'];
		
		$sql="UPDATE catador SET nome_catador='$nome', cpf_catador='$cpf', dat_nasc='$dat_nasc', sexo='$sexo' WHERE cod_catador=$id";
		
		if(mysqli_query($connect, $sql)):
				$_SESSION['mensagem'] = "Editado com sucesso!";
				header('Location: catadores.php');
		else:
			$_SESSION['mensagem'] = "Erro ao editar!";
			die(mysqli_error($connect));
		endif;
endif;
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
		
		function mascara_data(i){
   
		   var v = i.value;
		   
		   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
			  i.value = v.substring(0, v.length-1);
			  return;
		   }
		   
		   i.setAttribute("maxlength", "10");
		   if (v.length == 2 || v.length == 5) i.value += "/";

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
				<li><a href="perfil.php">Associação</a></li>
				<li class="active"><a href="catadores.php">Catadores</a></li>
				<li><a href="dicas.html">Ajuda</a></li>					
				<li><a href="logout.php">Sair</a></li>
		   </div>
		</ul>
	</nav>

	<h3 class="header_slogan">Alterar dados do Catador</h3>

	
	<article class="container">
		<form action="editar_catador.php" method="post">
		<div>
			<input type="hidden" name="id" value="<?php echo $dados['cod_catador']; ?>"/>
			<input type="text" name="nome" value="<?php echo $dados['nome_catador']; ?>"/>
			<input oninput="mascara_cpf(this)" type="text" name="cpf" value="<?php echo $dados['cpf_catador']; ?>"/>
			Sexo:<br>
			<input type="radio" name="sexo" value="M" class="smaller" 
			<?php if($dados['sexo']=="M"):
				echo "checked";
			endif;?>/>Masculino
			<input type="radio" name="sexo" value="F" class="smaller"
			<?php if($dados['sexo']=="F"):
				echo "checked";
			endif;?>/>Feminino
			<br>
			Data de Nascimento: <input type="date" name="dat_nasc" class="small" value="<?php echo $dados['dat_nasc']; ?>">
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
