
<?php 
require_once '../scripts/gestionarCategorias.php';
  if (isset($_SESSION['eBuscarP'])) {
    $errorBuscarPerfil = $_SESSION['eBuscarP'];
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
          <?php if ($_SESSION['permisoDeGestionarPerfiles'] == 1) { ?>
          <li><a href="comision.php">Comision</a></li>
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
               <li><a href="vistas/estadoCompras.php"> Mis<br> Compras</a></li>
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
      <h4>Categorias</h4>
      <form action="../controladores/CoordinadorCategoriaBuscar.php" method="post">
        <div class="row">
         <div class="input-field col s6 tooltipped" data-position="right" data-tooltip="Presiona enter para buscar" >
              <i class="mdi-action-search prefix"></i>
              <input id="nombreP" type="text" class="validate" name="nombre">
              <label for="nombreP">Ingresa un nombre para buscar</label>
              <input type="submit" class="btn col s3 offset-s1" name="buscarC" value="Buscar" style='display:none;'>
            </div>
        </div>
      </form>
    </div>
		<div class="row">
		<table class="hoverable responsive-table centered">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Descripcion</th>				
				</tr>
			</thead>
			<tbody>				
				<?php foreach ($_SESSION['categorias'] as $elementos) {
					?> <tr>
          <!-- *********************************************************************************************************************** -->
					<!-- en esta parte ira la conexion para traer los datos de la base de datos y mostrarlos -->
				  <td><?php echo $elementos['nombre']; ?></td>
          <td><?php echo $elementos['descripcion']; ?></td>
          <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <td> <a href="../controladores/CoordinadorCategoriaEditar.php?edit=<?php echo $elementos['nombre'] ?>" class="btn-flat tooltipped" name="edit" id="editar" data-tooltip="Editar"><i class="mdi-image-edit"></i></a></td> <?php 
          ?> 
				 </tr> <?php 
				} ?>
			</tbody>
		</table>
		</div>
		<div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
			<a class="btn-floating btn-large waves-effect waves-light red right modal-trigger tooltipped" data-position="left" data-tooltip="Nueva Categoria" href="#modal"><i class="mdi-content-add"></i></a>
		</div>
		<div class="valign-wrapper">
			<div class="col s12 m8 offset-m2 l4 offset-l3 valign">
				<div id="modal" class="modal modalLogin">
					<div class="card login">
						<div class="card-content">
           <!-- aqui esta el formato para crear una nueva categoria -->
							<span class="card-title teal-text">Crear Categoria</span> 
							<form action="../controladores/CoordinadorCategoriaCrear.php" method="post"> 
              <?php if(isset($_SESSION['erroresCreacionCategoria'])) {
                echo "<script language='javascript'> $('#modal').openModal(); </script>"; ?> 
                <?php if (isset($_SESSION['erroresCreacionCategoria'])) {  ?>
                    <div class="card">
                      <div class="card-content">
                      <?php foreach ($_SESSION['erroresCreacionCategoria'] as $elementos) { ?>
                        <p><?php echo $elementos; ?></p>
                      <?php } ?>
                      </div>
                    </div>        
                <?php } ?> 
                <?php unset($_SESSION['erroresCreacionCategoria']);} ?>
								<div class="input-field col m4 l2 tooltipped" data-position="bottom" data-tooltip="Este campo es requerido, 4-30 caracteres alfabeticos">
									<input id="nombre" type="text" name="nombre"  required maxlength="30">
									<label for="nombre">Nombre</label>
								</div>
                <h6>Descripción:</h6>
                <p align="center"><textarea  name="diagnostico" id="diagnostico" resize="nu" cols="95" rows="10" onblur="guardar(this);"></textarea></p>
								
  								<br>
								<input class="btn-flat orange-text" type="submit" value="Crear" name="crear">
            <!-- **************************************************************************** -->
								</div>
							</form>                     
						</div>
					</div>
				</div>
			</div>    
		</div>
			<?php if (isset($_SESSION['erroresCreacionCategoria'])) {
			echo "<script language='javascript'> $('#modal').openModal(); </script>"; 
		} ?>
	</div>
	<div id="modal2" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha creado correctamente la categoria</p> 
        </div>
          <?php if (isset($exitoCrearCategoria)) {
             echo "<script language='javascript'> $('#modal2').openModal(); </script>"; 
             unset($_SESSION['exitoCrearCategoria']);
          } ?>                      
      </div>
    </div>
    <div id="modal3" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Exito</span> 
            <p>Se ha editado correctamente la categoria</p> 
        </div>
          <?php if (isset($exitoEditarCategoria)) {
             echo "<script language='javascript'> $('#modal3').openModal(); </script>"; 
             unset($_SESSION['exitoEditarCategoria']);
          } ?>                      
      </div>
    </div>
     <div id="modal4" class="modal modalLogin">
      <div class="card login">
        <div class="card-content">
            <span class="card-title teal-text">Error</span> 
            <p>No se encuentra una categoria con ese nombre</p> 
        </div>
          <?php if (isset($errorBuscarCategoria)) {
             echo "<script language='javascript'> $('#modal4').openModal(); </script>"; 
             unset($_SESSION['errorBuscarCategoria']);
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