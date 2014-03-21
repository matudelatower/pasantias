<?php

namespace Pasantias\EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Postulaciones
 *
 * @ORM\Table(name="postulaciones")
 * @ORM\Entity(repositoryClass="Pasantias\EmpresasBundle\Entity\PostulacionesRepository")
 */
class Postulaciones {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Solicitudes", inversedBy="postulaciones", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id")
     */
    private $solicitud;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="postulaciones", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    protected $persona;

    /**
     * @var boolean
     *
     * @ORM\Column(name="visto", type="boolean")
     */
    private $visto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cerrada", type="boolean")
     */
    private $cerrada;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Profesor", inversedBy="postulaciones", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="profesor_id", referencedColumnName="id")
     */
    private $profesor;

    public function __construct() {
        $this->visto=FALSE;
        $this->cerrada=FALSE;
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
     * Set visto
     *
     * @param boolean $visto
     * @return Postulaciones
     */
    public function setVisto($visto)
    {
        $this->visto = $visto;
    
        return $this;
    }

    /**
     * Get visto
     *
     * @return boolean 
     */
    public function getVisto()
    {
        return $this->visto;
    }

    /**
     * Set cerrada
     *
     * @param boolean $cerrada
     * @return Postulaciones
     */
    public function setCerrada($cerrada)
    {
        $this->cerrada = $cerrada;
    
        return $this;
    }

    /**
     * Get cerrada
     *
     * @return boolean 
     */
    public function getCerrada()
    {
        return $this->cerrada;
    }

    /**
     * Set solicitud
     *
     * @param \Pasantias\EmpresasBundle\Entity\Solicitudes $solicitud
     * @return Postulaciones
     */
    public function setSolicitud(\Pasantias\EmpresasBundle\Entity\Solicitudes $solicitud = null)
    {
        $this->solicitud = $solicitud;
    
        return $this;
    }

    /**
     * Get solicitud
     *
     * @return \Pasantias\EmpresasBundle\Entity\Solicitudes 
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Set persona
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $persona
     * @return Postulaciones
     */
    public function setPersona(\Pasantias\CurriculumBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \Pasantias\CurriculumBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set profesor
     *
     * @param \Pasantias\CurriculumBundle\Entity\Profesor $profesor
     * @return Postulaciones
     */
    public function setProfesor(\Pasantias\CurriculumBundle\Entity\Profesor $profesor = null)
    {
        $this->profesor = $profesor;
    
        return $this;
    }

    /**
     * Get profesor
     *
     * @return \Pasantias\CurriculumBundle\Entity\Profesor 
     */
    public function getProfesor()
    {
        return $this->profesor;
    }
}