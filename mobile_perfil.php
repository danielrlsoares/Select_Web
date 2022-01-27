<?php

	// connecting to db
	$con = pg_connect(getenv("DATABASE_URL"));

	// array for JSON response
	$response = array();
	
	$email = NULL;
	$nome = NULL;
	$dat_nasc = NULL;
	$cpf = NULL;
	$telefone = NULL;
	
	$result = pg_query($con, "SELECT * FROM usuario WHERE email_usuario='$email'");
	$result = pg_fetch_array($result);
	
	$lista = array();
	$lista["email"] = $result["email_usuario"];
	$lista["nome"] = $result["nome_usuario"];
	$lista["dat_nasc"] = $result["dat_nasc_usuario"];
	$lista["cpf"] = $result["cpf_usuario"];
	$lista["telefone"] = $result["telefone_usuario"];
	
	$response["succsses"] = 1;
	$response["lista"] = array();
	
	array_push($response["lista"], $lista);
	
	pg_close($con);
	echo json_encode($response);
?>