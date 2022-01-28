<!DOCTYPE html>
<html>
<head>
	<title>Select - Foto</title>
	<meta charset="utf-8">
</head>
<?php
require_once 'dbconnect.php';

$id=$_GET['id'];
$sql0="SELECT * FROM retirada WHERE cod_solicitacao=$id";
$resultado0=pg_query($connect, $sql0);
$dados_ret = pg_fetch_array($resultado0)
?>

<body>
	<img src="<?php echo $dados_ret['foto_material']; ?>" height="500">
</body>
</html>
