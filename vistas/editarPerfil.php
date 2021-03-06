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
	<link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'/>
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
				<a href="../index.php" class="brand-logo" style ="font-family: 'Dancing Script', cursive;"><img src="../assets/images/Imagen1.png">MarketFree...</a><!-- imagen de logo responsiva-->       
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
          <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
          <li><a  href="productos.php" ><i class = "mdi-maps-layers left"></i>Productos de venta&nbsp; </a></li>
          <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
           <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="mdi-action-account-box left"></i>Mi Cuenta&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li> -->
            <li><a class="dropdown-button" href="#!" data-activates="dropdown3"><i class="mdi-social-person left"></i>Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="mdi-file-folder-shared left"></i>Modulos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
				</ul>      
				<ul id ="dropdown1" class="dropdown-content">
					<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="gestionarPerfiles.php">Perfiles</a></li>
					<?php } ?>
					<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="gestionarUsuarios.php">Usuarios</a></li>
					<?php } ?>
					<?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="categorias.php">Categorias</a></li>
          <?php } ?>
          			<?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
					<li><a href="comision.php">Comision</a></li>
					<?php } ?>
					<?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="facturasAdmin.php">Facturas</a></li>
          <?php } ?>
				</ul>
				 <ul id="dropdown3" class="dropdown-content">
              		<li><a href="crearProducto.php"> Mis<br> productos</a></li>
              		<li><a href="visualizarPedido.php"> Visualizar<br> Pedidos</a></li>
               		<li><a href="estadoCompras.php"> Mis<br> Compras</a></li>
              		<li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar <br>mis datos</a></li>
              		<li><a href="#modal7" class="modal-trigger">Cambiar<br> contrasena</a></li>
              		<li><a href="../scripts/salir.php">Salir</a></li>
        		</ul>

              <ul class="side-nav" id="mobile-demo">
              	<img src="../assets/images/logo.png">
                <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
           <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left" class="modal-trigger"></i>Compra </a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown1" class="modal-trigger">&nbsp;&nbsp;Modulos <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown2" class="modal-trigger">&nbsp;&nbsp;Mi cuenta <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown3" class="modal-trigger">&nbsp;&nbsp;Mi perfil <i class="mdi-navigation-arrow-drop-down right"></i></a></li>

          <li><a href="scripts/salir.php" class="modal-trigger">&nbsp;&nbsp;Salir</a></li>
           <li><a href="#" >&nbsp;&nbsp;Opciones</a></li>
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
										<p><?php echo $key;?></p>
									<?php } ?>
									</div>
								</div>        
						<?php unset($_SESSION['eUpdatePerfil']);} ?>              
						<div class="input-field">
							<input id="nombre" type="text" class="validate tooltipped" name="nuevoNombre" value="<?php echo $nombre; ?>"  data-position="bottom" data-tooltip="Este campo es requerido, 4-30 caracteres alfabeticos">
							<label for="nombre">Nombre</label>
						</div>
						<input type="hidden" name="antiguo" value="<?php echo $nombre; ?>">
						<div class="tooltipped" data-position="bottom" data-tooltip="Selecciona minimo un permiso">	
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
						<a  href="gestionarPerfiles.php" class="button" type="submit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atras</a>
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
          <form action="../controladores/CoordinadorUsuario.php" method="post">   
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
             // header('Location: index.php');
          } ?>               
        </div>
      </div>
    </div>
</body>
</html>