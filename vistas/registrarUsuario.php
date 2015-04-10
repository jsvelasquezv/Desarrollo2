<?php 
  include_once '../scripts/gestionarUsuarios.php';
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
  <?php $perfiles = $_SESSION['perfiles']; ?>
<div class="container">
  <div class="row">
    
  <div class="col s12 m8 offset-m2 l6 offset-l3">
    <div class="card login">
      <div class="card-content">
    <span class="card-title teal-text">Resgistrar Usuario</span>  
        <form action="../controladores/CoordinadorUsuario.php" method="post"> 
          <?php if (isset($_SESSION['eRegistroUsuario'])) { ?>          
        <div class="card">
          <div class="card-content">
            <?php foreach ($_SESSION['eRegistroUsuario'] as $key) { ?>
              <p><?php echo $key; ?></p>
            <?php } ?>
          </div>
        </div>        
      <?php } ?>             
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
            <div class="col s6">
            <label for="perfil">Perfil</label>
              <select name="perfilSelec" class="scroll browser-default" id="perfil">
                <?php foreach ($perfiles as $key) { ?>
                  <option value="<?php echo $key['id']; ?>"> <?php echo $key['nombre']; ?> </option>
                <?php } ?>
              </select>
            </div>
            <div class="col s6">
            <label for="estado">Estado</label>
              <select name="estado" class="scroll browser-default" id="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <input class="btn-flat orange-text" type="submit" value="Registrar" name="registrar">
        </form>                        
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
             // header('Location: index.php');
          } 
             unset($_SESSION['eRegistroUsuario']);
          ?>               
        </div>
      </div>
    </div>
</body>
</html>