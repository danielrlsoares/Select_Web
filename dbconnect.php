<?php
//Conexão com banco de dados
$con = pg_connect(getenv("postgres://duevzcajranagt:658b5f4795b11838c7490f9d231a646ba08fcfe4370d1f72ec57b12649695f54@ec2-3-211-240-42.compute-1.amazonaws.com:5432/d9h1pdr1idnnl"));

if(mysqli_connect_error()):
	echo "Falha na conexão: ". mysqli_connect_error();
endif;
?>
