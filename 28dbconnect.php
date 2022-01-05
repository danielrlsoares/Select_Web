<?php
//Conexão com banco de dados
$servername = "ec2-3-211-240-42.compute-1.amazonaws.com"; //endereço do servidor
$username="duevzcajranagt";
$password="658b5f4795b11838c7490f9d231a646ba08fcfe4370d1f72ec57b12649695f54";
$db_name="d9h1pdr1idnnl";

//pdo - somente orientado objeto
$connect =mysqli_connect($servername,$username,$password,$db_name);

//codifica com o caracteres ao manipular dados do banco de dados
//mysqli_set_charset($connect, "utf8");

if(mysqli_connect_error()):
	echo "Falha na conexão: ". mysqli_connect_error();
endif;
?>
