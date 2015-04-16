<?php
require_once '../modelos/ValidarBuscarProducto.php';
#========================SE OBTIENEN EL NOMBRE DEL PRODUCTO A BUSCAR=======================
if(isset($_POST['buscar'])){#Si se dio enter en el input de busqyea entonces
	session_start();
	$userUsuario = $_SESSION['user'];#obtengo el usuario que este logueado en la app
	$nombre = $_POST['searchProducto'];#Obtengo el nombre del producto a ser buscado
	$miCoordinadorProductoBuscar = new CoordinadorProductoBuscar();#Creo una instancia de CoordinadorProductoBuscar
	$frijolEncontrado = $miCoordinadorProductoBuscar->buscarProducto($nombre);#busco el producto por el nombre
	if (empty($frijolEncontrado)) {#Si no se obtuvieron resultados es porque no existe un producto en la BD con ese nombre
			session_start();
			$_SESSION['erroresBuscarProducto'] = 1;#Creo una variable de sesion erroresBuscarProducto y la igualo a 1 (lo se usara en las vistas, 1=true, 0=false)
			header('Location: ../vistas/productos.php');#redirijo a vistas/crearProducto
		}
		else{#Si existe el producto en la base de datos, redirijo a la vista de editar porducto, con las credenciales de ese producto buscado
			header('Location: ../vistas/busquedaProducto.php?nombre='.$frijolEncontrado['nombre'].'&cantidad='
		.$frijolEncontrado['cantidad'].'&categoria='.$frijolEncontrado['categoria_id']
		.'&valor='.$frijolEncontrado['valor_unitario'].'&url='.$frijolEncontrado['url_imagen']
		.'&estado='.$frijolEncontrado['estado']);
		}
}
/**
* Clase que controla la entrada de los datos de las vistas y crea un producto, siempre y cuando esto
* se pueda hacer, se ayudo de los modelos para tomar esta desicion
*/

class CoordinadorProductoBuscar
{
	
	function __construct() {
		
	}
	#Funcion que busca el nombre usando los modelos
	public function buscarProducto($nombre)
	{
		$miValidarBuscarProducto = new ValidarBuscarProducto();#Necesito una instancia de ValidarBuscarProducto
		$frijol = $miValidarBuscarProducto->getProductoPorNombre($nombre);#Llamo a la funcion que me valida el producto
		//$errores = $miValidarBuscarProducto->getResponse();#Llamo a la funcion que me retorna los podibles errores que hubo en la busqueda de un producto
		return $frijol;#Restorno el producto buscado
	}
}

// $cpb = new CoordinadorProductoBuscar();
// $query = $cpb->buscarProducto("Cama");
// foreach ($query as $key) {
// 	echo $key."<br>";
// }
?>