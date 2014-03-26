<?php

namespace Pasantias\UsuariosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pasantias\UsuariosBundle\Entity\Perfil;

/**
 * Description of Perfiles
 *
 * @author matias solis de la torre
 */
class Perfiles extends AbstractFixture implements OrderedFixtureInterface {
    
    public function getOrder() {
        return 5;
    }

    public function load(ObjectManager $manager) {
        $perfiles = array(
            array('nombrePerfil' => 'Administrador', 'roleName' => 'ROLE_ADMIN'),
            array('nombrePerfil' => 'Alumno', 'roleName' => 'ROLE_ALUMNO'),
            array('nombrePerfil' => 'Profesor', 'roleName' => 'ROLE_PROFESOR'),
            array('nombrePerfil' => 'Empresa', 'roleName' => 'ROLE_EMPRESA'),
        );

        foreach ($perfiles as $perfil) {
            $entidad = new Perfil();

            $entidad->setNombrePerfil($perfil['nombrePerfil']);
            $entidad->setRoleName($perfil['roleName']);

            $manager->persist($entidad);
        }

        $manager->flush();
    }

}
