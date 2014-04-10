<?php

namespace Pasantias\EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Pasantias\EmpresasBundle\Entity\TiposTrabajo
 */
/**
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"descripcion"}, 
 *     message="Ya existe el tipo de trabajo"
 * )
 * @ORM\Table(name="tipos_trabajos")
 */
class TiposTrabajo
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $descripcion;



   

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
     * Set descripcion
     *
     * @param string $descripcion
     * @return TiposTrabajo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function __toString()
    {
        return $this->descripcion;
    }
}