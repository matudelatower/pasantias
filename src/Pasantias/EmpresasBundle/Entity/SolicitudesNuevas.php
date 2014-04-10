<?php

namespace Pasantias\EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of SolicitudesNuevas
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="solicitudes_nuevas")
 */
class SolicitudesNuevas {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(name="visto",type="boolean") */
    private $visto;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="solicitudNueva", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    protected $persona;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Solicitudes", inversedBy="solicitudNueva", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id")
     */
    protected $solicitudes;


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
     * @return SolicitudesNuevas
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
     * Set persona
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $persona
     * @return SolicitudesNuevas
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
     * Set solicitudes
     *
     * @param \Pasantias\EmpresasBundle\Entity\Solicitudes $solicitudes
     * @return SolicitudesNuevas
     */
    public function setSolicitudes(\Pasantias\EmpresasBundle\Entity\Solicitudes $solicitudes = null)
    {
        $this->solicitudes = $solicitudes;
    
        return $this;
    }

    /**
     * Get solicitudes
     *
     * @return \Pasantias\EmpresasBundle\Entity\Solicitudes 
     */
    public function getSolicitudes()
    {
        return $this->solicitudes;
    }
}