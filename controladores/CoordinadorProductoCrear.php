<?php
require_once'../modelos/ValidarCrearProducto.php';

#========================SE OBTIENEN LOS DATOS PARA CREAR PRODUCTO DE LAS VISTAS=======================
#Si se hizo click en el boton de crear producto, entonces...
if (isset($_POST['crearProducto'])) {
	#Se obtienen las variables del formulario
	$vendido;
	$nombre = $_POST['nombre'];#Nombre del producto
	$cantidad = $_POST['cantidad'];
	$idCategoria = $_POST['categoria'];
	$valor = $_POST['valorUnitario'];
	$url = $_POST['url'];
	session_start();
	$user = $_SESSION['user'];
	#Si se chuleo el checkbox de vendido, entonces...
	if (! isset($_POST['vendido'])) {
		$vendido = "Vendido";
		// echo "Hola";
	}
$miCoordinadorProductoCrear = new CoordinadorProductoCrear();
$miCoordinadorProductoCrear->crearProducto($nombre, $cantidad, $valor, $url, 1, $idCategoria);	
}

// echo $nombreProducto;
// echo "<br>".$cantidad;
// echo "<br>".$idCategoria;
// echo "<br>".$valor;
// echo "<br>".$url;
// echo "<br>".$user;
// echo "<br>".$vendido;

/**
* Clase que controla la entrada de los datos de las vistas y crea un producto, siempre y cuando esto
* se pueda hacer, se ayudo de los modelos para tomar esta desicion
*/
class CoordinadorProductoCrear
{
	
	function __construct() {	
	}
	#Funcion que manda los datos de las vusatas al modelo y verifica si se puede o no
	#crear un producto en la base de datos
	public function crearProducto($nombre, $cantidad, $valor, $url, $idUsuario, $idCategoria)
	{
		$validarCrearProducto = new ValidarCrearProducto();#Necesito un objeto de tipo ValidarCrearProducto
		#valido la creacion del producto pasandole los datos que ya vienen de la vista
		$validarCrearProducto->validarCrearProducto($nombre, $cantidad, $valor, $url, $idUsuario, $idCategoria);
		$errores = $validarCrearProducto->getResponse();#Luego, con la funcion getResponse, me doy cuenta si hay o no errores en la creacion (getRsponse devuelve un array)
		#Si la variable errores NO está vacia entonces...
		if(!empty($errores)){
			$_SESSION['erroresCrearProducto'] = $errores;#Creo una variable de sesion con los errores que hayan
			header('Location: ../vistas/crearProducto.php');
		}
		else{#Sino...
			$_SESSION['exitoCrearProducto'] = 0;#No hubieron errores
			unset($_SESSION['erroresCrearProducto']);#Se libera memoria destruyendo la varibale de sesion erroresCrearProducto
			header('Location: ../vistas/crearProducto.php');	
		}
	}
}
// $cpc = new CoordinadorProductoCrear();
// $cpc->crearProducto("Balon", 4, 12300, "www.balon.com", 2, 4);

?>