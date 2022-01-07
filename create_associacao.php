<?php

	//Iniciar  Sessão
	session_start();
	
	error_log("a sessão deve ter sido iniciada",0);

	if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['senha'])){
		$nome=mysqli_escape_string($connect,$_POST['nome']);
		$email=mysqli_escape_string($connect,$_POST['email']);
		$telefone=mysqli_escape_string($connect,$_POST['telefone']);
		$senha=mysqli_escape_string($connect,$_POST['senha']);
		
		error_log("entramos no if",0);
		
		$con = pg_connect(getenv("DATABASE_URL"));
		$sql="INSERT INTO associacao(nome_associacao,email_associacao,telefone_associacao, senha_associacao) VALUES ('$nome', '$email', '$telefone', '$senha')";
		
		error_log("passamos pela conexão e inserção de dados",0);
		
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
