<?php
require_once '../libs/rb.php';
require_once 'ConexionBD.php';

Class Comision
{
    /**
     * [__construct description]
     */
	function __construct(){}

    /**
     * [editarComision description]
     * @param  [type] $comision [description]
     * @return [type]           [description]
     */
    public function editarComision($comision)
    {
    	R::selectDatabase('default');
    	$comisionBean = R::dispense('comision');
    	$comisionBean->porcentaje = $comision;
    	R::store($comisionBean);
        R::close();
    }

    /**
     * [mostrarComision description]
     * @return [type] [description]
     */
    public function mostrarComision()
    {
       R::selectDatabase('default');
       $comisionActual = R::findAll('comision',  'ORDER BY id DESC LIMIT 1'); 
       R::close();
       return $comisionActual;
    }
}
	//$comision = new Comision();
    //$comision->editarComision(20);
    //$comisiones = $comision->mostrarComision();
    //foreach ($comisiones as $key) {
       // echo $key['porcentaje'];
    //}
?>