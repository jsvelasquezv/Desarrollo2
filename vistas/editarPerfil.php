<?php 
 $nombre = $_GET['nombre'];
 $permiso1 = $_GET['permiso1'];
 $permiso2 = $_GET['permiso2'];
 $permiso3 = $_GET['permiso3'];
 session_start();
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
	<?php if ((isset($_SESSION['logueado']))){ ?>
	<nav class="teal">
		<div class="nav-wrapper">
			<div class="col s12">
				<a href="#!" class="brand-logo">Logo</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="../scripts/salir.php">Salir</a></li>
					<?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
					<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Opciones<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
					<?php } ?>
				</ul>      
				<ul id ="dropdown1" class="dropdown-content">
					<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="gestionarPerfiles.php">Perfiles</a></li>
					<?php } ?>
					<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="gestionarUsuarios.php">Usuarios</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<?php }else{ header('Location: ../index.php');}?>    
	<div class="container">
		<div class="row">			
		<div class="col s12 m8 offset-m2 l6 offset-l3">
			<div class="card">
				<div class="card-content">
					<span class="card-title teal-text">Editar Perfil</span>  
					<form action="../controladores/CoordinadorPerfil.php" method="post">
						<?php if (isset($_SESSION['eUpdatePerfil'])) {	?>
								<div class="card">
									<div class="card-content">
									<?php foreach ($_SESSION['eUpdatePerfil'] as $key) { ?>
										<p><?php echo $key; ?></p>
									<?php } ?>
									</div>
								</div>        
						<?php } ?>              
						<div class="input-field">
							<input id="nombre" type="text" class="validate" name="nuevoNombre" value="<?php echo $nombre; ?>">
							<label for="nombre">Nombre</label>
						</div>
						<input type="hidden" name="antiguo" value="<?php echo $nombre; ?>">
						<h6>Permisos:</h6>
						<p>
							<input type="checkbox" id="permiso2" name="permiso2" <?php if ($permiso2==1) {echo "checked"; } ?> >
							<label for="permiso2">Vender</label>
						</p>
						<p>
							<input type="checkbox" id="permiso1" name="permiso1" <?php if ($permiso1==1) {echo "checked"; } ?> >
							<label for="permiso1">Gestionar Usuarios</label>
						</p>
						<p>
							<input type="checkbox" id="permiso3" name="permiso3" <?php if ($permiso3==1) {echo "checked"; } ?> >
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