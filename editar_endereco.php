<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';

if(isset($_GET['id'])):
	$id = $_GET['id'];
		
	$sql = "SELECT * FROM endereco WHERE cod_endereco=$id";
	$resultado = pg_query($connect, $sql);
	$dados = pg_fetch_array($resultado);
endif;

if(isset($_POST['btn-confirmar'])):
	$erros=array();
	$id=$_POST['id'];
	$rua=pg_escape_string($connect,$_POST['rua']);
	$cep=pg_escape_string($connect,$_POST['cep']);
	$numero=pg_escape_string($connect,$_POST['numero']);
	$complemento=pg_escape_string($connect,$_POST['complemento']);
	$uf=pg_escape_string($connect,$_POST['uf']);
	$cidade=pg_escape_string($connect,$_POST['cidade']);
	$bairro=pg_escape_string($connect,$_POST['bairro']);
	$referencia=pg_escape_string($connect, $_POST['referencia']);
	
	$sql="UPDATE endereco SET rua='$rua', cep='$cep', numero='$numero', complemento='$complemento', uf='$uf', cidade='$cidade', bairro='$bairro', referencia='$referencia' WHERE cod_endereco=$id";
	
	if(pg_query($connect, $sql)):
			$_SESSION['mensagem'] = "Editado com sucesso!";
			header('Location: endereco.php');
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
	
	<script>
		function mascara_cep(i){
   
		   var v = i.value;
		   
		   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
			  i.value = v.substring(0, v.length-1);
			  return;
		   }
		   
		   i.setAttribute("maxlength", "9");
		   if (v.length == 5) i.value += "-";

		}
	</script>
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
		<form action="editar_endereco.php" method="post" class="decoration">
		<div>
			<input type="hidden" name="id" value="<?php echo $dados['cod_endereco']; ?>"/>
			<input type="text" name="rua" value="<?php echo $dados['rua']; ?>"/>
			<input oninput="mascara_cep(this)" type="text" name="cep" class="small" value="<?php echo $dados['cep']; ?>"/>
			<input type="text" name="numero" class="smaller" value="<?php echo $dados['numero']; ?>" placeholder="Número"/>
			<input type="text" name="complemento" class="small" value="<?php echo $dados['complemento']; ?>" placeholder="Complemento"/>  
			<input type="text" name="uf" class="smaller" value="<?php echo $dados['uf']; ?>"/>
			<input type="text" name="cidade" class="small" value="<?php echo $dados['cidade']; ?>"/> 
			<input type="text" name="bairro" class="small" value="<?php echo $dados['bairro']; ?>"/>
			<input type="text" name="referencia" value="<?php echo $dados['referencia']; ?>" placeholder="Referência"/>
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


