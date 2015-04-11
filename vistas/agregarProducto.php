<?php  
  // Se mandarán por GET los parametros actuales a la vista de editar Producto
require'../scripts/gestionarCategorias.php';
  $nuevoNombre = $_GET['nombre'];
  $nuevaCantidad = $_GET['cantidad'];
  // $nuevaCategoria = $_GET['categoria'];
  $nuevoValor = $_GET['valor'];
  $nuevaUrl = $_GET['url'];
  $nuevoEstado = $_GET['estado'];
  // session_start();
 
  if (isset($_SESSION['exitoRegistrar'])) {
    $exitoRegistrar = $_SESSION['exitoRegistrar'];
  }
  if (isset($_SESSION['exitoModificar'])) {
    $exitoModificar = $_SESSION['exitoModificar'];
  }
  if (isset($_SESSION['eBuscar'])) {
    $eBuscar = $_SESSION['eBuscar'];
  }
  
  #Hago una variable que me almacena los posibles errores cuando quiero editar el producto
  if(isset($_SESSION['erroresEditarProducto'])){
    $errorEditarProducto = $_SESSION['erroresEditarProducto'];
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
       <a href="../index.php" style ="font-family: 'Dancing Script', cursive; font-size: 50px;"><img src="../assets/images/Imagen1.png">MarketFree...</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <ul class="right hide-on-med-and-down">
           <li> <a href="../index.php"><i class="mdi-action-home left" class="modal-trigger"></i> Home </a></li>
           <li> <a href="productos.php"><i class="mdi-maps-layers left" class="modal-trigger"></i>Productos en venta</a></li>
          <li><a  href="compras.php" ><i class = " mdi-action-shopping-cart left"></i>Compra&nbsp; </a></li>
          <?php if (!(($_SESSION['permisoDeGestionarPerfiles'] == 0) and ($_SESSION['permisoDeGestionarUsuarios'] == 0))) { ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Modulos&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
          <?php } ?>
           <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Mi Cuenta&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Mi Perfil&nbsp;&nbsp;<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
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
          <?php if ($_SESSION['permisoDeGestionarUsuarios'] == 1) { ?>
            <li><a href="comision.php">Comision</a></li>
          <?php } ?>
        </ul>
         <ul id ="dropdown2" class="dropdown-content">          
            <li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar <br>mis datos</a></li>
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
<div class="container">
  <div class="row">
    
  <div class="col s12 m8 offset-m2 l6 offset-l3">
    <div class="card login">
      <div class="card-content">
      <!-- EDITAR PRODUCTO -->
        <span class="card-title teal-text">Detalles del Producto</span>  
        <?php #$perfiles = $_SESSION['perfiles']; ?>
      <form action="../controladores/CoordinadorCarrito.php" method="POST">
        <?php if (isset($_SESSION['erroresEditarProducto'])) {  ?>
                <div class="card">
                  <div class="card-content">
                  <?php foreach ($_SESSION['erroresEditarProducto'] as $key) { ?>
                    <p><?php echo $key;?></p>
                  <?php } ?>
                  </div>
                </div>        
            <?php unset($_SESSION['erroresEditarProducto']);} ?>      
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate tooltipped" name="nombre" value="<?php echo $nuevoNombre;?>" data-position="left" data-tooltip="Este campo es requerido, 3-30 caracteres alfabeticos" disabled >
              <label for="nombre">Nombre</label>
            </div>
          <input type="hidden" name="antiguo" value="<?php echo $nuevoNombre; ?>">          
            <div class="input-field col s6">
              <input id="cantidad" type="text" class="validate tooltipped" name="cantidad" value="<?php echo $nuevaCantidad;?>" data-position="right" data-tooltip="Este campo es requerido y es numérico" disabled>
              <label for="cantidad">Cantidad</label>
            </div>
          </div>
          <div class="row">
          <?php $categorias = $_SESSION['categorias']?>
            <div class="input-field col s6">
              <select disabled name="categoria" id="">
                <?php foreach ($categorias as $key) { ?>
                  <option  value="<?php echo $key['id']; ?>"> <?php echo $key['nombre']; ?> </option>
                <?php } ?>
              </select>
            <!-- <div class="input-field col s6">
              <input id="categoria" type="text" class="validate tooltipped" name="categoria" value="?php echo $nuevaCategoria;?>" data-position="left" data-tooltip="Este campo es requerido y es numérico">
              <label for="categoria">Categoria</label>
            </div> -->
            <div class="input-field col s6">
              <input id="valor" type="text" class="validate tooltipped" name="valor" value="<?php echo $nuevoValor;?>" data-position="right" data-tooltip="Este campo es requerido y es numérico" disabled>
              <label for="valor">Valor Unitario</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="url" type="url" class="validate tooltipped" name="url" value="<?php echo $nuevaUrl?>" data-position="left" data-tooltip="Este campo es requerido, use el formato https://www.example.com.co"disabled>
              <label for="url">URL de la imagen</label>
            </div>
  
              <div class="input-field col s6">
                <h6>&nbsp;&nbsp;&nbsp;Estado :</h6>
                <p>
                  <input type="radio" id="enVenta" class="validate"  value = "en_venta" name="estado"<?php if ($nuevoEstado == "En venta"){ echo "checked"; }?> disabled>
                  <label for="enVenta">En venta</label>
                </p>
                <p>
                  <input type="radio" id="vendido" value = "ven_dido"name="estado"<?php if ($nuevoEstado == "Vendido"){ echo "checked"; }?> disabled>
                  <label for="vendido">Vendido</label>
                </p>
              </div> 
          </div>
          <input class="btn-flat orange-text" type="submit" value="Agregar Al carrito" name="agregarCarrito">
          <!-- BOTON QUE GUARDA LA EDICION DE LOS DATOS DE UN PRODUCTO -->
          <a  href="productos.php" class="button" type="submit" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atras</a>
      </form>                     
      </div>
    </div>
  </div>
  </div>
  <!-- MuestraMensajes -->
    <div id="modal2" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha creado Editado el Producto</p> 
        </div>
          <?php if (isset($exitoCrearProducto)) {
             echo "<script language='javascript'> $('#modal2').openModal(); </script>"; 
             unset($_SESSION['exitoCrearProducto']);
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