<?php

namespace Pasantias\CurriculumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormacionAcademicaSecundaria
 *
 * @ORM\Table(name="formacion_academica_secundaria")
 * @ORM\Entity(repositoryClass="Pasantias\CurriculumBundle\Entity\FormacionAcademicaSecundariaRepository")
 */
class FormacionAcademicaSecundaria
{
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
     * @ORM\Column(name="egreso", type="string", length=255)
     */
    private $egreso;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona", inversedBy="formacionAcademicaSecundaria", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="personas_id", referencedColumnName="id")
     */
    private $personas;


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
     * Set egreso
     *
     * @param string $egreso
     * @return FormacionAcademicaSecundaria
     */
    public function setEgreso($egreso)
    {
        $this->egreso = $egreso;
    
        return $this;
    }

    /**
     * Get egreso
     *
     * @return string 
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * Set institucion
     *
     * @param string $institucion
     * @return FormacionAcademicaSecundaria
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;
    
        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return FormacionAcademicaSecundaria
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
     * Set personas
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $personas
     * @return FormacionAcademicaSecundaria
     */
    public function setPersonas(\Pasantias\CurriculumBundle\Entity\Persona $personas = null)
    {
        $this->personas = $personas;
    
        return $this;
    }

    /**
     * Get personas
     *
     * @return \Pasantias\CurriculumBundle\Entity\Persona 
     */
    public function getPersonas()
    {
        return $this->personas;
    }
}