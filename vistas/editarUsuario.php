<?php 
	echo $documento = $_GET['documento'];
	echo $nombre = $_GET['nombre'];
	echo $apellidos = $_GET['apellidos'];
	echo $email = $_GET['email'];
	echo $username = $_GET['username'];
	/*echo " 
                <script language='JavaScript'> 
                alert('JavaScript dentro de PHP'); 
                </script>";*/
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
<div class="valign-wrapper">
  <div class="col s12 m8 offset-m2 l4 offset-l3 valign">
    <div class="card login">
      <div class="card-content">
        <span class="card-title teal-text">Editar Usuario</span>  
        <form action="../controladores/CoordinadorUsuario.php" method="post">  
          <div class="row">
            <div class="input-field col s6">
              <input id="nombre" type="text" class="validate" name="nombre" value="<?php echo $nombre; ?>">
              <label for="nombre">Nombre</label>
            </div>
        	<input type="hidden" name="antiguo" value="<?php echo $documento; ?>">          
            <div class="input-field col s6">
              <input id="apellido" type="text" class="validate" name="apellido" value="<?php echo $apellidos; ?>">
              <label for="apellido">Apellidos</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="username" type="text" class="validate" name="username" value="<?php echo $username; ?>">
              <label for="username">Username</label>
            </div>
            <div class="input-field col s6">
              <input id="email" type="text" class="validate" name="email" value="<?php echo $email; ?>">
              <label for="email">E-mail</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="documento" type="text" class="validate" name="documento" value="<?php echo $documento; ?>">
              <label for="documento">Documento</label>
            </div>
            <div class="col s6">
              <select name="perfilSelec">
              	<?php  ?>
                <option value="1">Perfil 1</option>
                <option value="2">Perfil 2</option>
                <option value="3">Perfil 3</option>
              </select>
            </div>
          </div>
          <input class="btn-flat orange-text" type="submit" value="Guardar" name="editar">
        </form>                     
      </div>
    </div>
  </div>
</body>
</html>