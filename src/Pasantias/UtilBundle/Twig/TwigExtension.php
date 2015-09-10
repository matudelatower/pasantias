<?php

namespace Pasantias\UtilBundle\Twig;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of TwigExtension
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */

class TwigExtension extends Twig_Extension {

    /**
     * Return the functions registered as twig extensions
     * 
     * @return array
     */
    public function getFunctions() {
        return array(
            'file_exists' => new Twig_SimpleFunction('file_exists','file_exists'),
        );
    }

    public function getName() {
        return 'twig_extension';
    }

}
