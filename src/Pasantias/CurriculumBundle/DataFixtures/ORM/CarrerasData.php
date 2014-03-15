<?php

namespace Pasantias\CurriculumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pasantias\CurriculumBundle\Entity\Carrera;

/**
 * Description of CarrerasData
 *
 * @author matias solis de la torre
 */
class CarrerasData extends AbstractFixture implements OrderedFixtureInterface {

    public function getOrder() {
        return 4;
    }

    public function load(ObjectManager $manager) {
        $carreras = array(
            array('nombre' => 'Analista en Sistemas de Computación', 'duracion' => 3, 'tipo' => 1),
            array('nombre' => 'Bioquímica', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Enfermería Universitaria', 'duracion' => 3, 'tipo' => 1),
            array('nombre' => 'Farmacia', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Ingeniería en Alimentos', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Ingeniería Química', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Licenciatura en Análisis Químicos y Bromatológicos', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Licenciatura en Enfermería', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Licenciatura en Genética', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Licenciatura en Sistemas de Información', 'duracion' => 5, 'tipo' => 2),
            array('nombre' => 'Profesorado en Biología', 'duracion' => 4, 'tipo' => 2),
            array('nombre' => 'Profesorado en Física', 'duracion' => 4, 'tipo' => 2),
            array('nombre' => 'Profesorado en Matemática', 'duracion' => 4, 'tipo' => 2),
            array('nombre' => 'Tecnicatura Universitaria en Celulosa y Papel', 'duracion' => 3, 'tipo' => 1),
        );

        foreach ($carreras as $carrera) {
            $entidad = new Carrera();

            $entidad->setNombre($carrera['nombre']);
            $entidad->setDuracion($carrera['duracion']);
            $entidad->setTipo($manager->merge($this->getReference('tipoCarrera' . $carrera['tipo'])));

            $manager->persist($entidad);
        }

        $manager->flush();
    }

}

