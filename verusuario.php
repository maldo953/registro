<?php
$host = 'ec2-54-235-98-1.compute-1.amazonaws.com';
$user = 'jhibweezzjbide';
$pass = 'bf1f62a08e6436628a371bea946db8e7ede7b072b702a6e31c4dd69a4b1e1554';
$db = 'd23i4qcajjc7hk';
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
