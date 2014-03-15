<?php

namespace Pasantias\UbicacionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pasantias\UbicacionBundle\Entity\Provincias;

/**
 * Description of ProvinciasLocalidades
 *
 * @author matias solis de la torre
 */
class ProvinciasData extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 1;
    }

    public function load(ObjectManager $manager) {
        $provincias = array(
            array('id' => 1, 'nombreProvincia' => 'Buenos Aires'),
            array('id' => 2, 'nombreProvincia' => 'Buenos Aires-GBA'),
            array('id' => 3, 'nombreProvincia' => 'Capital Federal'),
            array('id' => 4, 'nombreProvincia' => 'Catamarca'),
            array('id' => 5, 'nombreProvincia' => 'Chaco'),
            array('id' => 6, 'nombreProvincia' => 'Chubut'),
            array('id' => 7, 'nombreProvincia' => 'Córdoba'),
            array('id' => 8, 'nombreProvincia' => 'Corrientes'),
            array('id' => 9, 'nombreProvincia' => 'Entre Ríos'),
            array('id' => 10, 'nombreProvincia' => 'Formosa'),
            array('id' => 11, 'nombreProvincia' => 'Jujuy'),
            array('id' => 12, 'nombreProvincia' => 'La Pampa'),
            array('id' => 13, 'nombreProvincia' => 'La Rioja'),
            array('id' => 14, 'nombreProvincia' => 'Mendoza'),
            array('id' => 15, 'nombreProvincia' => 'Misiones'),
            array('id' => 16, 'nombreProvincia' => 'Neuquén'),
            array('id' => 17, 'nombreProvincia' => 'Río Negro'),
            array('id' => 18, 'nombreProvincia' => 'Salta'),
            array('id' => 19, 'nombreProvincia' => 'San Juan'),
            array('id' => 20, 'nombreProvincia' => 'San Luis'),
            array('id' => 21, 'nombreProvincia' => 'Santa Cruz'),
            array('id' => 22, 'nombreProvincia' => 'Santa Fe'),
            array('id' => 23, 'nombreProvincia' => 'Santiago del Estero'),
            array('id' => 24, 'nombreProvincia' => 'Tierra del Fuego'),
            array('id' => 25, 'nombreProvincia' => 'Tucumán'),
        );

        foreach ($provincias as $provincia) {
            $entidadProv = new Provincias();

            $entidadProv->setNombreProvincia($provincia['nombreProvincia']);

            $manager->persist($entidadProv);
            $this->addReference('provincia' . $provincia['id'], $entidadProv);
        }


        $manager->flush();
    }

}

?>
