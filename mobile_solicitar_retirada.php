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
	echo "Funciona!";
	echo $_POST['rua'];
	if ( isset($_POST['rua']) && isset($_POST['bairro']) && isset($_POST['cidade']) && isset($_POST['numero']) && isset($_POST['uf']) && isset($_POST['cep']) && isset($_POST['referencia']) && isset($_POST['material']) && isset($_FILES['foto']) ) {

		$response["success"] = 1;

		$rua = trim($_POST['rua']);
		$bairro = trim($_POST['bairro']);
		$cidade = trim($_POST['cidade']);
		$numero = trim($_POST['numero']);
		$uf = trim($_POST['uf']);
		$cep = trim($_POST['cep']);
		$referencia = trim($_POST['referencia']);
		$material = trim($_POST['material']);

		$imageFileType = strtolower(pathinfo(basename($_FILES['foto']),PATHINFO_EXTENSION)); //['rua']
		$image_base64 = base64_encode(file_get_contents($_FILES['foto']) ); //['tmp_name']
		$foto = 'data:image/'.$imageFileType.';base64,'.$image_base64;

		$result_endereco = pg_query($con, "INSERT INTO endereco(rua, bairro, cidade, numero, uf, cep, referencia) VALUES('$rua', '$bairro', '$cidade', '$numero', '$uf', '$cep', '$referencia') RETURNING cod_endereco");
		$id_endco = pg_fetch_array($result_endereco,0)[0];
		$result_retirada = pg_query($con, "INSERT INTO retirada(material, foto_material, data_hora_solicitacao, endereco_cod_endereco, usuario_email_usuario) VALUES('$material', '$img', now(), $id_endco , $username )");
	}
	else{
	
		$response["success"] = 0;
		$response["error"] = "Error BD: ".pg_last_error($con);
	}

}
	
	
	
pg_close($con);
echo json_encode($response);

?>
