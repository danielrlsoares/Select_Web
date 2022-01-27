<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome']) && isset($_POST['dat_nasc']) && isset($_POST['cpf']) && isset($_POST['telefone'])) {
 
	$email = trim($_POST['email']);
	$senha = trim($_POST['senha']);
	$nome = trim($_POST['nome']);
	$dat_nasc = trim($_POST['dat_nasc']);
	$date = new DateTime(str_replace('/', '-', $dat_nasc));
	$date_bd = $date->format('Y-m-d H:i:s');
	$cpf = trim($_POST['cpf']);
	$telefone = trim($_POST['telefone']);
	
	$usuario_existe = pg_query($con, "SELECT email_usuario FROM usuario WHERE email_usuario='$email'");
	// check for empty result
	if (pg_num_rows($usuario_existe) > 0) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	}
	else {
		// mysql inserting a new row
		$result = pg_query($con, "INSERT INTO usuario(email_usuario, senha_usuario, nome_usuario, dat_nasc_usuario, cpf_usuario, telefone_usuario) VALUES('$email', '$senha', '$nome', '$date_bd', '$cpf', '$telefone')");
	 
		if ($result) {
			$response["success"] = 1;
		}
		else {
			$response["success"] = 0;
			$response["error"] = "Error BD: ".pg_last_error($con);
		}
	}
}
else {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}

pg_close($con);
echo json_encode($response);
?>