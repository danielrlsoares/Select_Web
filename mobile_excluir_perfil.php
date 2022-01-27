<?php

	// connecting to db
	$con = pg_connect(getenv("DATABASE_URL"));
	
	$email = email;
	
	pg_query($con, "DELETE * FROM usuario WHERE email_usuario='$email'");
	$response = 1;
	
	
	pg_close($con);
	echo json_encode($response);

?>