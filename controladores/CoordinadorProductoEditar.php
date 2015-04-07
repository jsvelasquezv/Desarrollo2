<?php
require_once'../modelos/ValidarEditarProducto.php';
require_once'../modelos/ValidarBuscarProducto.php';
#========================SE OBTIENEN LOS DATOS PARA CREAR PRODUCTO DE LAS VISTAS=======================

if($_GET['edit']){#si se hizo click en el dibujo del lapiz de la tabla(que significa editar), entonces....
	$editar = $_GET['edit'];#capturo el valor de edit, que es igual a el nombre del producto (ver en vistas), luego, editar es igual al nombre del producto seleccionado
	$miValidarBuscarProducto= new ValidarBuscarProducto(); #creo una instancia de la clase de VaidarBuscarProducto
	$frijolEncontrado = $miValidarBuscarProducto->validarBuscarProducto($editar);#busco el bean segun el nombre
	
	#Redirecciono por get hacia donde se va a editar el el Producto
	header('Location: ../vistas/editarProducto.php?nombre='.$frijolEncontrado['nombre'].'&cantidad='
		.$frijolEncontrado['cantidad'].'&categoria='.$frijolEncontrado['categoria_id']
		.'&valor='.$frijolEncontrado['valor_unitario'].'&url='.$frijolEncontrado['url_imagen']
		.'&estado='.$frijolEncontrado['estado']);
}
#Si se dio click en guardar, entonces
if(isset($_POST['guardarEditada'])){
	$nombreAntiguo = $_POST['antiguo'];#Obtengo el nombre antiguo del producto, pues lo necesitare para saber que producto es el que debo editar, sin este parametro no podre saber el frijol que tengo que editar
	$nuevoNombre = $_POST['nombre'];#Luego obtengo los otros datos del formulario
	$nuevaCantidad = $_POST['cantidad'];
	$nuevoValor = $_POST['valor'];
	$nuevaUrl = $_POST['url'];
	$nuevoIdCategoria = $_POST['categoria'];
	session_start();
	$nuevoUserUsuario = $_SESSION['user'];#Usuario logueado actualmente, quien esta editando
	#Si se chuleo el radioButton de vendido, entonces el estado del producto será en venta
	if ($_POST['estado'] == "en_venta") {
		$estado = "En venta";
	}
	else $estado = "Vendido";#Sino será vendido

	$miCoordinadorProductoEditar = new CoordinadorProductoEditar();#Creo una instancia de CoordinadorProductoEditar
	$miCoordinadorProductoEditar->editarProducto($nombreAntiguo, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoUserUsuario, $nuevoIdCategoria, $estado); #Edito el producto y le mando los datos de las vistas
}
// echo $nombreAntiguo;
// echo $nuevoNombre;
// echo "<br>".$nuevaCantidad;
// echo "<br>".$nuevoValor;
// echo "<br>".$nuevoIdCategoria;
// echo "<br>".$nuevaUrl;
// echo "<br>".$nuevoUserUsuario;
// echo "<br>".$estado;

/**
*Clase que controla la entrada de los datos de las vistas y edita un producto, siempre y cuando esto
* se pueda hacer, se ayuda de los modelos para tomar esta desicion
*/
class CoordinadorProductoEditar
{
	
	function __construct() {
		
	}

	#Funcion que edita un producto usando los modelos
	public function editarProducto($nombre, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoUserUsuario, $nuevoIdCategoria, $estado)
	{
		#Necesito la instancia de ValidarEditarProducto, pues es el que me hace la editada en si del producto(con sus respectivas vaidaciones)
		$miValidarEditarProducto = new ValidarEditarProducto();
		#Necesito una instancia de buscar tambien, para poder hacer una redireccion correcta con el metodo GET
		$miValidarBuscarProducto = new ValidarBuscarProducto();
		#Si se puede, entonces se edita el producto
		$miValidarEditarProducto->validarEditarProducto($nombre, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoUserUsuario, $nuevoIdCategoria, $estado);
		#Necesito obtener el frijol que quiero editar, para eso busco ese frijol y le paso el nombre antiguo, me traera todos los datos de aquel producto que quiero editar
		$frijolEncontrado = $miValidarBuscarProducto->validarBuscarProducto($nombre);
		$errores = $miValidarEditarProducto->getResponse();#Si hay errores en la editada, los obtengo de esta forma
		
		if (! empty($errores)) {
			#Si hay errores (si el arreglo de errores no se encuentra vacio), entonces
			$_SESSION['erroresEditarProducto'] = $errores;#creo una variable de SESSION donde guardo los errores que hubieran dado lugar
	
			#Redirijo a la vista de editar usando las credenciales del producto que queria editar, pero que no pude. Por eso es que necesitaba un objeto ValidarBuscarProducto		
			header('Location: ../vistas/editarProducto.php?nombre='.$frijolEncontrado['nombre'].'&cantidad='
		.$frijolEncontrado['cantidad'].'&categoria='.$frijolEncontrado['categoria_id']
		.'&valor='.$frijolEncontrado['valor_unitario'].'&url='.$frijolEncontrado['url_imagen']
		.'&estado='.$frijolEncontrado['estado']);

		}
		else{#Sino hubo errores entonces
			
			$_SESSION['exitoEditarProducto'] = 0;#Creo una variable de ssion y la igualo a cero, para usarlo luego en las vistas
			unset($_SESSION['erroresEditarProducto']);#Libero memoria eliminando la variable de session erroresEditarProducto
			unset($_SESSION['frijolEncontrado']);#...y libero tambien la variable de sessio frijolEncontrado
			header('Location: ../vistas/crearProducto.php');
		}
	}
}

// $cpe = new CoordinadorProductoEditar();
// $cpe->editarProducto("Licuadora", "Licuadora grande", 4, 4000, "www.a.com", "admin", 4, "Vendido");
?>