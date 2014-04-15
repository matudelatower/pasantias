<?php

namespace Pasantias\EmpresasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of PostulacionesNuevas
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="postulaciones_nuevas")
 */
class PostulacionesNuevas {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /** @ORM\Column(name="visto",type="boolean") */
    private $visto;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Empresas", inversedBy="postulacionNueva", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    protected $empresa;

    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Postulaciones", inversedBy="postulacionNueva", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="postulacion_id", referencedColumnName="id")
     */
    protected $postulaciones;


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
     * @return PostulacionesNuevas
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
     * Set empresa
     *
     * @param \Pasantias\EmpresasBundle\Entity\Empresas $empresa
     * @return PostulacionesNuevas
     */
    public function setEmpresa(\Pasantias\EmpresasBundle\Entity\Empresas $empresa = null)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Pasantias\EmpresasBundle\Entity\Empresas 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set postulaciones
     *
     * @param \Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones
     * @return PostulacionesNuevas
     */
    public function setPostulaciones(\Pasantias\EmpresasBundle\Entity\Postulaciones $postulaciones = null)
    {
        $this->postulaciones = $postulaciones;
    
        return $this;
    }

    /**
     * Get postulaciones
     *
     * @return \Pasantias\EmpresasBundle\Entity\Postulaciones 
     */
    public function getPostulaciones()
    {
        return $this->postulaciones;
    }
}