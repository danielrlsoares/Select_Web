<?php
require_once 'dbconnect.php';

if(isset($_GET['id'])):
	$id = $_GET['id'];	
	$sql="DELETE FROM catador WHERE cod_catador=$id";
	
	if(pg($connect, $sql)):
			$_SESSION['mensagem'] = "Deletado com sucesso!";
			header('Location: catadores.php');
		else:
			$_SESSION['mensagem'] = "Erro ao deletar!";
			die(pg_last_error($connect));
	endif;
endif
?>
