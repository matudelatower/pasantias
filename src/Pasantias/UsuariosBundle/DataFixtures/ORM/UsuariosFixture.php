<?php

namespace Pasantias\UsuariosBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pasantias\UsuariosBundle\Entity\Usuarios;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of UsuariosFixture
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */
class UsuariosFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    public function getOrder() {
        return 6;
    }

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {

        $usuario = new Usuarios();
        $usuario->setUsuario('admin');
        $usuario->setActivo(true);
        $usuario->setMail('admin@admin.com');
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($usuario);
        $password = $encoder->encodePassword('123456', $usuario->getSalt());
        $usuario->setPassword($password);
        $usuario->setPerfil($manager->getRepository("UsuariosBundle:Perfil")->findOneByNombrePerfil('Administrador'));

        $manager->persist($usuario);


        $manager->flush();
    }

}
