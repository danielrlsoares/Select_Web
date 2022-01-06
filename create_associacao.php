<?php

	//Iniciar  Sessão
	session_start();

	if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['senha'])){
		$nome=mysqli_escape_string($connect,$_POST['nome']);
		$email=mysqli_escape_string($connect,$_POST['email']);
		$telefone=mysqli_escape_string($connect,$_POST['telefone']);
		$senha=mysqli_escape_string($connect,$_POST['senha']);
		
		$con = pg_connect(getenv("postgres://duevzcajranagt:658b5f4795b11838c7490f9d231a646ba08fcfe4370d1f72ec57b12649695f54@ec2-3-211-240-42.compute-1.amazonaws.com:5432/d9h1pdr1idnnl"));
		$sql="INSERT INTO associacao(nome_associacao,email_associacao,telefone_associacao, senha_associacao) VALUES ('$nome', '$email', '$telefone', '$senha')";
		
		echo $sql;
		if(pg_query($con, $sql)){
			$_SESSION['mensagem'] = "Cadastro com sucesso!";
			pg_close($con);
		}
		else{
			$_SESSION['mensagem'] = "Erro ao cadastrar!";	
			pg_close($con);
		}
	}	
?>
