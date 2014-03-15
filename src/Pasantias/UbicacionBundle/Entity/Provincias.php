<?php

namespace Pasantias\UbicacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pasantias\UbicacionBundle\Entity\Localidades
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="provincias")
 */
class Provincias {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=50, name="nombre") */
    private $nombreProvincia;


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
     * Set nombreProvincia
     *
     * @param string $nombreProvincia
     * @return Provincias
     */
    public function setNombreProvincia($nombreProvincia)
    {
        $this->nombreProvincia = $nombreProvincia;
    
        return $this;
    }

    /**
     * Get nombreProvincia
     *
     * @return string 
     */
    public function getNombreProvincia()
    {
        return $this->nombreProvincia;
    }
    
    public function __toString()
    {
        return $this->nombreProvincia;
    }
}