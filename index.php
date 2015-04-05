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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/materialize/css/materialize.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
  <script src="assets/jquery-2.1.3.min.js"></script>
  <script src="assets/materialize/js/materialize.min.js"></script>
  <script src="assets/js/styles.js"></script>




  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" type="text/css" href="assets/css/estilo.css"/>
  <script type="text/javascript" src="assets/js/cambiarPestanna.js"></script>

   


  <title>Desarrollo2</title>
</head>
<body>

  <?php if ((isset($_SESSION['logueado']))){ ?>
  <nav class="teal">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" ><img src="assets/images/logo.png"></a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>

        <ul class="right hide-on-med-and-down" >
         <!--  <form action="controladores/Principal.php">
            <input type="hidden" value="salir" name="salir">
            <button name="salir" class="btn-flat white-text">Salir</button>
          </form> -->
          <li> <a href="index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
          <li><a  href="vistas/compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
          <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Modulos &nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <?php } ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Mi Cuenta &nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Mi Perfil &nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          

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
        </ul>
        <ul id ="dropdown2" class="dropdown-content">   

        
            <li><a href="controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar <br>mis datos</a></li>
            <li><a href="#modal7" class="modal-trigger">Cambiar<br> contrasena</a></li>
            <li><a href="scripts/salir.php">Salir</a></li>
        </ul>

        <ul id="dropdown3" class="dropdown-content">
              <li><a href="vistas/crearProducto.php"> Mis<br> productos</a></li>
             <li><a href="vistas/visualizarPedido.php"> Visualizar<br> Pedidos</a></li>

            </ul> 
        

        <!-- responsive navbar -->
        <ul class="side-nav" id="mobile-demo">
         <img src="assets/images/logo.png">
          <li> <a href="index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
           <li><a  href="vistas/compras.php" ><i class = " mdi-action-shopping-cart left" class="modal-trigger"></i>Compra </a></li>
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown1" class="modal-trigger">&nbsp;&nbsp;Modulos <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown2" class="modal-trigger">&nbsp;&nbsp;Mi cuenta <i class="mdi-navigation-arrow-drop-down right"></i></a></li>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown3" class="modal-trigger">&nbsp;&nbsp;Mi perfil <i class="mdi-navigation-arrow-drop-down right"></i></a></li>

          <li><a href="scripts/salir.php" class="modal-trigger">&nbsp;&nbsp;Salir</a></li>
          <li><a href="#" >&nbsp;&nbsp;Opciones</a></li>
        </ul>
        
      </div>
    </div>
  </nav>


    <?php }else{ ?>    
  <nav class="teal">
    <div class="nav-wrapper">
      <div class="col s12">
       <a href="#!" ><img src="assets/images/logo.png"></a>
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
          <img src="assets/images/logo.png">
          <li><a href="#modal1" class="modal-trigger">&nbsp;&nbsp;Ingresa</a></li>
          <li><a href="#modal2" class="modal-trigger">&nbsp;&nbsp;Registrate</a></li>
        </ul>
      </div>
    </div>
  </nav>
 <!-- ******************************************************************** INDEX SIN LOGEARSE************************************************************************************** -->
   <div class="parallax-container ">
    <div class="parallax"> <img src="assets/images/parallax1.jpg" style = "display:block ; background-image: url(assets/images/parallax1.jpg)" /> 
      
   
  </div>
  <div class="section ">
    <div class="row container">
      <h6 class="header"></h6>

      <p class="grey-text text-darken-3 lighten-3">
        
        <div id = "izq"> <a href="#modal2" class="modal-trigger" > 
          <h5><p> &nbsp;&nbsp;&nbsp;&nbsp;¿Quieres comprar?<br>
            <b>&nbsp;&nbsp;&nbsp;&nbsp;Encuentra una buena oferta</b>
          </p></h5>
          <H3>&nbsp;&nbsp;&nbsp;VER OFERTAS</H3></a>

        </div>
         <div id = "der"><a href="#modal2" class="modal-trigger" > 
         <h5> <p>&nbsp;&nbsp;&nbsp;&nbsp;¿Quieres vender?<br>
                <b>&nbsp;&nbsp;&nbsp;&nbsp;Registrate y publica tus productos</b>
            </p></h5> 
            <h3>&nbsp;&nbsp;CREA TUS PRODUCTOS</h3></a>
          </div>
      </p>
    </div>
  </div>
  </div>





<!-- ********************************************************************************************************************************************************** -->
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
    <!-- ************************ -->
   




 <section id = "category-tree" > <!-- "contenedor de las categorias" -->
   <div class = "title-bar" >  <!-- titulo categorias -->
        <h4>Categorias</h4>
   </div>
   <div class="divider"></div>
  <div class="contenedor">
  <div id="pestanas">
      <ul id="lista">
          <li id="pestana1"><a href='javascript:cambiarPestanna(pestanas,pestana1);'><img src="assets/images/pc.png"></a>
          </li>
          <li id="pestana2"><a href='javascript:cambiarPestanna(pestanas,pestana2);'><img src="assets/images/vehiculo.png"></a>
          </li>
          <li id="pestana3"><a href='javascript:cambiarPestanna(pestanas,pestana3);'><img src="assets/images/tijera.png"></a>
          </li>
          <li id="pestana4"><a href='javascript:cambiarPestanna(pestanas,pestana4);'><img src="assets/images/casa.png"></a>
          </li>
          <li id="pestana5"><a href='javascript:cambiarPestanna(pestanas,pestana5);'><img src="assets/images/salud.png"></a>
          </li>
          <li id="pestana6"><a href='javascript:cambiarPestanna(pestanas,pestana6);'><img src="assets/images/libro.png"></a>
          </li>
          <li id="pestana0"><a href='javascript:cambiarPestanna(pestanas,pestana0);'></a>
          </li>
      </ul>
  </div>

      
  <body onload="javascript:cambiarPestanna(pestanas,pestana0);">
      <div id="contenidopestanas">
        <div id="cpestana0">
          <table style="width:100%">
               
                <tr>
                    <td><img src="assets/images/ch.jpg"></td>
                    <td><img src="assets/images/logo.jpg"></td>
                    <td><img src="assets/images/producto1.jpg"></td>
                </tr>
                <tr>
                    <td>Play Station 4 $1'000.000</td>
                    <td>Teclado Gamer $40.000</td>
                    <td>Tijera Corta Todo $12.000</td>
                </tr>
                <tr> <ul class="pagination pagination-lg" >
                  <td colspan="3">
                  <center>
                  <li class="waves-effect waves-teal"><a class="num"href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
                  <li class="waves-effect waves-teal"><a class="num"href="#!">1</a></li>
                  <li class="waves-effect waves-teal"><a class="num"href="#!">2</a></li>
                  <li class="waves-effect waves-teal"><a class="num"href="#!">3</a></li>
                  <li class="waves-effect waves-teal"><a class="num"href="#!">4</a></li>
                  <li class="waves-effect waves-teal"><a class="num"href="#!">5</a></li>
                  <li class="waves-effect waves-teal"><a class="num"href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
                  </center>
                  </td>
                 </ul>
                </tr>
            </table>
        </div>

        <div id="cpestana1">
            <table style="width:100%">

                 <tr>
                  <td colspan="3">
                    <!-- <div id="pestanas"> -->
                      <ul class="pagination pagination-lg" id="lista">
                        <center>
                          <li class="waves-effect waves-teal"><a class="num"href="#"><i class="mdi-navigation-chevron-left"></i></a></li>
                          <li class="waves-effect waves-teal" id="pestana20"><a class="num" href="'javascript:cambiarPestannaNum(pestanas,pestana20);'">1</a></li>
                          <li class="waves-effect waves-teal" id="pestana30"><a class="num" href="'javascript:cambiarPestannaNum(pestanas,pestana30);'">2</a></li>
                          <li class="waves-effect waves-teal" id="pestanaC"><a class="num"href="'javascript:cambiarPestannaNum(pestanas,pestanaC);'">3</a></li>
                          <li class="waves-effect waves-teal" id="pestanaD"><a class="num"href="'javascript:cambiarPestannaNum(pestanas,pestanaD);'">4</a></li>
                          <li class="waves-effect waves-teal" id="pestanaE"><a class="num"href="'javascript:cambiarPestannaNum(pestanas,pestanaE);'">5</a></li>
                          <li class="waves-effect waves-teal"><a class="num"href=""><i class="mdi-navigation-chevron-right"></i></a></li>
                        </center>
                      </ul>
                    <!-- </div> -->
                  </td>
                </tr>
              <div onload="javascript:cambiarPestanna(pestanas,pestana20);">
              <div id="cpestana20">
                    <tr>
                        <td><img src="assets/images/pc.jpg"></td>
                        <td><img src="assets/images/alejo.jpg"></td>
                        <td><img src="assets/images/isa.jpg"></td>
                    </tr>
                    <tr>
                        <td>Computador $120.000</td>
                        <td>Computador $500.000</td>
                        <td>Reloj $400.000</td>

                    </tr>
                    <tr>
                        <td><img src="assets/images/ch.jpg"></td>
                        <td><img src="assets/images/logo.jpg"></td>
                        <td><img src="assets/images/producto1.jpg"></td>
                    </tr>
                    <tr>
                        <td>Play Station 4 $1'000.000</td>
                        <td>Teclado Gamer $40.000</td>
                        <td>Tijera Corta Todo $12.000</td>
                    </tr>
              </div>
              
              <div id="cpestana30">
                    <tr>
                        <td><img src="assets/images/pc.jpg"></td>
                        <td><img src="assets/images/alejo.jpg"></td>
                        <td><img src="assets/images/isa.jpg"></td>
                    </tr>
                    <tr>
                        <td>Computador $120.000</td>
                        <td>Computador $500.000</td>
                        <td>Reloj $400.000</td>

                    </tr>
                    <tr>
                        <td><img src="assets/images/ch.jpg"></td>
                        <td><img src="assets/images/logo.jpg"></td>
                        <td><img src="assets/images/producto1.jpg"></td>
                    </tr>
                    <tr>
                        <td>Play Station 4 $1'000.000</td>
                        <td>Teclado Gamer $40.000</td>
                        <td>Tijera Corta Todo $12.000</td>
                    </tr>
              </div>
              </div>
            </table>
        </div>





        <div id="cpestana2">
            <table style="width:100%">
                <tr>
                    <td><img src="assets/images/alejo.jpg"></td>
                    <td><img src="assets/images/isa.jpg"></td>
                    <td><img src="assets/images/ch.jpg"></td>
                </tr>
                <tr>
                    <td>Computador $120.000</td>
                    <td>Computador $500.000</td>
                    <td>Reloj $400.000</td>
                </tr>
                <tr>
                    <td><img src="assets/images/logo.jpg"></td>
                    <td><img src="assets/images/producto1.jpg"></td>
                    <td><img src="assets/images/pc.jpg"></td>
                </tr>
                <tr>
                    <td>Play Station 4 $1'000.000</td>
                    <td>Teclado Gamer $40.000</td>
                    <td>Tijera Corta Todo $12.000</td>
                </tr>
            </table>
        </div>
        <div id="cpestana3">
            <table style="width:100%">
                <tr>
                    <td><img src="assets/images/isa.jpg"></td>
                    <td><img src="assets/images/ch.jpg"></td>
                    <td><img src="assets/images/logo.jpg"></td>
                </tr>
                <tr>
                    <td>Computador $120.000</td>
                    <td>Computador $500.000</td>
                    <td>Reloj $400.000</td>
                </tr>
                <tr>
                    <td><img src="assets/images/producto1.jpg"></td>
                    <td><img src="assets/images/pc.jpg"></td>
                    <td><img src="assets/images/alejo.jpg"></td>
                </tr>
                <tr>
                    <td>Play Station 4 $1'000.000</td>
                    <td>Teclado Gamer $40.000</td>
                    <td>Tijera Corta Todo $12.000</td>
                </tr>
            </table>
        </div>
        <div id="cpestana4">
            <table style="width:100%">
                <tr>
                    <td><img src="assets/images/ch.jpg"></td>
                    <td><img src="assets/images/logo.jpg"></td>
                    <td><img src="assets/images/producto1.jpg"></td>
                </tr>
                <tr>
                    <td>Computador $120.000</td>
                    <td>Computador $500.000</td>
                    <td>Reloj $400.000</td>
                </tr>
                <tr>
                    <td><img src="assets/images/pc.jpg"></td>
                    <td><img src="assets/images/alejo.jpg"></td>
                    <td><img src="assets/images/isa.jpg"></td>
                </tr>
                <tr>
                    <td>Play Station 4 $1'000.000</td>
                    <td>Teclado Gamer $40.000</td>
                    <td>Tijera Corta Todo $12.000</td>
                </tr>
            </table>
        </div>
        <div id="cpestana5">
            <table style="width:100%">
                <tr>
                    <td><img src="assets/images/logo.jpg"></td>
                    <td><img src="assets/images/producto1.jpg"></td>
                    <td><img src="assets/images/pc.jpg"></td>
                </tr>
                <tr>
                    <td>Computador $120.000</td>
                    <td>Computador $500.000</td>
                    <td>Reloj $400.000</td>
                </tr>
                <tr>
                    <td><img src="assets/images/alejo.jpg"></td>
                    <td><img src="assets/images/isa.jpg"></td>
                    <td><img src="assets/images/ch.jpg"></td>
                </tr>
                <tr>
                    <td>Play Station 4 $1'000.000</td>
                    <td>Teclado Gamer $40.000</td>
                    <td>Tijera Corta Todo $12.000</td>
                </tr>
            </table>
        </div>
        <div id="cpestana6">
            <table style="width:100%">
                <tr>
                    <td><img src="assets/images/producto1.jpg"></td>
                    <td><img src="assets/images/pc.jpg"></td>
                    <td><img src="assets/images/alejo.jpg"></td>
                </tr>
                <tr>
                    <td>Computador $120.000</td>
                    <td>Computador $500.000</td>
                    <td>Reloj $400.000</td>
                </tr>
                <tr>
                    <td><img src="assets/images/isa.jpg"></td>
                    <td><img src="assets/images/ch.jpg"></td>
                    <td><img src="assets/images/logo.jpg"></td>
                </tr>
                <tr>
                    <td>Play Station 4 $1'000.000</td>
                    <td>Teclado Gamer $40.000</td>
                    <td>Tijera Corta Todo $12.000</td>
                </tr>

            </table >
        </div>
      </div>
  </body>


</div>


 <!-- ********************** -->




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
 
