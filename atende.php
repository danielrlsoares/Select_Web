<?php
require_once 'dbconnect.php';
$id_cat = $_POST['catador'];
if(!empty($id_cat)):
	$id_ret = $_POST['id'];
	$sql = "INSERT INTO realiza_retirada(data_hora_retirada, catador_cod_catador, retirada_cod_solicitacao) VALUES(CURRENT_TIMESTAMP, $id_cat, $id_ret)";
	if(pg_query($connect, $sql)):
		$sql = "UPDATE retirada SET pendente=false WHERE cod_solicitacao=$id_ret";
		if(pg_query($connect, $sql)):
			$_SESSION['mensagem'] = "Atendido com sucesso!";
			header('Location: home.php');
		else:
			$_SESSION['mensagem'] = "Erro ao atender!";
			die(pg_last_error($connect));
		endif;
	else:
		$_SESSION['mensagem'] = "Erro ao atender!";
		die(pg_last_error($connect));
	endif;
endif;
?>
