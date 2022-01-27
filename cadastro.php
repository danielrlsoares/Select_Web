<!DOCTYPE html>
<html>

<?php
require_once 'dbconnect.php';
session_start();

if(isset($_POST['btn-continuar'])):
	$erros = array();
	$nome=pg_escape_string($connect,$_POST['nome']);
	$telefone=pg_escape_string($connect,$_POST['telefone']);
	$senha=pg_escape_string($connect,$_POST['senha']);
	
	if($email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)):
		$email=pg_escape_string($connect,$_POST['email']);
	else:
		if(!empty($email)):
			$erros[] = "<li style='color:red;font-size:10pt;'>Email inválido!</li>";
		endif;
	endif;
	
	$rua=pg_escape_string($connect,$_POST['rua']);
	$cep=pg_escape_string($connect,$_POST['cep']);
	$numero=pg_escape_string($connect,$_POST['numero']);
	$complemento=pg_escape_string($connect,$_POST['complemento']);
	$uf=pg_escape_string($connect,$_POST['uf']);
	$cidade=pg_escape_string($connect,$_POST['cidade']);
	$bairro=pg_escape_string($connect,$_POST['bairro']);
	$ref=pg_escape_string($connect,$_POST['referencia']);
	
	if(empty($nome) or empty($email) or empty($telefone) or empty($senha) or empty($rua) or empty($cep) or empty($numero) or empty($uf) or empty($cidade) or empty($bairro)):
		$erros[] = "<li style='color:red;font-size:10pt;'>Alguns campos são obrigatórios!</li>";
	else:
		$sql="INSERT INTO endereco(rua, cep, numero, complemento, uf, cidade, bairro, referencia) VALUES ('$rua', '$cep', '$numero', '$complemento', '$uf', '$cidade', '$bairro', '$ref') RETURNING cod_endereco";
		$result = pg_query($connect, $sql);
		$id_endco = pg_fetch_array($result,0)[0];
		if(pg_query($connect, $sql)):
			$_SESSION['mensagem'] = "Cadastro com sucesso!";
			header('Location: index.php');
		else:
			$_SESSION['mensagem'] = "Erro ao cadastrar!";
			$erros[] = "<li style='color:red;font-size:10pt;'>Erro ao cadastrar: ".die(pg_last_error($connect))."</li>";
		endif;
				
		$sql = "SELECT * FROM endereco WHERE cod_endereco=$id_endco";
		$resultado = pg_query($connect, $sql);
		
		if(pg_num_rows($resultado) == 1):
			$dados = pg_fetch_array($resultado);
			$cod_endereco = $dados['cod_endereco'];
		endif;
		
		$senha=md5($senha);
		$sql="INSERT INTO associacao(nome_associacao, email_associacao, telefone_associacao, senha_associacao, endereco_cod_endereco) VALUES ('$nome', '$email', '$telefone', '$senha', '$cod_endereco')";
		if(pg_query($connect, $sql)):
			header('Location: index.php');
		else:
			$erros[] = "<li style='color:red;font-size:10pt;'>Erro ao cadastrar: ".die(pg_error($connect))."</li>";
		endif;
	endif;
endif;
pg_close($connect);	
?>

<head>
	<title>Select - Cadastro</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
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
   
	<h3 class="header_slogan">Cadastro</h3>

	<article class="container">
		<form action="cadastro.php" method="post" class="decoration">
		<div>
			<input type="text" name="nome" placeholder="Nome da Associação"/>
			<input type="text" name="email" placeholder="Email"/>
			<input type="text" name="telefone" placeholder="Telefone"/>
			<input type="password" name="senha" placeholder="Senha"/>
			<h4>Endereço</h4>
			<input type="text" name="rua" placeholder="Rua"/>
			<input oninput="mascara_cep(this)" type="text" name="cep" class="small" placeholder="CEP"/>
			<input type="text" name="numero" class="smaller" placeholder="Nº"/>
			<input type="text" name="complemento" class="small" placeholder="Complemento"/>  
			<input type="text" name="uf" class="smaller" placeholder="UF"/>
			<input type="text" name="cidade" class="small" placeholder="Cidade"/> 
			<input type="text" name="bairro" class="small" placeholder="Bairro"/>
			<input type="text" name="referencia" placeholder="Referência"/>
			
			
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
		<div class="button">
			<button type="button" class="cancelar" onclick= "window.location.href = 'index.php'">Cancelar</button>
		</div>
		</form>
	</article>
</body>
</html>
