<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubArea
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pasantias\CurriculumBundle\Entity\SubArea
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="sub_area")
 */
class SubArea {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Area")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     * @Assert\Type("Pasantias\CurriculumBundle\Entity\Area")
     * @Assert\NotNull()
     */
    private $area;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SubArea
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set area
     *
     * @param \Pasantias\CurriculumBundle\Entity\Area $area
     * @return SubArea
     */
    public function setArea(\Pasantias\CurriculumBundle\Entity\Area $area = null) {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \Pasantias\CurriculumBundle\Entity\Area 
     */
    public function getArea() {
        return $this->area;
    }

    public function __toString() {
        return $this->nombre;
    }

}