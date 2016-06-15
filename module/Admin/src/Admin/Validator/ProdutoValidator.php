<?php

namespace Admin\Validator;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;

class ProdutoValidator extends InputFilter
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
            'name' => 'nome',
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
        $this->add($factory->createInput(array(
            'name' => 'preco',
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
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
        $this->add($factory->createInput(array(
            'name' => 'lucro',
            'required' => true,
            'filters' => array(
                array('name' => 'Digits'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        )));
    }
}
