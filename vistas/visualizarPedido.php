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
          
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>

          

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
            <li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar mis datos</a></li>
            <li><a href="#modal7" class="modal-trigger">Cambiar contrasena</a></li>
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
<?php $perfiles = $_SESSION['perfiles']; ?>

  <div class="container">   
    <br>
    <div class="row">
      <h4>Visualizar pedidos</h4>
      <form action="" method="post">
        <div class="row">
         <div class="input-field col s6 tooltipped" data-position="right" data-tooltip="Presiona enter para buscar" >
              <i class="mdi-action-search prefix"></i>
              <input id="emailB" type="text" class="validate" name="emailB">
              <label for="emailB">Ingresa el Id de la factura</label>
              <input type="submit" class="btn col s3 offset-s1" name="buscar" value="Buscar" style='display:none;'>
            </div>
        </div>
      </form>
    </div>
    <!--  -Se genera una tabla con todas la facturas que se hayan creado- 
    -para visualizar la factura se dará  "CLICK" sobre la factura que se quiere visualizar en caso de que sea administrador y vendedor para editar el estado de la factura
     -para vsaber el estado de la compra solo se mostrata la información que contiene la factura y su estado, en caso de que sea admin o comprador   -->
    <table class="hoverable responsive-table">
      <thead>
        <tr>
          <th>Id Factura</th>
          <th>Fecha</th>
          <th>Nombre del vendedor</th>
          <th>Nombre del comprador</th>
          <th>Nombre del producto</th>
          <th> Valor Unitario</th>
          <th> Valor SubTotal</th>
          <th> Valor Total</th>
          <th>Estado </th>

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
              <td> <h5>hola</h5>  </td>
             <td> <h5>hola</h5> </td>
             <td> <h5>hola</h5> </td>
             <td> <a  class="grey-text text-darken-3 modal-trigger" name="edit" id="edit" href="#modal"><i class="mdi-image-edit small"></i></a></td>
             <td><a href="" class="grey-text text-darken-3 tooltipped" name="down" id="down" data-tooltip="Remover de la lista"><i class="mdi-action-highlight-remove small"></i></a></td> <?php
          ?> </tr> <?php 
        } ?> 
      </tbody>
    </table>  
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
          <!-- al dar click en confirmar pago se realizar´n las notificaciones requeridas por el sistema (Historias de Usuario) -->
           <input class="btn-flat orange-text" type="submit" value="Guardar" name="registrar">
          </div>
         
        </form>                     
      </div>
    </div>
  </div>
  </div>  
</div>