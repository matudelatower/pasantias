<?php

namespace Pasantias\UsuariosBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ChangePassword
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */
class ChangePassword {

    /**
     * @SecurityAssert\UserPassword(
     *     message = "El password no coincide con el actual"
     * )
     */
    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "El password debe tener al menos 6 caracteres"
     * )
     */public function getOldPassword() {
        return $this->oldPassword;
    }

    public function getNewPassword() {
        return $this->newPassword;
    }

    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
    }

    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
    }

        protected $newPassword;

}
