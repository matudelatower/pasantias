<?php

namespace Pasantias\CurriculumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pasantias\CurriculumBundle\Entity\TipoCarrera;

/**
 * Description of TipoCarreraData
 *
 * @author root
 */
class TipoCarreraData extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 3;
    }

    public function load(ObjectManager $manager) {
        $tipocarreras = array(
            array('id' => 1, 'nombre' => 'Pregrado'),
            array('id' => 2, 'nombre' => 'Grado'),
        );
        foreach ($tipocarreras as $tipocarrera) {
            $entidad = new TipoCarrera();
            $entidad->setNombre($tipocarrera['nombre']);

            $manager->persist($entidad);
            $this->addReference('tipoCarrera' . $tipocarrera['id'], $entidad);
        }
        $manager->flush();
    }

}


