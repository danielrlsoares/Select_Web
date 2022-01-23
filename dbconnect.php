<?php
	$connect = pg_connect("dbname=dailr9leul3p1p host=ec2-3-228-236-221.compute-1.amazonaws.com port=5432 user=voukeobejiosyj password=6ab4e41340e8a97f2e3157e91c876be8cfa971cb236d9a1279d91d14ff1e9b66 sslmode=require");

	if (!$connect):
		echo "Falha na Conexão: ".pg_last_error();
	endif;
?> 
