<?php

namespace Pasantias\UsuariosBundle\Entity;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use Symfony\Component\Validator\Constraints as Assert;
use Pasantias\UsuariosBundle\Entity\Usuarios;

/**
 * Description of Registracion
 *
 * @author matias solis de la torre
 */
class Registracion {

    /**
     * @Assert\Type(type="Pasantias\UsuariosBundle\Entity\Usuarios")
     * 
     */
    protected $usuario;

    public function setUsuario(Usuarios $user) {
        $this->usuario = $user;
    }

    public function getUsuario() {
        return $this->usuario;
    }

}

