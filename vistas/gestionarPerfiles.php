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
					<li><a class="dropdown-button " href="#!" data-activates="dropdown1">Opciones<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
				</ul>
				<ul id ="dropdown1" class="dropdown-content">
					<li><a href="../vistas/gestionarPerfiles.php">Perfiles</a></li>
          			<li><a href="../vistas/gestionarUsuarios.php">Usuarios</a></li>
				</ul>
				<ul class="side-nav" id="mobile-demo">
					<li><a href="#modal1" class="modal-trigger">Salir</a></li>
					<li><a href="#modal2" class="modal-trigger">Opciones</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php }else{ header('Location: ../index.php');}?>    
	<div class="container">		
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
						 <td> <?php echo $key['permiso_gestionar_perfiles'];?> </td> <?php
					?> </tr> <?php 
				} ?>
			</tbody>
		</table>	
	</div>
</body>
</html>