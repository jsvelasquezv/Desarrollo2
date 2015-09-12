<?php
require_once'../modelos/ValidarCrearProducto.php';
require_once'../modelos/ValidarBuscarProducto.php';

#========================SE OBTIENEN LOS DATOS PARA CREAR PRODUCTO DE LAS VISTAS=======================
#Si se hizo click en el boton de crear producto, entonces...


if (isset($_POST['crearProducto'])) {#Si se dio click en crear producto, entonces
	#Se obtienen las variables del formulario
	$nombre = $_POST['nombre'];#Nombre del producto
	$cantidad = $_POST['cantidad'];
	$idCategoria = $_POST['categoria'];
	$valor = $_POST['valorUnitario'];
	$url = $_POST['url'];
	session_start();
	$userUsuario = $_SESSION['user'];#se obtiene el nombre del usuario que actualmente esta creando dicho producto, es decir, el usuario que actualmente esta logueado en la aplicacion
$miCoordinadorProductoCrear = new CoordinadorProductoCrear();#Creo una instancia de CoordinadorProductoCrear
$miCoordinadorProductoCrear->crearProducto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria);#creo el producto pasandole como parametros los datos que cogí del formulario	
}

// echo $nombre;
// echo "<br>".$cantidad;
// echo "<br>CATEGORIA".$idCategoria;
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
	public function crearProducto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria)
	{
		$validarCrearProducto = new ValidarCrearProducto();#Necesito un objeto de tipo ValidarCrearProducto
		#valido la creacion del producto pasandole los datos que ya vienen de la vista
		$validarCrearProducto->validarCrearProducto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria);
		$errores = $validarCrearProducto->getResponse();#Luego, con la funcion getResponse, me doy cuenta si hay o no errores en la creacion (getRsponse devuelve un array)
		#Si la variable errores NO está vacia entonces...
		if(!empty($errores)){
			$_SESSION['erroresCrearProducto'] = $errores;#Creo una variable de sesion con los errores que hayan
			header('Location: ../vistas/crearProducto.php');
		}
		else{#Sino...
			// echo "No hubo errores :)";
			$_SESSION['exitoCrearProducto'] = 0;#No hubieron errores
			unset($_SESSION['erroresCrearProducto']);#Se libera memoria destruyendo la varibale de sesion erroresCrearProducto
			header('Location: ../vistas/crearProducto.php');	
		}
	}
}
// $cpc = new CoordinadorProductoCrear();
// $cpc->crearProducto("Balon", 4, 12300, "www.balon.com", "esto", 4);

?>