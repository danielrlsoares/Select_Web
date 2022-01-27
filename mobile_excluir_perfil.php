<?php


	// connecting to db
	$con = pg_connect(getenv("DATABASE_URL"));

	$username = NULL;
	$password = NULL;
	$response = array();

	$isAuth = false;

	// Método para mod_php (Apache)
	if(isset( $_SERVER['PHP_AUTH_USER'])) {
		$username = $_SERVER['PHP_AUTH_USER'];
		$password = $_SERVER['PHP_AUTH_PW'];
	} // Método para demais servers
	elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
		if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION'])) 
			list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

	}

	// Se a autenticação não foi enviada
	if(!is_null($username)){
		$query = pg_query($con, "SELECT senha_usuario FROM usuario WHERE email_usuario='$username'");

		if(pg_num_rows($query) > 0){
			$row = pg_fetch_array($query);
			if($password == $row['senha_usuario']){
				$isAuth = true;
			}
		}
	}

	if ($isAuth){


		$result = pg_query($con, "DELETE * FROM usuario WHERE email_usuario = '$username'");

		if ($result){
			$response["success"] = 1;
		}
		else{
			$response["success"] = 0;
			$response["error"] = "Error BD: ".pg_last_error($con);
		}

	}
	else {
		$response["success"] = 0;
		$response["error"] = "Usuário não autenticado";
		
	}

pg_close($con);
echo json_encode($response);

?>