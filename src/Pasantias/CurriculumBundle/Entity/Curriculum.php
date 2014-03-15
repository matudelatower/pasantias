<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Curriculum
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pasantias\CurriculumBundle\Entity\Curriculum
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="curriculum")
 */
class Curriculum {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="curriculum",cascade={"persist"})
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * @Assert\Valid()
     * */
    private $persona;

    /** @ORM\Column(type="date") */
    private $fecha;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Curriculum
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set persona
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $persona
     * @return Curriculum
     */
    public function setPersona(\Pasantias\CurriculumBundle\Entity\Persona $persona = null) {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \Pasantias\CurriculumBundle\Entity\Persona 
     */
    public function getPersona() {
        return $this->persona;
    }

    public function __construct() {
//        $this->persona = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->persona = new \Doctrine\Common\Collections\ArrayCollection();
    }

}