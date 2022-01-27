<?php
require_once 'dbconnect.php';
session_start();

$id = $_SESSION['email_associacao'];	
$sql="DELETE FROM catador WHERE associacao_email_associacao='$id'";

if(pg_query($connect, $sql)):
	$sql="DELETE FROM associacao WHERE email_associacao='$id'";
	if(pg_query($connect, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: index.php');
	else:
		$_SESSION['mensagem'] = "Erro ao deletar!";
		die(pg_last_error($connect));
	endif;
endif;
?>
