<?php

namespace Pasantias\UtilBundle\Twig;

/**
 * Description of TwigExtension
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */

class TwigExtension extends \Twig_Extension {

    /**
     * Return the functions registered as twig extensions
     * 
     * @return array
     */
    public function getFunctions() {
        return array(
            'file_exists' => new \Twig_Function_Function('file_exists'),
        );
    }

    public function getName() {
        return 'twig_extension';
    }

}
