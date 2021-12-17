<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'test';
$conn = mysqli_connect($host, $user,$pass,$db);
if (!$conn){
	die("Connection failed: " . mysqli_connect_error());
}
//echo "Conexion exitosa!";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista usuarios</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<div>
	<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Usuario</th>
			<th>Rol</th>
		</tr>
	<?php
	$query = mysqli_query($conn, "SELECT u.iduser, u.usnombre, u.ususuario, r.rol 
								FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
	$res = mysqli_num_rows($query);
	if ($res > 0){
		while ($data = mysqli_fetch_array($query)){
	?>
	<tr>
		<th><?php echo $data["iduser"]?></th>
		<th><?php echo $data["usnombre"]?></th>
		<th><?php echo $data["ususuario"]?></th>
		<th><?php echo $data["rol"]?></th>
	</tr>
	<?php		
		}
	}
	?>	
	</table>
</div>
</body>
</html>