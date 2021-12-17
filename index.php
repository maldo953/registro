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

//formulario
//variables
$alerta = '';
$char = '';
//
if (!empty($_POST)){
	if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['clave']) 
		|| empty($_POST['rclave'])|| empty($_POST['tusuario'])){
		$alerta = "<p class='advertencia'>Llene todos los campos</p>";
	}else{
		$nombre   = $_POST['nombre'];
		$usuario  = $_POST['usuario'];
		$clave    = sha1($_POST['clave']);
		$rclave   = sha1($_POST['rclave']);
		$tusuario = $_POST['tusuario'];
		
		$query = mysqli_query($conn, "SELECT * FROM usuario WHERE ususuario = '$usuario'");
		$result = mysqli_fetch_array($query);
		if($result > 0){
			$alerta = "<p class='error'>El usuario ya existe</p>";
		}elseif ($clave != $rclave){
			$alerta = "<p class='advertencia'>Las claves no son iguales</p>";
		}elseif($clave < 5 || $rclave <5){
			$char = "<p style='font-size: 12px;color: #f00;'>Ingrese minimo 5 caracteres</p>";
		}else{
			$query_insert = mysqli_query($conn, "INSERT INTO usuario (usnombre,ususuario,usclave,rol) VALUES ('$nombre',
				'$usuario','$clave','$tusuario')");
			if ($query_insert){
				$alerta = "<p class='success'>Datos almacenados</p>";
			}else{
				$alerta = "<p class='error'>Error al guardar</p>";
			}
		}
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
	<?php include ('header.php'); ?>
	<div class="div_formulario">
		<div class="msj">
			<p><?php echo $alerta; ?></p>
		</div>
		<h1>REGISTRO</h1>
		<form action="" method="POST" class="form">
			<div class="div_input">
				<label class="lbl">Nombre</label><br>
				<input autofocus type="text" name="nombre" class="input" id="input">	
			</div>
			<div class="div_input">
				<label class="lbl">Usuario</label><br>
				<input type="text" name="usuario" class="input" id="input">	
			</div>
			<div class="div_input">
				<label class="lbl">Clave</label><br>
				<input type="password" name="clave" class="input" id="input">
				<p><?php echo $char; ?></p>
			</div>
			<div class="div_input">
				<label class="lbl">Repetir clave</label><br>
				<input type="password" name="rclave" class="input" id="input">
			</div>
			<div class="div_input">
				<label class="lbl">Tipo usuario</label><br>
				<?php
					$query_rol = mysqli_query($conn,"SELECT * FROM rol");
					$res_rol = mysqli_num_rows($query_rol);
				?>	
				<select name="tusuario" class="select" id="select">
					<option value="">Seleccione rol</option>
					<?php
					if($res_rol > 0){
						while ($rol = mysqli_fetch_array($query_rol)){
					?>
					<option value="<?php echo $rol["idrol"]?>"><?php echo $rol["rol"]?></option>
					<?php

						}
					}	
					?>
				</select>
			</div>
			<div class="div_input">
				<input type="submit" class="btn" id="btn" value="Registrar">	
			</div>
			<div class="div_input">
				<a href="verusuario.php">Lista de usuarios</a>
			</div>
		</form>
	</div>
</body>
</html>