
<?php 
  require_once '../scripts/gestionarComision.php';
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
      <h4>Comision</h4>
    </div>
		<div class="row">
		<table class="hoverable responsive-table centered">
			<thead>
				<tr>
					<th>Porcentaje</th>
					<th>Fecha Asignacion</th>				
				</tr>
			</thead>
			<tbody>				
				<?php foreach ($_SESSION['comision'] as $elementos) {
					?> <tr>
          <!-- *********************************************************************************************************************** -->
					<!-- en esta parte ira la conexion para traer los datos de la base de datos y mostrarlos -->
				  <td><?php echo $elementos['porcentaje']; ?></td>
          <td><?php echo $elementos['fecha']; ?></td>
          <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
				 </tr> <?php 
				} ?>
			</tbody>
		</table>
		</div>
		<div class="fixed-action-btn" style="bottom: 45px; right: 45px;">
			<a class="btn-floating btn-large waves-effect waves-light red right modal-trigger tooltipped" data-position="left" data-tooltip="Editar" href="#modal"><i class="mdi-editor-border-color"></i></a>
		</div>
		<div class="valign-wrapper">
			<div class="col s12 m8 offset-m2 l4 offset-l3 valign">
				<div id="modal" class="modal modalLogin">
					<div class="card login">
						<div class="card-content">
           <!-- aqui esta el formato para modificar comision -->
							<span class="card-title teal-text">Cambiar Comision</span> 
							<form action="../controladores/CoordinadorComision.php" method="post"> 
              <?php if(isset($_SESSION['errorComision'])) {
                echo "<script language='javascript'> $('#modal').openModal(); </script>"; ?> 
                <?php if (isset($_SESSION['errorComision'])) {  ?>
                    <div class="card">
                      <div class="card-content">
                      <?php foreach ($_SESSION['errorComision'] as $elementos) { ?>
                        <p><?php echo $elementos; ?></p>
                      <?php } ?>
                      </div>
                    </div>        
                <?php } ?> 
                <?php unset($_SESSION['errorComision']);} ?>
								<div class="input-field col m4 l2 tooltipped" data-position="bottom" data-tooltip="Este campo es requerido">
									<input id="nombre" type="text" name="porcentaje"  required maxlength="15">
									<label for="nombre">Porcentaje</label>
								</div>						
  								<br>
								<input class="btn-flat orange-text" type="submit" value="Guardar" name="guardar">
            <!-- **************************************************************************** -->
								</div>
							</form>                     
						</div>
					</div>
				</div>
			</div>    
		</div>
			<?php if (isset($_SESSION['errorComision'])) {
			echo "<script language='javascript'> $('#modal').openModal(); </script>"; 
		} ?>
	</div>   
</body>
</html>