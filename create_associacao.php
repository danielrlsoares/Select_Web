<?php

	//Iniciar  Sessão
	session_start();

	//Conexão
	require_once 'dbconnect.php';

	if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['senha'])){
		$nome=mysqli_escape_string($connect,$_POST['nome']);
		$email=mysqli_escape_string($connect,$_POST['email']);
		$telefone=mysqli_escape_string($connect,$_POST['telefone']);
		$senha=mysqli_escape_string($connect,$_POST['senha']);
		
		$sql="INSERT INTO associacao(nome_associacao,email_associacao,telefone_associacao, senha_associacao) VALUES ('$nome', '$email', '$telefone', '$senha')";
		echo $sql;
		if(mysqli_query($connect,$sql))
			$_SESSION['mensagem'] = "Cadastro com sucesso!";
		}
		else{
			$_SESSION['mensagem'] = "Erro ao cadastrar!";		
		}
	}	
?>
