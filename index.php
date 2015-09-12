<?php 
    session_start();
    // unset($_SESSION['eLogin']);
    // unset($_SESSION['eRegistroUsuario']);
    // echo $_SESSION['eRecuperacion'];
    if (isset($_SESSION['eLogin'])) {
      $erroresLogin = $_SESSION['eLogin'];
    }
    if (isset($_SESSION['eRegistroUsuario'])) {
      $erroresRegistro = $_SESSION['eRegistroUsuario'];
    }
    if (isset($_SESSION['eRecuperacion'])) {
      $erroresRecuperacion = $_SESSION['eRecuperacion'];
    }
    if (isset($_SESSION['eCambiarPass'])) {
      $erroresCambiarPass = $_SESSION['eCambiarPass'];
    }
    if (isset($_SESSION['exitoRecuperacion'])) {
      $exitoRecuperacion = $_SESSION['exitoRecuperacion'];
    }
    if (isset($_SESSION['exitoRegistrar'])) {
      $exitoRegistrar = $_SESSION['exitoRegistrar'];
    }
    if (isset($_SESSION['exitoLogin'])) {
      $exitoLogin = $_SESSION['exitoLogin'];
    }
    if (isset($_SESSION['exitoCambiarPass'])) {
      $exitoCambiarPass = $_SESSION['exitoCambiarPass'];
    }
    if (isset($_SESSION['user'])) {
      $userMod = $_SESSION['user'];
    }
    // if (isset($_SESSION['eUpdateMiUsuario'])) {
    //   $errorModificarMiUsuario = $_SESSION['eUpdateMiUsuario'];
    // }
    if (isset($_SESSION['exitoModificarMiUsuario'])) {
      $exitoModificarMiUsuario = $_SESSION['exitoModificarMiUsuario'];
    }
?>
<!DOCTYPE html>
<html lang="en"> <!-- atributo para establecer el idioma-->
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/materialize/css/materialize.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
  <!-- <link rel="stylesheet" href="assets/css/style.css" type="text/css"> -->
  <link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'/>
  <script src="assets/jquery-2.1.3.min.js"></script>
  <script src="assets/materialize/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>
  <script src="assets/js/styles.js"></script>

  <title>Desarrollo2</title>
</head>
<body>
  <?php if ((isset($_SESSION['logueado']))){ ?>
  <nav class="teal"> <!-- esquema de colores por defecto -->
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="index.php" class="brand-logo" style ="font-family: 'Dancing Script', cursive;"><img src="assets/images/Imagen1.png">MarketFree...</a><!-- imagen de logo responsiva-->       
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
          <li> <a href="index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
          <li><a  href="vistas/productos.php" ><i class = "mdi-maps-layers left"></i>Productos de venta&nbsp; </a></li>
          <li><a  href="vistas/compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
         <!--  <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="mdi-action-account-box left"></i>Mi Cuenta<i class="mdi-navigation-arrow-drop-down right"></i></a></li> -->
        <li><a class="dropdown-button" href="#!" data-activates="dropdown3"><i class="mdi-social-person left"></i>Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="mdi-file-folder-shared left"></i>Modulos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
        </ul>   

        <ul id ="dropdown1" class="dropdown-content">
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
            <li><a href="vistas/gestionarPerfiles.php">Perfiles</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="vistas/gestionarUsuarios.php">Usuarios</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="vistas/categorias.php">Categorias</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="vistas/comision.php">Comision</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="vistas/facturasAdmin.php">Facturas</a></li>
          <?php } ?>
        </ul>
         <ul id="dropdown3" class="dropdown-content">
              <li><a href="vistas/crearProducto.php"> Mis<br> productos</a></li>
               <li><a href="vistas/visualizarPedido.php"> Visualizar<br> Pedidos</a></li>
               <li><a href="vistas/estadoCompras.php"> Mis<br> Compras</a></li>
              <li><a href="controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar mis datos</a></li>
              <li><a href="#modal7" class="modal-trigger">Cambiar<br> contrasena</a></li>
              <li><a href="scripts/salir.php">Salir</a></li>

         </ul>

        <!-- responsive navbar -->
        <ul class="side-nav" id="mobile-demo">
        <a href="#!" class="brand-logo"><img src="assets/images/Imagen1.png"></a>
         <br>
          <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
           <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left" class="modal-trigger"></i>Compra </a></li>
           <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown1" class="modal-trigger">&nbsp;&nbsp;Modulos <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown2" class="modal-trigger">&nbsp;&nbsp;Mi cuenta <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown3" class="modal-trigger">&nbsp;&nbsp;Mi perfil <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
           <li><a href="scripts/salir.php" class="modal-trigger">&nbsp;&nbsp;Salir</a></li>
          
        </ul>
        
      </div>
    </div>
  </nav>
  <!-- Presentación del index pagina de inicio-->
<!-- BANNER -->
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text">MarketFree</h1>
        <div class="row center">
          <h5 class="header col s12 light  white-text">Un lugar donde vender y comprar es muy fácil, ¿Qué esperas para unirte?</h5>
        </div>
        <!-- <div class="row center">
          <a href="#" id="download-button" class="modal-trigger btn-large waves-effect waves-light teal">Únete</a>
        </div> -->
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="assets/images/background1.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <!--Aqui contenedores laterales y centrales de la pagina de inicio-->
   <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center teal-text"><i class="mdi-communication-live-help"></i></h2>
            <h5 class="center">¿Quienes Somos?</h5>

            <p class="light">MarketFree es la Tienda Online más grande de la región pacífica, tenemos un catálogo con una gran variedad de artículos, productos y marcas de todo tipo que tendrás la posibilidad de comprar en Internet.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center teal-text"><i class="mdi-social-group"></i></h2>
            <h5 class="center">Comunidad</h5>

            <p class="light">La comunidad MarketFree siempre vela por el bienestar y la empatia entre todos los miembros, al pertenecer a la comunidad te sentiras como en casa, no dudes en elegirnos como una alternativa a tus compras y ventas por Internet.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center teal-text"><i class="mdi-maps-local-shipping"></i></h2>
            <h5 class="center">Envio Seguro</h5>

            <p class="light">Los clientes tienen la posibilidad de pagar en efectivo el instante en que reciben su producto en casa. En MarketFree tenemos un compromiso con nuestros clientes, así que puedes estar seguro de que vas a recibir tus productos en la puerta de tu hogar de forma segura, efectiva y rápida.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
    <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Nuestro objetivo es seguir creciendo y brindar la mejor atención a los usuarios que compran en nuestra tienda, somos los numero uno en la region, pero podemos ser los numero uno del pais, el mercado del Internet abre las puertas a un gran mundo que estámos dispuestos a enfrentar.</h5><br><br><br> 
        </div>
      </div>
    </div>
    <div class="parallax"><img src="assets/images/background2.jpg" alt="Unsplashed background img 2"></div>
  </div>
    <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send teal-text"></i></h3>
          <h4>Contact Us</h4>
          <p class="left-align light">Ponte en contacto directamente con MarketFree escribiendonos a proyectodesarrollo2@gmail.com, siempre estaremos al tanto de las dudas que puedan surgir y estaremos prestos a resolverlas lo mas pronto posible.</p>
        </div>
      </div>

    </div>
  </div>
  <!-- footer -->
    <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Y no olvides...</h5>
          <p class="white-text">Todo lo que no uses y quieras vender, véndelo en MarketFree, es la mejor desición.</p>


        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Derechos reservados MarketFree 2015
      </div>
    </div>
  </footer>

    <?php }else{ ?>    
  <nav class="teal">
    <div class="nav-wrapper">
      <div class="col s12">      
       <a href="#!" class="brand-logo" style ="font-family: 'Dancing Script', cursive;"><img src="assets/images/Imagen1.png">MarketFree...</a><!-- imagen de logo responsiva-->         <!-- imagen de logo responsiva-->
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="#modal1" class="modal-trigger">Ingresa</a></li>
          <li><a href="#modal2" class="modal-trigger">Registrate</a></li>
          <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Dropdown<i class="mdi-navigation-arrow-drop-down right"></i></a></li> -->
        </ul>
        
        <ul class="side-nav" id="mobile-demo">
          <li><a href="#modal1" class="modal-trigger">Ingresa</a></li>
          <li><a href="#modal2" class="modal-trigger">Registrate</a></li>
        </ul>
      </div>
    </div>
  </nav>
<!-- Presentación del index pagina de inicio-->
<!-- BANNER -->
  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text">MarketFree</h1>
        <div class="row center">
          <h5 class="header col s12 light  white-text">Un lugar donde vender y comprar es muy fácil, ¿Qué esperas para unirte?</h5>
        </div>
        <div class="row center">
          <a href="#modal2" id="download-button" class="modal-trigger btn-large waves-effect waves-light teal">Únete</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="assets/images/background1.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <!--Aqui contenedores laterales y centrales de la pagina de inicio-->
   <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center teal-text"><i class="mdi-communication-live-help"></i></h2>
            <h5 class="center">¿Quienes Somos?</h5>

            <p class="light">MarketFree es la Tienda Online más grande de la región pacífica, tenemos un catálogo con una gran variedad de artículos, productos y marcas de todo tipo que tendrás la posibilidad de comprar en Internet.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center teal-text"><i class="mdi-social-group"></i></h2>
            <h5 class="center">Comunidad</h5>

            <p class="light">La comunidad MarketFree siempre vela por el bienestar y la empatia entre todos los miembros, al pertenecer a la comunidad te sentiras como en casa, no dudes en elegirnos como una alternativa a tus compras y ventas por Internet.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center teal-text"><i class="mdi-maps-local-shipping"></i></h2>
            <h5 class="center">Envio Seguro</h5>

            <p class="light">Los clientes tienen la posibilidad de pagar en efectivo el instante en que reciben su producto en casa. En MarketFree tenemos un compromiso con nuestros clientes, así que puedes estar seguro de que vas a recibir tus productos en la puerta de tu hogar de forma segura, efectiva y rápida.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
    <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">Nuestro objetivo es seguir creciendo y brindar la mejor atención a los usuarios que compran en nuestra tienda, somos los numero uno en la region, pero podemos ser los numero uno del pais, el mercado del Internet abre las puertas a un gran mundo que estámos dispuestos a enfrentar.</h5><br><br><br> 
        </div>
      </div>
    </div>
    <div class="parallax"><img src="assets/images/background2.jpg" alt="Unsplashed background img 2"></div>
  </div>
    <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
          <h3><i class="mdi-content-send teal-text"></i></h3>
          <h4>Contact Us</h4>
          <p class="left-align light">Ponte en contacto directamente con MarketFree escribiendonos a proyectodesarrollo2@gmail.com, siempre estaremos al tanto de las dudas que puedan surgir y estaremos prestos a resolverlas lo mas pronto posible.</p>
        </div>
      </div>

    </div>
  </div>
  <!-- footer -->
    <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Y no olvides...</h5>
          <p class="white-text">Todo lo que no uses y quieras vender, publícalo en MarketFree, es la mejor desición.</p>


        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Derechos reservados MarketFree 2015
      </div>
    </div>
  </footer>
  
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
            <a href="#modal3" class="modal-trigger text-darken-2">Olvide mi contrasena</a>
          </form>                     
        </div>
      </div>
    </div>
  </div>    
</div>
<?php if (isset($erroresLogin)) {
      echo "<script language='javascript'> $('#modal1').openModal(); </script>"; 
    } ?>

<div class="valign-wrapper">
  <div class="col s12 m8 offset-m2 l4 offset-l3 valign">
   <div id="modal2" class="modal modalLogin">
    <div class="card login">
      <div class="card-content">
        <span class="card-title teal-text">Resgistrarse</span>  
        <form action="controladores/CoordinadorUsuario.php" method="post">  
            <?php if (isset($erroresRegistro)) {  ?>          
                <div class="card">
                  <div class="card-content">
                  <?php foreach ($erroresRegistro as $key) { ?>
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
            <div class="col s12">
              <input type="hidden" name="perfilSelec" value="2">
              <!-- <select name="perfilSelec">
                <option value="1">Perfil 1</option>
                <option value="2">Perfil 2</option>
                <option value="3">Perfil 3</option>
              </select> -->
            </div>
          </div>
          <div class="row">
            <input class="btn-flat orange-text" type="submit" value="Registrarse" name="registrarse">
            <input class="btn-flat orange-text" type="submit" value="Cancelar" name="cancelarRI">
          </div>
        </form>   
        <?php if (isset($erroresRegistro)) {
      echo "<script language='javascript'> $('#modal2').openModal(); </script>"; 
    } ?>                  
      </div>
    </div>
  </div>
</div>    
</div>
<div class="valign-wrapper">
    <div class="col s12 m8 offset-m2 l4 offset-l3 valign">
     <div id="modal3" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
          <span class="card-title teal-text">Recuperar Contrasena</span>  
          <form action="controladores/CoordinadorUsuario.php" method="post"> 
            <?php if (isset($erroresRecuperacion)) {  ?>          
                <div class="card">
                  <div class="card-content">
                  <?php foreach ($erroresRecuperacion as $key) { ?>
                    <p><?php echo $key; ?></p>
                  <?php } ?>
                  </div>
                </div>        
              <?php } ?>         
            <label for="">
              Se enviara la contrasena a tu correo
            </label>      
            <div class="input-field">
              <input id="correo" type="text" class="validate" name="correo">
              <label for="correo">Correo</label>
            </div>  
            <input class="btn-flat orange-text" type="submit" value="Enviar" name="recuperar">        
          </form>       
          <?php if (isset($erroresRecuperacion)) {
             echo "<script language='javascript'> $('#modal3').openModal(); </script>"; 
             unset($erroresRecuperacion);
             unset($_SESSION['eRecuperacion']);
             // header('Location: index.php');
          } ?>                      
        </div>
      </div>
    </div>
  </div>    
</div>
 <div id="modal4" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
          <span class="card-title teal-text">Se ha enviado la contrasena</span> 
            <p>Por favor verifica en la carpeta de spam.</p> 
        </div>
          <?php if (isset($exitoRecuperacion)) {
             echo "<script language='javascript'> $('#modal4').openModal(); </script>"; 
             unset($_SESSION['exitoRecuperacion']);
          } ?>                      
      </div>
    </div>
   <div id="modal5" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Te has registrado correctamente</span> 
            <p>Por favor logueate</p> 
        </div>
          <?php if (isset($exitoRegistrar)) {
             echo "<script language='javascript'> $('#modal5').openModal(); </script>"; 
             unset($_SESSION['exitoRegistrar']);
          } ?>                      
      </div>
    </div>
     <div id="modal6" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Bienvenido</span> 
            <p>Has iniciado sesion correctamente</p> 
        </div>
          <?php if (isset($exitoLogin)) {
             echo "<script language='javascript'> $('#modal6').openModal(); </script>"; 
             unset($_SESSION['exitoLogin']);
          } ?>                      
      </div>
    </div>
      <!-- HOLAAAA -->
 <!--    <div id="modal20" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Contraseña Incorrecta</span> 
            <p>Tu contraseña es incorrecta</p> 
        </div>
          <?php if (! isset($exitoLogin)) {
             echo "<script language='javascript'> $('#modal20').openModal(); </script>"; 
             unset($_SESSION['exitoLogin']);
          } ?>                      
      </div> -->
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
    </div>
     <div id="modal8" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha cambiado la contrasena de tu cuenta</p> 
        </div>
          <?php if (isset($exitoCambiarPass)) {
             echo "<script language='javascript'> $('#modal8').openModal(); </script>"; 
             unset($_SESSION['exitoCambiarPass']);
          } ?>                      
      </div>
    </div>
    <div id="modal9" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se han modificado los datos de tu cuenta</p> 
        </div>
          <?php if (isset($exitoModificarMiUsuario)) {
             echo "<script language='javascript'> $('#modal9').openModal(); </script>"; 
             unset($_SESSION['exitoModificarMiUsuario']);
          } ?>                      
      </div>
    </div>
</body>
</html>