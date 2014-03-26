<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Carrera
 *
 * @author matias
 */

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pasantias\CurriculumBundle\Entity\Carrera
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="carrera")
 */
class Carrera {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $nombre;

    /** @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\TipoCarrera"), inversedBy="carrera")
     *  @ORM\JoinColumn(name="tipo_carrera_id", referencedColumnName="id")
     */
    private $tipo;

    /** @ORM\Column(type="string", length=100, nullable=true) */
    private $plan;

    /** @ORM\Column(type="string", length=100) */
    private $duracion;

    /** @ORM\Column(name="cantidad_materias",type="string", length=100, nullable=true) */
    private $cantidadMaterias;

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
     * @return Carrera
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
     * Set plan
     *
     * @param string $plan
     * @return Carrera
     */
    public function setPlan($plan) {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string 
     */
    public function getPlan() {
        return $this->plan;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     * @return Carrera
     */
    public function setDuracion($duracion) {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion() {
        return $this->duracion;
    }

    /**
     * Set cantidadMaterias
     *
     * @param string $cantidadMaterias
     * @return Carrera
     */
    public function setCantidadMaterias($cantidadMaterias) {
        $this->cantidadMaterias = $cantidadMaterias;

        return $this;
    }

    /**
     * Get cantidadMaterias
     *
     * @return string 
     */
    public function getCantidadMaterias() {
        return $this->cantidadMaterias;
    }

    /**
     * Set tipo
     *
     * @param \Pasantias\CurriculumBundle\Entity\TipoCarrera $tipo
     * @return Carrera
     */
    public function setTipo(\Pasantias\CurriculumBundle\Entity\TipoCarrera $tipo = null) {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Pasantias\CurriculumBundle\Entity\TipoCarrera 
     */
    public function getTipo() {
        return $this->tipo;
    }

    public function __toString() {
        return $this->nombre;
    }

}