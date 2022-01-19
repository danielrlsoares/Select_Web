<?php
require_once 'dbconnect.php';

if(isset($_GET['id'])):
	$id = $_GET['id'];	
	$sql="DELETE FROM associacao WHERE cod_catador=$id";
	
	if(mysqli_query($connect, $sql)):
			$_SESSION['mensagem'] = "Deletado com sucesso!";
			header('Location: index.php');
		else:
			$_SESSION['mensagem'] = "Erro ao deletar!";
			die(mysqli_error($connect));
	endif;
endif
?>
