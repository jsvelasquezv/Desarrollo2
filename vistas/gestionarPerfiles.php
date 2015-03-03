<?php 
include_once '../scripts/gestionarPerfiles.php';
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
		<table class="hoverable responsive-table centered">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Gestionar Usuarios</th>
					<th>Vender</th>
					<th>Gestionar Perfiles</th>
				</tr>
			</thead>
			<tbody>				
				<?php foreach ($_SESSION['perfiles'] as $key) {
					?> <tr>
					<td> <?php echo $key['nombre'];?> </td>
					<td> <?php echo $key['permiso_gestionar_usuarios'];?> </td>
					<td> <?php echo $key['permiso_vender'];?> </td>      
					<td> <?php echo $key['permiso_gestionar_perfiles'];?> </td>
					<td><a href="../controladores/CoordinadorPerfil.php?edit=<?php echo $key["nombre"] ?>" class="btn-flat" name="edit" id="edit"><i class="mdi-image-edit"></i></a></td> <?php
					?> </tr> <?php 
				} ?>
			</tbody>
		</table>	
		</div>
		<div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
			<a class="btn-floating btn-large waves-effect waves-light red right modal-trigger" href="#modal1"><i class="mdi-content-add"></i></a>
		</div>
		<div class="valign-wrapper">
			<div class="col s12 m8 offset-m2 l4 offset-l3 valign">
				<div id="modal1" class="modal modalLogin">
					<div class="card login">
						<div class="card-content">
							<span class="card-title teal-text">Crear Perfil</span>  
							<form action="../controladores/CoordinadorPerfil.php" method="post">            
								<div class="input-field col m4 l2 tooltipped" data-position="right" data-tooltip="Este campo es requerido">
									<input id="nombre" type="text" name="nombre"  required maxlength="30">
									<label for="nombre">Nombre</label>
								</div>
								<h6>Permisos:</h6>
								<p>
    								<input type="checkbox" id="permiso1" name="permiso1"/>
    								<label for="permiso1">Gestionar Usuarios</label>
  								</p>
   								<p>
    								<input type="checkbox" id="permiso2" name="permiso2"/>
    								<label for="permiso2">Vender</label>
  								</p>
  								<p>
    								<input type="checkbox" id="permiso3" name="permiso3"/>
    								<label for="permiso3">Gestionar Perfiles</label>
  								</p>
  								<br>
								<input class="btn-flat orange-text" type="submit" value="Crear" name="crear">
							</form>                     
						</div>
					</div>
				</div>
			</div>    
		</div>
	</div>
</body>
</html>