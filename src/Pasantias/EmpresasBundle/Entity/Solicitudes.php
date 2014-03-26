<?php

namespace Pasantias\EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pasantias\EmpresasBundle\Entity\Solicitudes
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="solicitudes")
 */
class Solicitudes {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(name="fecha_desde",type="date") */
    private $fechaDesde;

    /** @ORM\Column(name="fecha_hasta",type="date") */
    private $fechaHasta;

    /** @ORM\Column(name="perfil_postulante",type="text") */
    private $perfilPostulante;

    /** @ORM\Column(name="conocimientos_requeridos",type="text") */
    private $conocRequeridos;

    /** @ORM\Column(name="nivel_carrera_candidato",type="text") */
    private $nivelCarreraCandidato;

    /** @ORM\Column(name="solicitud_atendida",type="boolean") */
    private $solicitudAtendida;

    /** 
     * @ORM\Column(name="tipo_trabajo_id")
     * @ORM\OneToOne(targetEntity="Pasantias\EmpresasBundle\Entity\TiposTrabajo") */
    private $tiposTrabajo;

    /** 
     * @ORM\Column(name="sub_area_id")
     * @ORM\OneToOne(targetEntity="Pasantias\CurriculumBundle\Entity\SubArea") */
    private $subArea;

    /** @ORM\ManyToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Empresas") */
    private $empresa;

    /** @ORM\OneToMany(targetEntity="Pasantias\EmpresasBundle\Entity\Postulaciones", mappedBy="solicitud", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $postulaciones;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set fechaDesde
     *
     * @param \DateTime $fechaDesde
     * @return Solicitudes
     */
    public function setFechaDesde($fechaDesde) {
        $this->fechaDesde = $fechaDesde;

        return $this;
    }

    /**
     * Get fechaDesde
     *
     * @return \DateTime 
     */
    public function getFechaDesde() {
        return $this->fechaDesde;
    }

    /**
     * Set fechaHasta
     *
     * @param \DateTime $fechaHasta
     * @return Solicitudes
     */
    public function setFechaHasta($fechaHasta) {
        $this->fechaHasta = $fechaHasta;

        return $this;
    }

    /**
     * Get fechaHasta
     *
     * @return \DateTime 
     */
    public function getFechaHasta() {
        return $this->fechaHasta;
    }

    /**
     * Set perfilPostulante
     *
     * @param string $perfilPostulante
     * @return Solicitudes
     */
    public function setPerfilPostulante($perfilPostulante) {
        $this->perfilPostulante = $perfilPostulante;

        return $this;
    }

    /**
     * Get perfilPostulante
     *
     * @return string 
     */
    public function getPerfilPostulante() {
        return $this->perfilPostulante;
    }

    /**
     * Set conocRequeridos
     *
     * @param string $conocRequeridos
     * @return Solicitudes
     */
    public function setConocRequeridos($conocRequeridos) {
        $this->conocRequeridos = $conocRequeridos;

        return $this;
    }

    /**
     * Get conocRequeridos
     *
     * @return string 
     */
    public function getConocRequeridos() {
        return $this->conocRequeridos;
    }

    /**
     * Set nivelCarreraCandidato
     *
     * @param string $nivelCarreraCandidato
     * @return Solicitudes
     */
    public function setNivelCarreraCandidato($nivelCarreraCandidato) {
        $this->nivelCarreraCandidato = $nivelCarreraCandidato;

        return $this;
    }

    /**
     * Get nivelCarreraCandidato
     *
     * @return string 
     */
    public function getNivelCarreraCandidato() {
        return $this->nivelCarreraCandidato;
    }

    /**
     * Set solicitudAtendida
     *
     * @param boolean $solicitudAtendida
     * @return Solicitudes
     */
    public function setSolicitudAtendida($solicitudAtendida) {
        $this->solicitudAtendida = $solicitudAtendida;

        return $this;
    }

    /**
     * Get solicitudAtendida
     *
     * @return boolean 
     */
    public function getSolicitudAtendida() {
        return $this->solicitudAtendida;
    }

    /**
     * Set tiposTrabajo
     *
     * @param \Pasantias\EmpresasBundle\Entity\TiposTrabajo $tiposTrabajo
     * @return Solicitudes
     */
    public function setTiposTrabajo(\Pasantias\EmpresasBundle\Entity\TiposTrabajo $tiposTrabajo = null) {
        $this->tiposTrabajo = $tiposTrabajo;

        return $this;
    }

    /**
     * Get tiposTrabajo
     *
     * @return \Pasantias\EmpresasBundle\Entity\TiposTrabajo 
     */
    public function getTiposTrabajo() {
        return $this->tiposTrabajo;
    }

    /**
     * Set subArea
     *
     * @param \Pasantias\CurriculumBundle\Entity\SubArea $subArea
     * @return Solicitudes
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
     * Set empresa
     *
     * @param \Pasantias\EmpresasBundle\Entity\Empresas $empresa
     * @return Solicitudes
     */
    public function setEmpresa(\Pasantias\EmpresasBundle\Entity\Empresas $empresa = null) {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Pasantias\EmpresasBundle\Entity\Empresas 
     */
    public function getEmpresa() {
        return $this->empresa;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postulaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add postulaciones
     *
     * @param \Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones
     * @return Solicitudes
     */
    public function addPostulacione(\Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones)
    {
        $this->postulaciones[] = $postulaciones;
    
        return $this;
    }

    /**
     * Remove postulaciones
     *
     * @param \Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones
     */
    public function removePostulacione(\Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones)
    {
        $this->postulaciones->removeElement($postulaciones);
    }

    /**
     * Get postulaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulaciones()
    {
        return $this->postulaciones;
    }
}