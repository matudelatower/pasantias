<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conocimientos
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pasantias\CurriculumBundle\Entity\Conocimientos
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="conocimientos")
 */
class Conocimientos {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="conocimientos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    private $personas;

    
    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\SubArea")
     * @ORM\JoinColumn(name="sub_area_id", referencedColumnName="id")
     * @Assert\Type("Pasantias\CurriculumBundle\Entity\SubArea")
     * @Assert\NotNull()
     */
    private $subArea;

    /** @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Campo") */
    private $campo;

    /** @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Nivel") */
    private $nivel;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    
    /**
     * Set subArea
     *
     * @param \Pasantias\CurriculumBundle\Entity\SubArea $subArea
     * @return Conocimientos
     */
    public function setSubArea(\Pasantias\CurriculumBundle\Entity\SubArea $subArea = null) {
        $this->subArea = $subArea;

        return $this;
    }

    /**
     * Get subArea
     *
     * @return \Pasantias\CurriculumBundle\Entity\SubArea 
     */
    public function getSubArea() {
        return $this->subArea;
    }

    /**
     * Set campo
     *
     * @param \Pasantias\CurriculumBundle\Entity\Campo $campo
     * @return Conocimientos
     */
    public function setCampo(\Pasantias\CurriculumBundle\Entity\Campo $campo = null) {
        $this->campo = $campo;

        return $this;
    }

    /**
     * Get campo
     *
     * @return \Pasantias\CurriculumBundle\Entity\Campo 
     */
    public function getCampo() {
        return $this->campo;
    }

    /**
     * Set nivel
     *
     * @param \Pasantias\CurriculumBundle\Entity\Nivel $nivel
     * @return Conocimientos
     */
    public function setNivel(\Pasantias\CurriculumBundle\Entity\Nivel $nivel = null) {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return \Pasantias\CurriculumBundle\Entity\Nivel 
     */
    public function getNivel() {
        return $this->nivel;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Conocimientos
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }


    /**
     * Set personas
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $personas
     * @return Conocimientos
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