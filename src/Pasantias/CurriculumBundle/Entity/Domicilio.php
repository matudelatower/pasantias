<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Domicilio
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pasantias\CurriculumBundle\Entity\Domicilio
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="domicilios")
 */
class Domicilio {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $calle;

    /** @ORM\Column(type="string", length=100) */
    private $numero;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    private $depto;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    private $piso;

    

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\UbicacionBundle\Entity\Localidades")
     * @ORM\JoinColumn(name="localidades_id", referencedColumnName="id")
     * @Assert\Type("Pasantias\UbicacionBundle\Entity\Localidades")
     * @Assert\NotNull()
     */
    private $localidad;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Empresas", inversedBy="domicilio")
     * @ORM\JoinColumn(name="empresas_id", referencedColumnName="id")
     */
    protected $empresas;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="domicilio", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    protected $personas;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set calle
     *
     * @param string $calle
     * @return Domicilio
     */
    public function setCalle($calle) {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle() {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return Domicilio
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set depto
     *
     * @param string $depto
     * @return Domicilio
     */
    public function setDepto($depto) {
        $this->depto = $depto;

        return $this;
    }

    /**
     * Get depto
     *
     * @return string 
     */
    public function getDepto() {
        return $this->depto;
    }

    /**
     * Set piso
     *
     * @param string $piso
     * @return Domicilio
     */
    public function setPiso($piso) {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get piso
     *
     * @return string 
     */
    public function getPiso() {
        return $this->piso;
    }

    /**
     * Set localidad
     *
     * @param \Pasantias\UbicacionBundle\Entity\Localidades $localidad
     * @return Domicilio
     */
    public function setLocalidad(\Pasantias\UbicacionBundle\Entity\Localidades $localidad = null) {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return \Pasantias\UbicacionBundle\Entity\Localidades 
     */
    public function getLocalidad() {
        return $this->localidad;
    }

    public function __toString() {
        return $this->calle . " - " . $this->numero;
    }

    /**
     * Set empresas
     *
     * @param \Pasantias\EmpresasBundle\Entity\Empresas $empresas
     * @return Domicilio
     */
    public function setEmpresas(\Pasantias\EmpresasBundle\Entity\Empresas $empresas = null) {
        $this->empresas = $empresas;

        return $this;
    }

    /**
     * Get empresas
     *
     * @return \Pasantias\EmpresasBundle\Entity\Empresas 
     */
    public function getEmpresas() {
        return $this->empresas;
    }


    /**
     * Set personas
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $personas
     * @return Domicilio
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