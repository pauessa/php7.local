<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 29/11/2018
 * Time: 11:57
 */
require_once __DIR__ . '/../database/IEntity.php';

class Asociado implements IEntity
{
    const RUTA_IMAGENES_ASOCIADOS= '../images/asociados/';

    private $id_Asociado;
    private $nombre_Asociado;
    private $nombre_Logo;
    private $descripcion;

    /**
     * Asociado constructor.
     * @param string $nombre
     * @param string $logo
     * @param string $descripcion
     */
    public function __construct($nombre_Asociado='',$nombre_Logo='', $descripcion='')
    {
        $this->id_Asociado = null;
        $this->nombre_Asociado = $nombre_Asociado;
        $this->nombre_Logo = $nombre_Logo;
        $this->descripcion = $descripcion;
    }

    /**
     * @return null
     */
    public function getIdAsociado()
    {
        return $this->id_Asociado;
    }

    /**
     * @param null $id_Asociado
     * @return Asociado
     */
    public function setIdAsociado($id_Asociado)
    {
        $this->id_Asociado = $id_Asociado;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre_Asociado;
    }

    /**
     * @param string $nombre
     * @return Asociado
     */
    public function setNombre(string $nombre_Asociado): Asociado
    {
        $this->nombre_Asociado = $nombre_Asociado;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->nombre_Logo;
    }

    /**
     * @param string $logo
     * @return Asociado
     */
    public function setLogo(string $nombre_Logo): Asociado
    {
        $this->nombre_Logo = $nombre_Logo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return Asociado
     */
    public function setDescripcion(string $descripcion): Asociado
    {
        $this->descripcion = $descripcion;
        return $this;
    }


    /**
     * @return string
     */
    public function getUrlAsociados() : string {
        return self::RUTA_IMAGENES_ASOCIADOS . $this->getLogo();
    }




    public function toArray(): array
    {
        return[
            'id_Asociado'=>$this->getIdAsociado(),
            'nombre_Asociado'=>$this->getNombre(),
            'nombre_Logo'=>$this->getLogo(),
            'descripcion'=>$this->getDescripcion()
        ];
    }

}