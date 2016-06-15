<?php

namespace Admin\Form;

use Zend\Form\Form;

class ServicoForm extends Form
{
    public function __construct()
    {
        parent::__construct('ServicoForm');
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
                'name' => 'hora',
                'type' => 'text',
                'options' => array(
                    'label' => 'Hora*:',
                ),
                'attributes' => array(
                    'placeholder' => 'Informe a hora',
                    'tilte' => 'horas usada para o cálculo do lucro??',
                ),
            )
        );
        $this->add(
            array(
                'name' => 'taxa',
                'type' => 'text',
                'options' => array(
                    'label' => 'Taxa pelo Serviço*:',
                ),
                'attributes' => array(
                    'placeholder' => 'Informe a taxa do serviço',
                    'title' => 'Taxa cobrada de acordo com a hora',
                ),
            )
        );
        $this->add(
            array(
                'name' => 'especificacao',
                'type' => 'textarea',
                'options' => array(
                    'label' => 'Especificação do Serviço*:',
                ),
                'attributes' => array(
                    'placeholder' => 'Informe a especificação do Serviço',
                    'title' => 'Especificação do Serviço',
                ),
            )
        );
        $this->add(
            array(
                'name' => 'salvar',
                'type' => 'submit',
                'attributes' => array(
                    'Value' => 'Salvar'
                )
            )
        );
    }
}
