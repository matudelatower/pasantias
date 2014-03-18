<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pasantias\UtilBundle\Form\DataTransformer;

/**
 * Description of TinyIntToBooleanTransformer
 *
 * @author Matias Solis de la Torre <matias.delatorre89@gmail.com>
 */
class TinyIntToBooleanTransformer implements DataTransformerInterface {

    private $trueValue;
    private $falseValue;

    public function __construct($trueValue, $falseValue) {
        $this->trueValue = $trueValue;
        $this->falseValue = $falseValue;
    }

    public function transform($value) {
        if (null === $value) {
            return null;
        }

//        if (!is_bool($value)) {
//            throw new TransformationFailedException('Expected a Boolean.');
//        }

        if ($value == 0) {
            $value = false;
        } elseif ($value == 1) {
            $value = true;
        }

        return true === $value ? $this->trueValue : $this->falseValue;
    }

    public function reverseTransform($value) {
        if (null === $value) {
            return null;
        }

        if (!is_string($value)) {
            throw new TransformationFailedException('Expected a string.');
        }

        return $this->trueValue === $value;
    }

}
