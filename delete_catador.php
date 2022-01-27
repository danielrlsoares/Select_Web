<?php
require_once 'dbconnect.php';
session_start();

if(isset($_GET['id'])):
	$id = $_GET['id'];
	$sql="DELETE FROM realiza_retirada WHERE catador_cod_catador=$id";
	if(pg_query($connect, $sql)):
		$sql="DELETE FROM catador WHERE cod_catador=$id";
		if(pg_query($connect, $sql)):
			$_SESSION['mensagem'] = "Deletado com sucesso!";
			header('Location: catadores.php');
		else:
			$_SESSION['mensagem'] = "Erro ao deletar!";
			die(pg_last_error($connect));
		endif;
	else:
		$_SESSION['mensagem'] = "Erro ao deletar!";
		die(pg_last_error($connect));
	endif;
endif
?>
