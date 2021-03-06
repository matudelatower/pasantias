<?php

namespace Pasantias\UsuariosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Pasantias\UsuariosBundle\Entity\Usuarios
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 * @UniqueEntity(fields="usuario",message="El usuario ya existe.")
 * @UniqueEntity(fields="mail", message="El mail ya existe.")
 */
class Usuarios implements AdvancedUserInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(type="string", length=100,unique=true) */
    protected $usuario;

    /** @ORM\Column(type="string", length=100) */
    protected $password;

    /** @ORM\Column(type="boolean") */
    protected $activo;

    /** @ORM\Column(type="string", length=100,unique=true) */
    protected $mail;

    /**
     * @ORM\ManyToOne(targetEntity="Perfil",inversedBy="usuario")
     * @ORM\JoinColumn(name="perfil_id",referencedColumnName="id")
     */
    protected $perfil;

    /**
     * @ORM\Column(name="salt", type="string", length=255)
     */
    protected $salt;
    
    /**
     * @ORM\OneToOne(targetEntity="Pasantias\EmpresasBundle\Entity\Empresas",inversedBy="usuario")
     * @ORM\JoinColumn(name="empresas_id", referencedColumnName="id")
     */
    protected $empresa;
    
    /**
     * @ORM\OneToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Persona",inversedBy="usuario")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    protected $persona;
    
    /**
     * @ORM\OneToOne(targetEntity="Pasantias\CurriculumBundle\Entity\Profesor",inversedBy="usuario")
     * @ORM\JoinColumn(name="profesor_id", referencedColumnName="id")
     */
    protected $profesor;


    public function getRoles() {
        return array($this->perfil->getRole());
//        return array('ROLE_ALUMNO');
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->usuario;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function eraseCredentials() {
        
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->activo;
    }
    
    public function __sleep() {
        return array('id', 'usuario', 'password');
    }

    public function __construct() {        
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Usuarios
     */
    public function setUsuario($usuario) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Usuarios
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo() {
        return $this->activo;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Usuarios
     */
    public function setMail($mail) {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail() {
        return $this->mail;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuarios
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set perfil
     *
     * @param Perfil $perfil
     * @return Usuarios
     */
    public function setPerfil(Perfil $perfil = null) {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get perfil
     *
     * @return Perfil 
     */
    public function getPerfil() {
        return $this->perfil;
    }

    /**
     * Set empresa
     *
     * @param \Pasantias\EmpresasBundle\Entity\Empresas $empresa
     * @return Usuarios
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
     * Set persona
     *
     * @param \Pasantias\CurriculumBundle\Entity\Persona $persona
     * @return Usuarios
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
}