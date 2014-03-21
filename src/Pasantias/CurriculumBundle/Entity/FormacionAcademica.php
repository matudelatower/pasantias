<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormacionAcademica
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pasantias\CurriculumBundle\Entity\FormacionAcademica
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="formacion_academica")
 */
class FormacionAcademica {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Carrera") */
    private $carrera;

    
    /** @ORM\Column(type="string", length=4) */
    private $ingreso;

    /** @ORM\Column(type="string", length=4) */
    private $egreso;

    /** @ORM\Column(name="estado_avance",type="string", length=100) */
    private $estadoAvance;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="formacionAcademica", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    private $personas;

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
     * Set ingreso
     *
     * @param string $ingreso
     * @return FormacionAcademica
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;
    
        return $this;
    }

    /**
     * Get ingreso
     *
     * @return string 
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set egreso
     *
     * @param string $egreso
     * @return FormacionAcademica
     */
    public function setEgreso($egreso)
    {
        $this->egreso = $egreso;
    
        return $this;
    }

    /**
     * Get egreso
     *
     * @return string 
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * Set estadoAvance
     *
     * @param string $estadoAvance
     * @return FormacionAcademica
     */
    public function setEstadoAvance($estadoAvance)
    {
        $this->estadoAvance = $estadoAvance;
    
        return $this;
    }

    /**
     * Get estadoAvance
     *
     * @return string 
     */
    public function getEstadoAvance()
    {
        return $this->estadoAvance;
    }

    /**
     * Set carrera
     *
     * @param \Pasantias\CurriculumBundle\Entity\Carrera $carrera
     * @return FormacionAcademica
     */
    public function setCarrera(\Pasantias\CurriculumBundle\Entity\Carrera $carrera = null)
    {
        $this->carrera = $carrera;
    
        return $this;
    }

    /**
     * Get carrera
     *
     * @return \Pasantias\CurriculumBundle\Entity\Carrera 
     */
    public function getCarrera()
    {
        return $this->carrera;
    }

    
    /**
     * Set personas
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $personas
     * @return FormacionAcademica
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
    
    public function __toString() {
        return $this->carrera;
    }
}