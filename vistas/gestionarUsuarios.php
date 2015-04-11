<?php 
	include_once '../scripts/gestionarUsuarios.php';
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
				<a href="../index.php" style ="font-family: 'Dancing Script', cursive; font-size: 50px;"><img src="../assets/images/Imagen1.png">MarketFree...</a>
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
				<ul class="right hide-on-med-and-down">
           <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
           <li> <a href="productos.php"><i class="mdi-maps-layers left" class="modal-trigger"></i>Productos en venta</a></li>
          <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
          <li><a class="dropdown-button " href="#!" data-activates="dropdown1">Modulos&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Mi Cuenta&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
        </ul>
        <ul id ="dropdown1" class="dropdown-content">
          <li><a href="../vistas/gestionarPerfiles.php">Perfiles</a></li>
          <li><a href="../vistas/gestionarUsuarios.php">Usuarios</a></li>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="categorias.php">Categorias</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="comision.php">Comision</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="facturasAdmin.php">Facturas</a></li>
          <?php } ?>
        </ul>
         <ul id ="dropdown2" class="dropdown-content">   
            <li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar<br> mis datos</a></li>
            <li><a href="#modal7" class="modal-trigger">Cambiar<br> contrasena</a></li>
					  <li><a href="../scripts/salir.php">Salir</a></li>
        </ul>
         <ul id="dropdown3" class="dropdown-content">
              <li><a href="crearProducto.php"> Mis<br> productos</a></li>
               <li><a href="visualizarPedido.php"> Visualizar<br> Pedidos</a></li>
              <li><a href="estadoCompras.php"> Mis<br> Compras</a></li>
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
	<?php $perfiles = $_SESSION['perfiles']; ?>
	<div class="container">		
    <br>
    <div class="row">
      <h4>Usuarios</h4>
      <form action="../controladores/CoordinadorUsuario.php" method="post">
        <div class="row">
         <div class="input-field col s6 tooltipped" data-position="right" data-tooltip="Presiona enter para buscar" >
              <i class="mdi-action-search prefix"></i>
              <input id="emailB" type="text" class="validate" name="emailB">
              <label for="emailB">Ingresa un documento para buscar</label>
              <input type="submit" class="btn col s3 offset-s1" name="buscar" value="Buscar" style='display:none;'>
            </div>
        </div>
      </form>
    </div>
		<table class="hoverable responsive-table">
			<thead>
				<tr>
					<th>Documento</th>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>Username</th>
					<th>E-mail</th>
					<th>Perfil</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>				
				<?php foreach ($_SESSION['usuarios'] as $key) {
					?> <tr>
						 <td> <?php echo $key['documento'];?> </td> 
						 <td> <?php echo $key['nombre'];?> </td> 
						 <td> <?php echo $key['apellidos'];?> </td>
						 <td> <?php echo $key['nombre_usuario'];?> </td>
						 <td> <?php echo $key['email'];?> </td>
						 <td> <?php $nom = $perfiles[$key['tipo_perfil']];
						 echo $nom['nombre'];?> </td>      
						 <td> <?php echo $key['estado'];?> </td> 
						 <td><a href="../controladores/CoordinadorUsuario.php?editUsuario=<?php echo $key['documento'] ?>" class="grey-text text-darken-3" name="edit" id="edit"><i class="mdi-image-edit small"></i></a></td>
						 <td><a href="../controladores/CoordinadorUsuario.php?down=<?php echo $key['documento'] ?>" class="grey-text text-darken-3 tooltipped" name="down" id="down" data-tooltip="Remover Usuario"><i class="mdi-action-highlight-remove small"></i></a></td> <?php
					?> </tr> <?php 
				} ?>
			</tbody>
		</table>	
	</div>
	<div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
		<a class="btn-floating btn-large waves-effect waves-light red right modal-trigger tooltipped" href="#modal" data-tooltip="Nuevo usuario"><i class="mdi-content-add"  ></i></a>
	</div>
	<div class="col s12 m8 offset-m2 l4 offset-l3 valign">
   <div id="modal" class="modal modalLogin">
    <div class="card login">
      <div class="card-content">
        <span class="card-title teal-text">Resgistrar</span>  
        <form action="../controladores/CoordinadorUsuario.php" method="post"> 
        	<?php if (isset($_SESSION['eRegistroUsuario'])) {	?>					
				<div class="card">
					<div class="card-content">
						<?php foreach ($_SESSION['eRegistroUsuario'] as $key) { ?>
							<p><?php echo $key; ?></p>
						<?php } ?>
					</div>
				</div>        
			<?php } unset($_SESSION['eRegistroUsuario'])?>             
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate" name="nombre">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s6">
              <input id="apellido" type="text" class="validate" name="apellido">
              <label for="apellido">Apellidos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Username</label>
            </div>
            <div class="input-field col s6">
              <input id="password" type="password" class="validate" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="documento" type="text" class="validate" name="documento">
              <label for="documento">Documento</label>
            </div>
            <div class="input-field col s6">
              <input id="email" type="text" class="validate" name="email">
              <label for="email">E-mail</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <select name="perfilSelec" class="scroll browser-default">
              	<?php foreach ($perfiles as $key) { ?>
                	<option value="<?php echo $key['id']; ?>"> <?php echo $key['nombre']; ?> </option>
              	<?php } ?>
                <!-- <option value="2">Perfil 2</option>
                <option value="3">Perfil 3</option> -->
              </select>
            </div>
          </div>
          <input class="btn-flat orange-text" type="submit" value="Registrarse" name="registrar">
        </form>                     
      </div>
    </div>
  </div>
  <?php if (isset($_SESSION['eRegistroUsuario'])) {
			echo "<script language='javascript'> $('#modal').openModal(); </script>"; 
		} ?>
</div>   
<div id="modal2" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha creado correctamente el usuario</p> 
        </div>
          <?php if (isset($exitoRegistrar)) {
             echo "<script language='javascript'> $('#modal2').openModal(); </script>"; 
             unset($_SESSION['exitoRegistrar']);
          } ?>                      
      </div>
    </div>
    <div id="modal3" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha modificado correctamente el usuario</p> 
        </div>
          <?php if (isset($exitoModificar)) {
             echo "<script language='javascript'> $('#modal3').openModal(); </script>"; 
             unset($_SESSION['exitoModificar']);
          } ?>                      
      </div>
    </div>
    <div id="modal4" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Error</span> 
            <p>No se encuentra un usuario con ese documento</p> 
        </div>
          <?php if (isset($errorBuscarPerfil)) {
             echo "<script language='javascript'> $('#modal4').openModal(); </script>"; 
             unset($_SESSION['eBuscar']);
          } ?>                      
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
             // header('Location: index.php');
          } ?>               
        </div>
      </div>
    </div>
</body>
</html>