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
  <link href='http://fonts.googleapis.com/css?family=Dancing+Script:400,700' rel='stylesheet' type='text/css'/>
  <script src="assets/jquery-2.1.3.min.js"></script>
  <script src="assets/materialize/js/materialize.min.js"></script>
  <script src="assets/js/styles.js"></script>

  <title>Desarrollo2</title>
</head>
<body>
  <?php if ((isset($_SESSION['logueado']))){ ?>
  <nav class="teal"> <!-- esquema de colores por defecto -->
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="index.php" class="brand-logo" style ="font-family: 'Dancing Script', cursive; font-size: 40px;"><img src="assets/images/Imagen1.png">MarketFree...</a><!-- imagen de logo responsiva-->       
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
          <li> <a href="index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
          <li><a  href="vistas/productos.php" ><i class = "mdi-maps-layers left"></i>Productos de venta&nbsp; </a></li>
          <li><a  href="vistas/compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="mdi-file-folder-shared left"></i>Modulos<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="mdi-action-account-box left"></i>Mi Cuenta<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown3"><i class="mdi-social-person left"></i>Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
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

        <ul id ="dropdown2" class="dropdown-content">          
            <li><a href="controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar mis datos</a></li>
            <li><a href="#modal7" class="modal-trigger">Cambiar<br> contrasena</a></li>
            <li><a href="scripts/salir.php">Salir</a></li>
        </ul>

         <ul id="dropdown3" class="dropdown-content">
              <li><a href="vistas/crearProducto.php"> Mis<br> productos</a></li>
               <li><a href="vistas/visualizarPedido.php"> Visualizar<br> Pedidos</a></li>
               <li><a href="vistas/estadoCompras.php"> Mis<br> Compras</a></li>

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

<!-- Contenedor en el index -->
  <div class="row">     
          <div class="col s12 m4 l3">
              <div class="col s3">               
                  <h3 class="teal-text">Categorias</h3>  
              </div>
              <br>
              <br>
              <br>
              <br>
              <ul class="collection">
            <li class="collection-item avatar">
                <img src="assets/images/casa.png" alt="" class="circle">
                  <span class="title">Hogar</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/libro.png" alt="" class="circle">
                  <span class="title">Libro</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/musica.png" alt="" class="circle">
                  <span class="title">Musica</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/oficina.png" alt="" class="circle">
                  <span class="title">Oficina</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/salud.png" alt="" class="circle">
                  <span class="title">Salud</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/pc.png" alt="" class="circle">
                  <span class="title">Tecnologia</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/vehiculo.png" alt="" class="circle">
                  <span class="title">Transporte</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            


          </ul>
           
           </div>
        
          <div class="col s12 m8 l9"> 
               <div class="col s9">
               <br>
               <h5 class="teal-text">Productos</h5> 
               <br> 
                        
            <table class="responsive-table">
                  <thead>
                      <tr> 

                        <td data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/iphone5.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Iphone 5<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Iphone 5 <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo: $650.000.  Celular en buenas condiciones, de color negro para que tengas una experiencia inigualable.  </p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </td> 

                      <td data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/computador.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Computador<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Computador<i class="mdi-navigation-close right"></i></span>
                                              <p>Costo: $1.500.000  Computador lenovo de color negro.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </td> 
                                        
                
                      <th data-field="id">
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/Videojuego.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">God of war<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">God of war <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$50.000. Sensacional juego con gráficos excelentes. Para divertirte en tus tardes tristes.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/nintendo.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Nintendo<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Nintendo <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$50.000.  Para que revivas tu infancia con juegos del nintendo.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th> 
                  </tr>
                  <tr>
                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/mesa.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Mesa de centro<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Mesa de centro<i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$100.000. Decora tu casa y tu sala con esta elegante mesa.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/comedor.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Comedor  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Comedor <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$450.000  Disfruta de tus comidas de una manera comoda.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>  

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/microondas.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Microondas  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Microondas <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$200.000 Calienta tus comidas de la manera mas rapida y practica.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/cama.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Cama para perro  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Cama para perro <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$43.000 Dale a tu mascota la comodidad a la hora de dormir.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>  
                    </tr>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/gimnasio.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Gimnasio para gato  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Gimnasio para gato <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$150.000 Proporcionale a tu gato la manera de hacer ejercicios.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/estufa.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Estufa con horno  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Estufa con horno <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$450.000 Cocina tus manidas de una manera mas comoda.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/lavadora.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Lavadora  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Lavadora <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$500.000 Lava de la manera mas facil y mas rapido sin desgastar tus manos.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/televisor.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Televisor  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="vistas/productos.php">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Televisor <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$900.000 Disfruta del mejor entretenimiento.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>
                      

                </thead>
              
          </table>
            </div>            
        </div>
  </div>
    <?php }else{ ?>    
  <nav class="teal">
    <div class="nav-wrapper">
      <div class="col s12">      
        <a href="#!" class="brand-logo"><img src="assets/images/Imagen1.png"></a>  <!-- imagen de logo responsiva-->
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
<!-- Presentación del index pagina de inicio -->

  <!--Aqui contenedores laterales y centrales de la pagina de inicio-->
  <div class="row">     
          <div class="col s12 m4 l3">
              <div class="col s3">               
                  <h3>Categorias</h3>  
              </div>
              <br>
              <br>
              <br>
              <br>
              <ul class="collection">
            <li class="collection-item avatar">
                <img src="assets/images/casa.png" alt="" class="circle">
                  <span class="title">Hogar</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/libro.png" alt="" class="circle">
                  <span class="title">Libro</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/musica.png" alt="" class="circle">
                  <span class="title">Musica</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/oficina.png" alt="" class="circle">
                  <span class="title">Oficina</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/salud.png" alt="" class="circle">
                  <span class="title">Salud</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/pc.png" alt="" class="circle">
                  <span class="title">Tecnologia</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            <li class="collection-item avatar">
                <img src="assets/images/vehiculo.png" alt="" class="circle">
                  <span class="title">Transporte</span>
                <a href="#!" class="secondary-content"><i class="mdi-action-grade"></i></a>
            </li>
            


          </ul>
           
           </div>
        
          <div class="col s12 m8 l9"> 
               <div class="col s9">
               <br>
               <h2>Productos</h2> 
               <br>           
            <table class="responsive-table">
                  <thead>
                      <tr> 

                        <td data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/iphone5.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Iphone 5<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Iphone 5 <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo: $650.000.  Celular en buenas condiciones, de color negro para que tengas una experiencia inigualable.  </p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </td> 

                      <td data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/computador.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Computador<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Computador<i class="mdi-navigation-close right"></i></span>
                                              <p>Costo: $1.500.000  Computador lenovo de color negro.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </td> 
                                        
                
                      <th data-field="id">
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/Videojuego.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">God of war<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">God of war <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$50.000. Sensacional juego con gráficos excelentes. Para divertirte en tus tardes tristes.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/nintendo.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Nintendo<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Nintendo <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$50.000.  Para que revivas tu infancia con juegos del nintendo.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th> 
                  </tr>
                  <tr>
                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/mesa.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Mesa de centro<i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Mesa de centro<i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$100.000. Decora tu casa y tu sala con esta elegante mesa.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/comedor.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Comedor  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Comedor <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$450.000  Disfruta de tus comidas de una manera comoda.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>  

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/microondas.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Microondas  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Microondas <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$200.000 Calienta tus comidas de la manera mas rapida y practica.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/cama.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Cama para perro  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Cama para perro <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$43.000 Dale a tu mascota la comodidad a la hora de dormir.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>  
                    </tr>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/gimnasio.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Gimnasio para gato  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Gimnasio para gato <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$150.000 Proporcionale a tu gato la manera de hacer ejercicios.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/estufa.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Estufa con horno  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Estufa con horno <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$450.000 Cocina tus manidas de una manera mas comoda.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/lavadora.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Lavadora  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Lavadora <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$500.000 Lava de la manera mas facil y mas rapido sin desgastar tus manos.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>

                      <th data-field="id">
                    
                        <div class="container">
                              <div class="row">
                                <div class="col s12 m8 offset-m2 l6 offset-l3">
                                    <div class="left">
                                      <div class="card">                           
                                         <div class="card-image waves-effect waves-block waves-light">
                                           <img class="activator" src="assets/images/televisor.png">
                                         </div>
                                         <div class="card-content">                               
                                            <span class="card-title activator grey-text text-darken-4">Televisor  <i class="mdi-navigation-more-vert right"></i></span>
                                            <p><a href="#">INFORMACION</a></p>
                                         </div>
                                         <div class="card-reveal">
                                              <span class="card-title grey-text text-darken-4">Televisor <i class="mdi-navigation-close right"></i></span>
                                              <p>Costo:$900.000 Disfruta del mejor entretenimiento.</p>
                                           </div>
                                    </div>
                                  </div>
                              </div>
                            </div>
                        </div>
                    
                      </th>
                      

                </thead>
              
          </table>
            </div>            
        </div>
  </div>
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