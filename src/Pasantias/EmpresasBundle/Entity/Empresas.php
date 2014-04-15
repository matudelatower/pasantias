<?php

namespace Pasantias\EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pasantias\EmpresasBundle\Entity\Empresas
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="empresas")
 */
class Empresas {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $nombreEmpresa;

    /** @ORM\OneToMany(targetEntity="Pasantias\CurriculumBundle\Entity\Domicilio", mappedBy="empresas", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $domicilio;

    /** @ORM\Column(name="persona_contacto",type="string", length=100) */
    private $personaContacto;

    /** @ORM\Column(name="tel_contacto",type="string", length=100) */
    private $telContacto;

    /** @ORM\Column(name="mail_contacto",type="string", length=100) 
     * @Assert\Email()
     */
    private $mailContacto;

    /** 
     * @ORM\Column(name="pagina_web",type="string", length=100,nullable=true) 
     * 
     */
    private $paginaWeb;

    /**
     * @ORM\OneToOne(targetEntity="Pasantias\UsuariosBundle\Entity\Usuarios", mappedBy="empresa")
     */
    private $usuario;
    
    /** @ORM\OneToMany(targetEntity="Pasantias\EmpresasBundle\Entity\PostulacionesNuevas", mappedBy="empresa")      
     */
    private $postulacionNueva;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombreEmpresa
     *
     * @param string $nombreEmpresa
     * @return Empresas
     */
    public function setNombreEmpresa($nombreEmpresa) {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    /**
     * Get nombreEmpresa
     *
     * @return string 
     */
    public function getNombreEmpresa() {
        return $this->nombreEmpresa;
    }

    /**
     * Set personaContacto
     *
     * @param string $personaContacto
     * @return Empresas
     */
    public function setPersonaContacto($personaContacto) {
        $this->personaContacto = $personaContacto;

        return $this;
    }

    /**
     * Get personaContacto
     *
     * @return string 
     */
    public function getPersonaContacto() {
        return $this->personaContacto;
    }

    /**
     * Set telContacto
     *
     * @param string $telContacto
     * @return Empresas
     */
    public function setTelContacto($telContacto) {
        $this->telContacto = $telContacto;

        return $this;
    }

    /**
     * Get telContacto
     *
     * @return string 
     */
    public function getTelContacto() {
        return $this->telContacto;
    }

    /**
     * Set mailContacto
     *
     * @param string $mailContacto
     * @return Empresas
     */
    public function setMailContacto($mailContacto) {
        $this->mailContacto = $mailContacto;

        return $this;
    }

    /**
     * Get mailContacto
     *
     * @return string 
     */
    public function getMailContacto() {
        return $this->mailContacto;
    }

    /**
     * Set paginaWeb
     *
     * @param string $paginaWeb
     * @return Empresas
     */
    public function setPaginaWeb($paginaWeb) {
        $this->paginaWeb = $paginaWeb;

        return $this;
    }

    /**
     * Get paginaWeb
     *
     * @return string 
     */
    public function getPaginaWeb() {
        return $this->paginaWeb;
    }

    /**
     * Set domicilio
     *
     * @param \Pasantias\CurriculumBundle\Entity\Domicilio $domicilio
     * @return Empresas
     */
    public function setDomicilio(\Pasantias\CurriculumBundle\Entity\Domicilio $domicilio = null) {
        $this->domicilio = $domicilio;

        foreach ($domicilio as $domicilios) {
            $domicilios->setEmpresas($this);
        }
    }

    /**
     * Get domicilio
     *
     * @return \Pasantias\CurriculumBundle\Entity\Domicilio 
     */
    public function getDomicilio() {
        return $this->domicilio;
    }

    public function __toString() {
        return $this->nombreEmpresa;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->domicilio = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add domicilio
     *
     * @param \Pasantias\CurriculumBundle\Entity\Domicilio $domicilio
     * @return Empresas
     */
    public function addDomicilio(\Pasantias\CurriculumBundle\Entity\Domicilio $domicilio) {
        $this->domicilio[] = $domicilio;

        return $this;
    }

    /**
     * Remove domicilio
     *
     * @param \Pasantias\CurriculumBundle\Entity\Domicilio $domicilio
     */
    public function removeDomicilio(\Pasantias\CurriculumBundle\Entity\Domicilio $domicilio) {
        $this->domicilio->removeElement($domicilio);
    }

    /**
     * Set usuario
     *
     * @param \Pasantias\UsuariosBundle\Entity\Usuarios $usuario
     * @return Empresas
     */
    public function setUsuario(\Pasantias\UsuariosBundle\Entity\Usuarios $usuario = null) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Pasantias\UsuariosBundle\Entity\Usuarios 
     */
    public function getUsuario() {
        return $this->usuario;
    }


    /**
     * Add postulacionNueva
     *
     * @param \Pasantias\EmpresasBundle\Entity\PostulacionesNuevas $postulacionNueva
     * @return Empresas
     */
    public function addPostulacionNueva(\Pasantias\EmpresasBundle\Entity\PostulacionesNuevas $postulacionNueva)
    {
        $this->postulacionNueva[] = $postulacionNueva;
    
        return $this;
    }

    /**
     * Remove postulacionNueva
     *
     * @param \Pasantias\EmpresasBundle\Entity\PostulacionesNuevas $postulacionNueva
     */
    public function removePostulacionNueva(\Pasantias\EmpresasBundle\Entity\PostulacionesNuevas $postulacionNueva)
    {
        $this->postulacionNueva->removeElement($postulacionNueva);
    }

    /**
     * Get postulacionNueva
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostulacionNueva()
    {
        return $this->postulacionNueva;
    }
}