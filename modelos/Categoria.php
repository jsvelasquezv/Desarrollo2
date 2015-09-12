<?php
class Categoria
{
	private $nombre;
	private $descripcion;

    /**
     * [__construct description]
     * @param [type] $nombre      [description]
     * @param [type] $descripcion [description]
     */
    public function __construct($nombre, $descripcion)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    /**
     * Gets the value of nombre.
     *
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the value of nombre.
     *
     * @param mixed $nombre the nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Gets the value of descripcion.
     *
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Sets the value of descripcion.
     *
     * @param mixed $descripcion the descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
}
    //Prueba
    //$cat = new Categoria("salud","productos de cuidado personal");
    //$nombreCat = $cat->getNombre();
    //$descripCat = $cat->getDescripcion();
    //echo $nombreCat.": ".$descripCat;
?>