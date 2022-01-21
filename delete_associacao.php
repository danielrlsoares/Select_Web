<?php
require_once 'dbconnect.php';

if(isset($_GET['id'])):
	$id = $_GET['id'];	
	$sql="DELETE FROM associacao_catador WHERE fk_cod_associacao=$id";
	
	if(pg($connect, $sql)):
		$sql="DELETE FROM associacao WHERE cod_associacao=$id";
		if(pg($connect, $sql)):
			$_SESSION['mensagem'] = "Deletado com sucesso!";
			header('Location: index.php');
		else:
			$_SESSION['mensagem'] = "Erro ao deletar!";
			die(pg_last_error($connect));
	endif;
endif
?>
