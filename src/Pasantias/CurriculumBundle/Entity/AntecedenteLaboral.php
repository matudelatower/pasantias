<?php

/**
 * Description of AntecedenteLaboral
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="antecedente_laboral")
 */
class AntecedenteLaboral {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="antecedenteLaboral", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    private $personas;

    /** @ORM\Column(type="string", length=100) */
    private $empresa;

    /** @ORM\Column(type="date") */
    private $fechaDesde;

    /** @ORM\Column(type="string", length=100) */
    private $fechaHasta;

    /** @ORM\Column(type="text") */
    private $descripcion;

    /** @ORM\Column(type="string", length=100) */
    private $nombreContacto;

    /** @ORM\Column(type="string", length=100) */
    private $telContacto;
    

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
     * Set empresa
     *
     * @param string $empresa
     * @return AntecedenteLaboral
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set fechaDesde
     *
     * @param \DateTime $fechaDesde
     * @return AntecedenteLaboral
     */
    public function setFechaDesde($fechaDesde)
    {
        $this->fechaDesde = $fechaDesde;
    
        return $this;
    }

    /**
     * Get fechaDesde
     *
     * @return \DateTime 
     */
    public function getFechaDesde()
    {
        return $this->fechaDesde;
    }

    /**
     * Set fechaHasta
     *
     * @param string $fechaHasta
     * @return AntecedenteLaboral
     */
    public function setFechaHasta($fechaHasta)
    {
        $this->fechaHasta = $fechaHasta;
    
        return $this;
    }

    /**
     * Get fechaHasta
     *
     * @return string 
     */
    public function getFechaHasta()
    {
        return $this->fechaHasta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return AntecedenteLaboral
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

    /**
     * Set nombreContacto
     *
     * @param string $nombreContacto
     * @return AntecedenteLaboral
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;
    
        return $this;
    }

    /**
     * Get nombreContacto
     *
     * @return string 
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
    }

    /**
     * Set telContacto
     *
     * @param string $telContacto
     * @return AntecedenteLaboral
     */
    public function setTelContacto($telContacto)
    {
        $this->telContacto = $telContacto;
    
        return $this;
    }

    /**
     * Get telContacto
     *
     * @return string 
     */
    public function getTelContacto()
    {
        return $this->telContacto;
    }

    /**
     * Set personas
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $personas
     * @return AntecedenteLaboral
     */
    public function setPersonas(\Pasantias\CurriculumBundle\Entity\Persona $personas = null)
    {
        $this->personas = $personas;
    
        return $this;
    }

    /**
     * Get personas
     *
     * @return \Pasantias\CurriculumBundle\Entity\Persona 
     */
    public function getPersonas()
    {
        return $this->personas;
    }
}