<?php 
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
				<a href="../index.php" class="brand-logo">Logo</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
				<ul class="right hide-on-med-and-down">
					<?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
					<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Modulos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
					<?php } ?>
					<li><a class="dropdown-button" href="#!" data-activates="dropdown2">Mi Cuenta<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
				</ul>      
				<ul id ="dropdown1" class="dropdown-content">
					<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="gestionarPerfiles.php">Perfiles</a></li>
					<?php } ?>
					<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="gestionarUsuarios.php">Usuarios</a></li>
					<?php } ?>
				</ul>
				 <ul id ="dropdown2" class="dropdown-content">          
            		<li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar mis datos</a></li>
            		<li><a href="#modal7" class="modal-trigger">Cambiar contrasena</a></li>
					<li><a href="../scripts/salir.php">Salir</a></li>
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
					<span class="card-title teal-text">Registrar Perfil</span>  
					<form action="../controladores/CoordinadorPerfil.php" method="post">
						<?php if (isset($_SESSION['eRegistroPerfil'])) {	?>
								<div class="card">
									<div class="card-content">
									<?php foreach ($_SESSION['eRegistroPerfil'] as $key) { ?>
										<p><?php echo $key; ?></p>
									<?php } ?>
									</div>
								</div>        
						<?php } ?>              
						<div class="input-field">
							<input id="nombre" type="text" class="validate tooltipped" name="nombre" data-position="bottom" data-tooltip="Este campo es requerido, 4-30 caracteres alfabeticos">
							<label for="nombre">Nombre</label>
						</div>
						<div class="tooltipped" data-position="bottom" data-tooltip="Selecciona minimo un permiso">	
						<h6>Permisos:</h6>
						<p>
							<input type="checkbox" id="permiso2" name="permiso2">
							<label for="permiso2">Vender</label>
						</p>
						<p>
							<input type="checkbox" id="permiso1" name="permiso1">
							<label for="permiso1">Gestionar Usuarios</label>
						</p>
						<p>
							<input type="checkbox" id="permiso3" name="permiso3">
							<label for="permiso3">Gestionar Perfiles</label>
						</p>
						<br>
						<input class="btn-flat orange-text" type="submit" value="Guardar" name="crear">
						</div>
					</form>                     
				</div>
			</div>			
		</div>
		</div>
	</div>	
	<div id="modal7" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
          <span class="card-title teal-text">Cambiar Contrasena</span>  
          <form action="controladores/CoordinadorUsuario.php" method="post">   
              <?php if (isset($erroresCambiarPass)) {  ?>          
                <div class="card">
                  <div class="card-content">
                  <?php foreach ($erroresCambiarPass as $key) { ?>
                    <p><?php echo $key; ?></p>
                  <?php } ?>
                  </div>
                </div>        
              <?php } ?>           
            <div class="input-field">
              <input id="password" type="password" class="validate" name="passwordVieja">
              <label for="password">Contrasena Actual</label>
            </div> 
            <div class="input-field">
              <input id="password" type="password" class="validate" name="passwordNueva">
              <label for="password">Contrasena Nueva</label>
            </div>  
            <div class="input-field">
              <input id="password" type="password" class="validate" name="passwordNuevaC">
              <label for="password">Repite la Contrasena</label>
            </div>  
            <input class="btn-flat orange-text" type="submit" value="Guardar" name="cambiarPass">        
          </form>            
           <?php if (isset($erroresCambiarPass)) {
             echo "<script language='javascript'> $('#modal7').openModal(); </script>"; 
             unset($erroresCambiarPass);
             unset($_SESSION['eCambiarPass']);
          } ?>               
        </div>
      </div>
    </div>
</body>
</html>