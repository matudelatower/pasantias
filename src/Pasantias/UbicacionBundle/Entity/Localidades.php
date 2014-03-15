<?php

namespace Pasantias\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pasantias\UbicacionBundle\Entity\Localidades
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="localidades")
 */
class Localidades {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100, name="nombre") */
    private $nombreLocalidad;

    /** @ORM\ManyToOne(targetEntity="Pasantias\UbicacionBundle\Entity\Provincias"), inversedBy="localidades")
     *  @ORM\JoinColumn(name="provincias_id", referencedColumnName="id")
     */
    private $provincias;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombreLocalidad
     *
     * @param string $nombreLocalidad
     * @return Localidades
     */
    public function setNombreLocalidad($nombreLocalidad)
    {
        $this->nombreLocalidad = $nombreLocalidad;
    
        return $this;
    }

    /**
     * Get nombreLocalidad
     *
     * @return string 
     */
    public function getNombreLocalidad()
    {
        return $this->nombreLocalidad;
    }

    /**
     * Set provincia
     *
     * @param \Pasantias\UbicacionBundle\Entity\Provincias $provincia
     * @return Localidades
     */
    public function setProvincia(\Pasantias\UbicacionBundle\Entity\Provincias $provincia = null)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Pasantias\UbicacionBundle\Entity\Provincias 
     */
    public function getProvincia()
    {
        return $this->provincias;
    }

    /**
     * Set provincias
     *
     * @param \Pasantias\UbicacionBundle\Entity\Provincias $provincias
     * @return Localidades
     */
    public function setProvincias(\Pasantias\UbicacionBundle\Entity\Provincias $provincias = null)
    {
        $this->provincias = $provincias;
    
        return $this;
    }

    /**
     * Get provincias
     *
     * @return \Pasantias\UbicacionBundle\Entity\Provincias 
     */
    public function getProvincias()
    {
        return $this->provincias;
    }
    
    public function __toString()
    {
        return $this->nombreLocalidad;
    }
}