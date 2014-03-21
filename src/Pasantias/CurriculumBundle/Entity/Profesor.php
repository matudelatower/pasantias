<?php

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Profesor
 *
 * @ORM\Table(name="profesor")
 * @ORM\Entity(repositoryClass="Pasantias\CurriculumBundle\Entity\ProfesorRepository")
 */
class Profesor {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=255)
     */
    private $matricula;

    /**
     * @ORM\OneToOne(targetEntity="Pasantias\UsuariosBundle\Entity\Usuarios", mappedBy="profesor")
     */
    private $usuario;

    /** @ORM\OneToMany(targetEntity="Pasantias\EmpresasBundle\Entity\Postulaciones", mappedBy="profesor", cascade={"persist", "remove"}) 
     *  @Assert\Valid()
     */
    private $postulaciones;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postulaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set nombre
     *
     * @param string $nombre
     * @return Profesor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Profesor
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set matricula
     *
     * @param string $matricula
     * @return Profesor
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    /**
     * Get matricula
     *
     * @return string 
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set usuario
     *
     * @param \Pasantias\UsuariosBundle\Entity\Usuarios $usuario
     * @return Profesor
     */
    public function setUsuario(\Pasantias\UsuariosBundle\Entity\Usuarios $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Pasantias\UsuariosBundle\Entity\Usuarios 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add postulaciones
     *
     * @param \Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones
     * @return Profesor
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