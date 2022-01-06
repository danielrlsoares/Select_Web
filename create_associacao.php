<?php

	//Iniciar  Sessão
	session_start();
	
	$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.
        "User: ".$username.PHP_EOL.
        "-------------------------".PHP_EOL;
	//Save string to log, use FILE_APPEND to append.
	file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

	if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['telefone']) && isset($_POST['senha'])){
		$nome=mysqli_escape_string($connect,$_POST['nome']);
		$email=mysqli_escape_string($connect,$_POST['email']);
		$telefone=mysqli_escape_string($connect,$_POST['telefone']);
		$senha=mysqli_escape_string($connect,$_POST['senha']);
		
		$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
		"Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.
		"User: ".$username.PHP_EOL.
		"-------------------------".PHP_EOL;
		//Save string to log, use FILE_APPEND to append.
		file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
		
		$con = pg_connect(getenv("DATABASE_URL"));
		$sql="INSERT INTO associacao(nome_associacao,email_associacao,telefone_associacao, senha_associacao) VALUES ('$nome', '$email', '$telefone', '$senha')";
		
		$log  = "User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
		"Attempt: ".($result[0]['success']=='1'?'Success':'Failed').PHP_EOL.
		"User: ".$username.PHP_EOL.
		"-------------------------".PHP_EOL;
		//Save string to log, use FILE_APPEND to append.
		file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
		
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
