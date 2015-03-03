<?php 
 $nombre = $_GET['nombre'];
 $permiso1 = $_GET['permiso1'];
 $permiso2 = $_GET['permiso2'];
 $permiso3 = $_GET['permiso3'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../assets/materialize/css/materialize.min.css" type="text/css">
	<link rel="stylesheet" href="../assets/css/styles.css" type="text/css">
	<script src="../assets/jquery-2.1.3.min.js"></script>
	<script src="../assets/materialize/js/materialize.min.js"></script>
	<script src="../assets/js/styles.js"></script>
	<title>Desarrollo2</title>
</head>
<body>
	<div class="container">
		<div class="row">			
		<div class="col s12 m8 offset-m2 l6 offset-l3">
			<div class="card">
				<div class="card-content">
					<span class="card-title teal-text">Editar Perfil</span>  
					<form action="../controladores/CoordinadorPerfil.php" method="post">            
						<div class="input-field">
							<input id="nombre" type="text" class="validate" name="nuevoNombre" value="<?php echo $nombre; ?>">
							<label for="nombre">Nombre</label>
						</div>
						<input type="hidden" name="antiguo" value="<?php echo $nombre; ?>">
						<h6>Permisos:</h6>
						<p>
							<input type="checkbox" id="permiso2" name="permiso2"/>
							<label for="permiso2">Vender</label>
						</p>
						<p>
							<input type="checkbox" id="permiso1" name="permiso1"/>
							<label for="permiso1">Gestionar Usuarios</label>
						</p>
						<p>
							<input type="checkbox" id="permiso3" name="permiso3"/>
							<label for="permiso3">Gestionar Perfiles</label>
						</p>
						<br>
						<input class="btn-flat orange-text" type="submit" value="Guardar" name="editar">
					</form>                     
				</div>
			</div>			
		</div>
		</div>
	</div>	
</body>
</html>