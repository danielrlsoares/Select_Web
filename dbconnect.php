<?php
	$connect = pg_connect("dbname=db55a8h0e4vljr host=ec2-18-209-169-66.compute-1.amazonaws.com port=5432 user=wyqmbmqacelels password=63900f645cbea12d21dfb004b0eacabb657d72da0d7aa6f7490403d031099e2c sslmode=require");

	if (!$connect):
		echo "Falha na Conexão: ".pg_last_error();
	endif;
?> 
