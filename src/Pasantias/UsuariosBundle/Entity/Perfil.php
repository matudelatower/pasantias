<?php

namespace Pasantias\UsuariosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Pasantias\PasantiasBundle\Entity\TiposUsuario
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="perfiles")
 */
class Perfil implements RoleInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(name="nombre_perfil",type="string", length=100) */
    protected $nombrePerfil;

    /** @ORM\Column(name="role_name",type="string", length=100) */
    protected $roleName;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="\Pasantias\UsuariosBundle\Entity\Usuarios", mappedBy="perfil")
     */
    protected $usuario;

    public function getRole() {
        return $this->roleName;
    }
    
    public function __toString() {
        $this->nombrePerfil;
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
     * Set nombrePerfil
     *
     * @param string $nombrePerfil
     * @return Perfil
     */
    public function setNombrePerfil($nombrePerfil) {
        $this->nombrePerfil = $nombrePerfil;

        return $this;
    }

    /**
     * Get nombrePerfil
     *
     * @return string 
     */
    public function getNombrePerfil() {
        return $this->nombrePerfil;
    }

    /**
     * Set roleName
     *
     * @param string $roleName
     * @return Perfil
     */
    public function setRoleName($roleName) {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName() {
        return $this->roleName;
    }

}
