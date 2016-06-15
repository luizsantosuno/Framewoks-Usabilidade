<?php

namespace Admin\Validator;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ServicoValidator extends InputFilter
{
    public function __construct()
    {
        $factory = new InputFactory();
        $this->add($factory->createInput(array(
            'name' => 'id',
            'required' => false,
            'filters' => array(
                array('name' => 'Digits'),
            ),
        )));
        $this->add($factory->createInput(array(
            'name' => 'hora',
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
                array(
                    'name' => 'regex', false,
                    'options' => array(
                        'pattern' => '/^[0-9]+$/',
                    )
                ),
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        )));

        $this->add($factory->createInput(array(
            'name' => 'taxa',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'regex', false,
                    'options' => array(
                        'pattern' => '/^(?:\d*\.)?\d+$/',
                    )
                ),
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        )));

        $this->add($factory->createInput(array(
            'name' => 'especificacao',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
                array('name' => 'StringToUpper',
                    'options' => array('encoding' => 'UTF-8')
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        )));
    }
}
