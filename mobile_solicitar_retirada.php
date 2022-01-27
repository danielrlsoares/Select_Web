<?php

// connecting to db
$con = pg_connect(getenv("DATABASE_URL"));


$response = array();

if ( isset($_POST["rua"]) && isset($_POST["bairro"]) && isset($_POST["cidade"]) && isset($_POST["numero"]) && isset($_POST["uf"]) && isset($_POST["cep"]) && isset($_POST["referencia"]) && isset($_POST["material"]) && isset($_POST["foto"]) ) {
	
	$rua = trim($_POST["rua"]);
	$bairro = trim($_POST["bairro"]);
	$cidade = trim($_POST["cidade"]);
	$numero = trim($_POST["numero"]);
	$uf = trim($_POST["uf"]);
	$cep = trim($_POST["cep"]);
	$referencia = trim($_POST["referencia"]);
	$material = trim($_POST["material"]);
	$foto = trim($_POST["foto"]);
	
	$result_endereco = pg_query($con, "INSERT INTO endereco(rua, bairro, cidade, numero, uf, cep, referencia) VALUES('$rua', '$bairro', '$cidade', '$numero', '$uf', '$cep', '$referencia')");
	$result_retirada = pg_query($con, "INSERT INTO retirada(material, foto_material) VALUES('$material', '$foto')");
	
	$response["success"] = 1;
	
}

pg_close ($con);
echo json_encode($response);

?>