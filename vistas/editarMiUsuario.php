<?php 
  session_start();
	$documento = $_GET['documento'];
	$nombre = $_GET['nombre'];
	$apellidos = $_GET['apellidos'];
	$email = $_GET['email'];
	$username = $_GET['username'];
	/*echo " 
                <script language='JavaScript'> 
                alert('JavaScript dentro de PHP'); 
                </script>";*/
  //echo $errorModificar =  $_SESSION['eMiUsuario'];
  if (isset($_SESSION['eMiUsuario'])) {
    $errorModificar = $_SESSION['eMiUsuario'];
  }
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
        <a href="../index.php" class="brand-logo" style ="font-family: 'Dancing Script', cursive; font-size: 40px;"><img src="../assets/images/Imagen1.png">MarketFree...</a><!-- imagen de logo responsiva-->       
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
          <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
          <li><a  href="productos.php" ><i class = "mdi-maps-layers left"></i>Productos de venta&nbsp; </a></li>
          <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="mdi-file-folder-shared left"></i>Modulos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="mdi-action-account-box left"></i>Mi Cuenta&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown3"><i class="mdi-social-person left"></i>Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
        </ul>      
        <ul id ="dropdown1" class="dropdown-content">
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
          <li><a href="gestionarPerfiles.php">Perfiles</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
          <li><a href="gestionarUsuarios.php">Usuarios</a></li>
           <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="categorias.php">Categorias</a></li>
          <?php } ?>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
          <li><a href="comision.php">Comision</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="facturasAdmin.php">Facturas</a></li>
          <?php } ?>
        </ul>
        <ul id ="dropdown2" class="dropdown-content"> 
                <li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar <br>mis datos</a></li>
                <li><a href="#modal7" class="modal-trigger">Cambiar <br>contrasena</a></li>
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
<div class="container">
  <br>
  <div class="row">
    <h4>Modificar mis datos</h4>
    <br><br>
    
  <div class="col s12 m8 offset-m2 l6 offset-l3">
    <div class="card login">
      <div class="card-content">
        <span class="card-title teal-text">Editar Usuario</span>  
        <form action="../controladores/CoordinadorUsuario.php" method="post">  
          <?php if (isset($errorModificar)) {  ?>
                <div class="card">
                  <div class="card-content">
                  <?php foreach ($errorModificar as $key) { ?>
                    <p><?php echo $key; ?></p>
                  <?php } ?>
                  </div>
                </div>        
            <?php } ?>     
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate" name="Minombre" value="<?php echo $nombre; ?>">
              <label for="nombre">Nombre</label>
            </div>
          <input type="hidden" name="antiguo" value="<?php echo $documento; ?>">          
            <div class="input-field col s6">
              <input id="apellido" type="text" class="validate" name="Miapellido" value="<?php echo $apellidos; ?>">
              <label for="apellido">Apellidos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="username" type="text" class="validate" name="Miusername" value="<?php echo $username; ?>">
              <label for="username">Username</label>
            </div>
            <div class="input-field col s6">
              <input id="documento" type="text" class="validate" name="Midocumento" value="<?php echo $documento; ?>">
              <label for="documento">Documento</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" type="text" class="validate" name="Miemail" value="<?php echo $email; ?>">
              <label for="email">E-mail</label>
            </div>
          </div>
          <input class="btn-flat orange-text" type="submit" value="Guardar" name="editMiUsuario">
           <!-- FALTA ___funcionalidad para regresar -->
        </form>                     
      </div>
    </div>
  </div>
  </div>
  <div id="modal1" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se han modificado los datos de tu cuenta</p> 
        </div>
          <?php if (isset($exito)) {
             echo "<script language='javascript'> $('#modal1').openModal(); </script>"; 
             unset($_SESSION['exitoModificarMiUsuario']);
          } ?>                      
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