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
        <a href="#!" ><img src="../assets/images/logo.png"></a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down" >
            <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
          <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
         <!--  <form action="controladores/Principal.php">
            <input type="hidden" value="salir" name="salir">
            <button name="salir" class="btn-flat white-text">Salir</button>
          </form> -->
            <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Modulos &nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <?php } ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Mi Cuenta &nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Mi Perfil &nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>

          

        </ul>      
        <ul id ="dropdown1" class="dropdown-content">
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
            <li><a href="gestionarPerfiles.php">Perfiles</a></li>
          <?php } ?>
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="gestionarUsuarios.php">Usuarios</a></li>
          <?php } ?>
           <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="categorias.php">Categorias</a></li>
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

            </ul> 

        <!-- responsive navbar -->
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
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

<div class="container">
   <div class="divider"></div>
  <div class="section">
    <h5>Section 1</h5>
    <p> se mostrara los productos selecinados en el carrito y me permitira retirar productos </p>
        <?php $perfiles = $_SESSION['perfiles']; ?>
     
    <br>
    <div class="row">
      <h4>Compras</h4>
      <form action="" method="post">
        
      </form>
    </div>
    <table class="hoverable responsive-table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Fecha de la compra</th>
          <th>Nombre de producto</th>
          <th>Cantidad del producto</th>
          <th>valor unitario</th>
          <th>Valor precio total del producto</th>
          <th>valor total de los productos</th>
         
        </tr>
      </thead>
      <!-- envio de datos a la base de datos -->
      <tbody>       
        <?php  {
          ?> <tr>
             <td> <h5>hola</h5> </td> 
             <td> <h5>hola</h5>  </td> 
             <td> <h5>hola</h5>  </td>
             <td> <h5>hola</h5>  </td>
             <td> <h5>hola</h5> </td>
             <td> <h5>hola</h5> </td> 
             <td> <h5>hola</h5> </td> 
             
             <td><a href="" class="grey-text text-darken-3 tooltipped" name="down" id="down" data-tooltip="Remover del carrito"><i class="mdi-action-highlight-remove small"></i></a></td> <?php
          ?> </tr> <?php 
        } ?> 
      </tbody>
    </table>  
    <div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
      <a class="btn-floating btn-large waves-effect waves-light red right  tooltipped" data-position="rigth" data-tooltip="Seguir Comprando" href="../index.php"><i class="mdi-action-add-shopping-cart"></i></a>
    </div>
  <div class="fixed-action-btn" style="bottom: 45px; right: 200px;">
      <a class="btn-floating btn-large waves-effect waves-light red right modal-trigger tooltipped" data-position="left" data-tooltip="Comprar" href="#modal"><i class="mdi-maps-local-atm "></i> Comprar</a>
    </div>
  </div>
</div>

  <div class="col s12 m8 offset-m2 l6 offset-l3">
   <div id="modal" class="modal ">
    <div class="card login ">
      <div class="card-content">
        <span class="card-title teal-text">Factura</span>  
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
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Id de la factura</label>
            </div>
            <div class="input-field col s6">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Fecha de la compra</label>
            </div>
           
            <div class="input-field col s6">
              <input id="apellido" type="text" class="validate" name="apellido">
              <label for="apellido">Nombre del vendedor</label>
            </div>
          
            <div class="input-field col s6">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Nombre del cliente</label>
            </div>
             <div class="input-field col s4">
              <input id="nombre" type="text" class="validate" name="nombre">
              <label for="nombre">Nombre de cada producto</label>
            </div>
            <div class="input-field col s4">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Valor Unitario de cada producto</label>
            </div>
          
           <div class="input-field col s4">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Valor total de cada Producto</label>
            </div>
             <div class="input-field col s4 offset-s8">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Precio total de los productos</label>
            </div>

             <div class="input-field col s6">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Estado de la Factura</label>
            <form action="#">
                    <p>
                       <input name="group1" type="radio" id="test1" />
                         <label for="test1">Pendiente</label>
                    </p>
                         <p>
                            <input name="group1" type="radio" id="test2" />
                               <label for="test2">Aprovado</label>
                        </p>
                             <p>
                            <input name="group1" type="radio" id="test2" />
                               <label for="test2">Despachado</label>
                        </p>
                             <p>
                            <input name="group1" type="radio" id="test2" />
                               <label for="test2">Cancelado</label>
                        </p>
 
          </form>
            </div>

          </div>
          </div>
           <input class="btn-flat orange-text" type="submit" value="Registrarse" name="registrar">
          </div>
         
        </form>                     
      </div>
    </div>
  </div>
  </div>  
</div>
  <?php if (isset($_SESSION['eRegistroUsuario'])) {
      echo "<script language='javascript'> $('#modal').openModal(); </script>"; 
    } ?>

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

  
</div>
</body>
</html>
