<?php 
require_once'../scripts/gestionarProductos.php';	

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
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Mi Perfil&nbsp;&nbsp; <i class="mdi-navigation-arrow-drop-down right"></i></a></li>

          

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
            <li><a href="../controladores/CoordinadorUsuario.php?user=<?php echo $userMod ?>" >Modificar <br>mis datos</a></li>
            <li><a href="#modal7" class="modal-trigger">Cambiar <br>contrasena</a></li>
            <li><a href="../scripts/salir.php">Salir</a></li>
        </ul>
           <ul id="dropdown3" class="dropdown-content">
              <li><a href="crearProducto.php"> Mis<br> productos &nbsp;</a></li>
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
	<?php $perfiles = $_SESSION['perfiles']; ?>
 <!--  #================================================================== -->
	<div class="container">		
    <br>
    <div class="row">
      <h4>Mis productos</h4>
      <form action="" method="post">
        <div class="row">
         <div class="input-field col s6 tooltipped" data-position="right" data-tooltip="Presiona enter para buscar" >
              <i class="mdi-action-search prefix"></i>
              <input id="emailB" type="text" class="validate" name="emailB">
              <label for="emailB">Ingresa el nombre del producto</label>
              <input type="submit" class="btn col s3 offset-s1" name="buscar" value="Buscar" style='display:none;'>
            </div>
        </div>
      </form>
    </div>
		<table class="hoverable responsive-table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Categoria</th>
					<th>Valor Unitario</th>
					<th>URL de la imagen</th>
          <th>Estado</th>
				</tr>
			</thead>
     
			<tbody>				
 				<?php  {
					?> <tr>
						 <td> <h5>hola</h5> </td> 
						 <td> <h5>hola</h5>  </td> 
						 <td> <h5>hola</h5>  </td>
						 <td> <h5>hola</h5>  </td>
						 <td> <h5>hola</h5> </td>
						 <td> <h5>hola</h5> </td> 

						 <td> <a href="editarProducto.php" class="grey-text text-darken-3" name="edit" id="edit"><i class="mdi-image-edit small"></i></a></td>
						 <td><a href="" class="grey-text text-darken-3 tooltipped" name="down" id="down" data-tooltip="Remover de la lista"><i class="mdi-action-highlight-remove small"></i></a></td> <?php
					?> </tr> <?php 
				} ?> 
			</tbody>
		</table>	
	</div>
	<div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
		<a class="btn-floating btn-large waves-effect waves-light red right modal-trigger tooltipped" href="#modal" data-tooltip="Nuevo Producto"><i class="mdi-content-add"></i></a>
	</div>
	<div class="col s12 m8 offset-m2 l4 offset-l3 valign">
   <div id="modal" class="modal modalLogin">
    <div class="card login">
      <div class="card-content">
      <!-- #==================Crear Producto===================== -->
        <span class="card-title teal-text">Crear Producto</span>  
        <form action="../controladores/CoordinadorProductoCrear.php" method="POST">
        <!-- Muestro los errores al crear un producto -->
        <?php if (isset($_SESSION['erroresCrearProducto'])) {  ?>          
          <div class="card">
            <div class="card-content">
              <?php foreach ($_SESSION['erroresCrearProducto'] as $key) { ?>
                <p><?php echo $key; ?></p>
              <?php } ?>
            </div>
          </div>        
        <?php unset($_SESSION['erroresCrearProducto']);} ?>              
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate" name="nombre">
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col s6">
              <input id="cantidad" type="text" class="validate" name="cantidad">
              <label for="cantidad">Cantidad</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="categorias" type="text" class="validate" name="categoria">
              <label for="categoria">Categoria</label>

            </div>
             <div class="input-field col s6">
            <h6> &nbsp; &nbsp;Estado :</h6>
            <!-- <form action="#"> -->
              <!-- <p>
                <input name="group1" type="radio" id="test1" />
                <label for="test1">En venta</label>
              </p> -->
              <p>
                <input name="group1" type="checkbox" id="test2" name="vendido">
                <label for="test2">Vendido</label>
              </p>
            <!-- </form> -->
            </div>
            
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="valor_unitario" type="text" class="validate" name="valorUnitario">
              <label for="valor_unitario">Valor Unitario</label>
            </div>

            <div class="input-field col s6">
              <input id="email" type="url" class="validate" name="url">
              <label for="url"><i class="mdi-editor-insert-photo left"></i>URL de la imagen</label>
            </div>
          </div>
         
          </div>

          

          <!-- Boton para crear Producto -->  
          <input class="btn-flat orange-text " type="submit" value="Crear Producto" name="crearProducto">
          <!--  FALTA DARLE FUNCINALIDAD PARA REGRESAR  -->
         

          
        </form>                     
      </div>
    </div>
  </div>
  <?php if (isset($_SESSION['erroresCrearProducto'])) {
			echo "<script language='javascript'> $('#modal').openModal(); </script>"; 
		} ?>
</div>   
<div id="modal2" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha creado correctamente el Producto</p> 
        </div>
          <?php if (isset($exitoCrearProducto)) {
             echo "<script language='javascript'> $('#modal2').openModal(); </script>"; 
             unset($_SESSION['exitoCrearProducto']);
          } ?>                      
      </div>
    </div>
    <div id="modal3" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha modificado correctamente el Producto</p> 
        </div>
          <?php if (isset($exitoEditarProducto)) {
             echo "<script language='javascript'> $('#modal3').openModal(); </script>"; 
             unset($_SESSION['exitoEditarProducto']);
          } ?>                      
      </div>
    </div>
    <div id="modal4" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Error</span> 
            <p>No se encuentra un producto con ese nombre</p> 
        </div>
          <?php if (isset($errorBuscarProducto)) {
             echo "<script language='javascript'> $('#modal4').openModal(); </script>"; 
             unset($_SESSION['errorBuscarProducto']);
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