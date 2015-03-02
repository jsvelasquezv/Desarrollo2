<?php 
	$nombre = $_GET['nombre'];
	$permiso1 = $_GET['permiso1'];
	$permiso2 = $_GET['permiso2'];
	$permiso3 = $_GET['permiso3'];
?>
<div class="valign-wrapper">
	<div class="col s12 m8 offset-m2 l4 offset-l3 valign">
		<div id="modal1" class="modal modalLogin">
			<div class="card login">
				<div class="card-content">
					<span class="card-title teal-text">Crear Perfil</span>  
					<form action="controladores/CoordinadorUsuario.php" method="post">            
						<div class="input-field col m4 l2">
							<input id="nombre" type="text" class="validate" name="nombre">
							<label for="nombre">Nombre</label>
						</div>
						<h6>Permisos:</h6>
						<p>
							<input type="checkbox" id="permiso1" name="permiso1"/>
							<label for="permiso1">Vender</label>
						</p>
						<p>
							<input type="checkbox" id="permiso2" name="permiso2"/>
							<label for="permiso2">Gestionar Usuarios</label>
						</p>
						<p>
							<input type="checkbox" id="permiso3" name="permiso3"/>
							<label for="permiso3">Gestionar Perfiles</label>
						</p>
						<br>
						<input class="btn-flat orange-text" type="submit" value="Crear" name="crear">
					</form>                     
				</div>
			</div>
		</div>
	</div>    
</div>