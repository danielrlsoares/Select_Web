<?php
	
// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));

// array for JSON response
$response = array();

$username = NULL;
$password = NULL;

// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// Se a autenticação não foi enviada
if(is_null($username)) {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}
// Se houve envio dos dados
else {
    $query = pg_query($con, "SELECT senha_usuario FROM usuario WHERE email_usuario='$username'");
	if(pg_num_rows($query) > 0){
		$row = pg_fetch_array($query);
		if($password == $row['senha_usuario']){
			
			$response["success"] = 1;
			
			$comando = pg_query($con, "SELECT * FROM usuario WHERE email_usuario='$username'");
			if($dados = pg_fetch_array($comando)){
				
				$response["email"] = $dados["email_usuario"];
				$response["nome"] = $dados["nome_usuario"];
				$response["dat_nasc"] = $dados["dat_nasc_usuario"];
				$response["cpf"] = $dados["cpf_usuario"];
				$response["telefone"] = $dados["telefone_usuario"];
				
			}
			
			
			
		}
		else {
			// senha ou usuario nao confere
			$response["success"] = 0;
			$response["error"] = "usuario ou senha não confere";
		}
	}
	else {
		// senha ou usuario nao confere
		$response["success"] = 0;
		$response["error"] = "usuario ou senha não confere";
	}
}
		
pg_close($con);
echo json_encode($response);
?>
