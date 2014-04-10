<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nivel
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Pasantias\CurriculumBundle\Entity\Nivel
 */

/**
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"nombre"}, 
 *     message="Ya existe el nivel"
 * )
 * @ORM\Table(name="nivel")
 */
class Nivel {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=20) */
    private $nombre;

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
     * @return Nivel
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

    public function __toString() {
        return $this->nombre;
    }

}
