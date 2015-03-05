<?php 
    session_start(); 
    // if (!isset($_SESSION['perfilesCargados'])) {
    //   header('Location: scripts/init.php');
    // }
    // $sesion = $_SESSION['perfilesCargados'];
    // echo $sesion[0];
    if (isset($_SESSION['eLogin'])) {
      $erroresLogin = $_SESSION['eLogin'];
      echo $erroresLogin;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/materialize/css/materialize.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
  <script src="assets/jquery-2.1.3.min.js"></script>
  <script src="assets/materialize/js/materialize.min.js"></script>
  <script src="assets/js/styles.js"></script>

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
         <!--  <form action="controladores/Principal.php">
            <input type="hidden" value="salir" name="salir">
            <button name="salir" class="btn-flat white-text">Salir</button>
          </form> -->
          <li><a href="scripts/salir.php">Salir</a></li>
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Opciones<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
        </ul>      
        <ul id ="dropdown1" class="dropdown-content">
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
            <li><a href="vistas/gestionarPerfiles.php">Perfiles</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
            <li><a href="vistas/gestionarUsuarios.php">Usuarios</a></li>
          <?php } ?>
        </ul>

        <!-- responsive navbar -->
        <ul class="side-nav" id="mobile-demo">
          <li><a href="#modal1" class="modal-trigger">Salir</a></li>
          <li><a href="#modal2" class="modal-trigger">Opciones</a></li>
        </ul>
        
      </div>
    </div>
  </nav>
    <?php }else{ ?>    
  <nav class="teal">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="brand-logo">Logo</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="#modal1" class="modal-trigger">Ingresa</a></li>
          <li><a href="#modal2" class="modal-trigger">Registrate</a></li>
          <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Dropdown<i class="mdi-navigation-arrow-drop-down right"></i></a></li> -->
        </ul>
        <!-- <ul id ="dropdown1" class="dropdown-content">
          <li><a href="#!">one</a></li>
          <li><a href="#!">two</a></li>
          <li class="divider"></li>
          <li><a href="#!">three</a></li>
        </ul> -->
        <ul class="side-nav" id="mobile-demo">
          <li><a href="#modal1" class="modal-trigger">Ingresa</a></li>
          <li><a href="#modal2" class="modal-trigger">Registrate</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <?php } ?>
  <div class="valign-wrapper">
    <div class="col s12 m8 offset-m2 l4 offset-l3 valign">
     <div id="modal1" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
          <span class="card-title teal-text">Ingresar</span>  
          <form action="controladores/CoordinadorUsuario.php" method="post">   
              <?php if (isset($erroresLogin)) {  ?>          
                <div class="card">
                  <div class="card-content">
                  <?php foreach ($erroresLogin as $key) { ?>
                    <p><?php echo $key; ?></p>
                  <?php } ?>
                  </div>
                </div>        
              <?php } ?>           
            <div class="input-field col m4 l2">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Usuario</label>
            </div>
            <div class="input-field">
              <input id="password" type="password" class="validate" name="password">
              <label for="password">Contrasena</label>
            </div>  
            <input class="btn-flat orange-text" type="submit" value="Ingresar" name="ingresar">        
            <button class="btn-flat orange-text" name="recuperar">Olvide mi contrasena</button>
          </form>                     
        </div>
      </div>
    </div>
  </div>    
</div>

<div class="valign-wrapper">
  <div class="col s12 m8 offset-m2 l4 offset-l3 valign">
   <div id="modal2" class="modal modalLogin">
    <div class="card login">
      <div class="card-content">
        <span class="card-title teal-text">Resgistrarse</span>  
        <form action="controladores/CoordinadorUsuario.php" method="post">            
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
              <input type="hidden" name="perfilSelec" value="2">
              <!-- <select name="perfilSelec">
                <option value="1">Perfil 1</option>
                <option value="2">Perfil 2</option>
                <option value="3">Perfil 3</option>
              </select> -->
            </div>
          </div>
          <input class="btn-flat orange-text" type="submit" value="Registrarse" name="registrarse">
        </form>                     
      </div>
    </div>
  </div>
</div>    
</div>
</body>
</html>