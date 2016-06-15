<?php

namespace Admin\Form;

use Zend\Form\Form;

class CategoriaForm extends Form
{
    public function __construct()
    {
        parent::__construct('CategoriaForm');
        $this->setAttribute('action', '');
        $this->setAttribute('method', 'POST');
        $this->add(
            array(
                'name' => 'id',
                'type' => 'hidden',
            )
        );
        $this->add(
            array(
                'name' => 'nome',
                'type' => 'text',
                'options' => array(
                    'label' => 'Descrição da categoria*:'
                ),
                'attributes' => array(
                    'placeholder' => 'Informe a categoria'
                ),
            )
        );
        $this->add(
            array(
                'name' => 'salvar',
                'type' => 'submit',
                'attributes' => array(
                    'value' => 'Salvar',
                )
            )
        );
    }
}
