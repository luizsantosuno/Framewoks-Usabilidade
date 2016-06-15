<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\InputFilter;

class ProdutoForm extends Form
{
    public function __construct($em)
    {
        parent::__construct('CategoriaForm');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('action', '');
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
                    'label' => 'Nome do produto*:'
                ),
                'attributes' => array(
                    'placeholder' => 'Informe o nome do produto'
                ),
            )
        );
        $this->add(
            array(
                'name' => 'preco',
                'type' => 'text',
                'options' => array(
                    'label' => 'Preço do produto*:'
                ),
                'attributes' => array(
                    'placeholder' => 'Informe o preço do produto'
                ),
            )
        );
        $this->add(
            array(
                'name' => 'especificacao',
                'type' => 'textarea',
                'options' => array(
                    'label' => 'Descrição do produto*:'
                ),
                'attributes' => array(
                    'placeholder' => 'Informe a descrição do produto'
                ),
            )
        );
        $this->add(
            array(
                'name' => 'lucro',
                'type' => 'text',
                'options' => array(
                    'label' => 'Margem de lucro do produto*:'
                ),
                'attributes' => array(
                    'placeholder' => 'Informe a margem de lucro'
                ),
            )
        );
        $this->add(
            array(
                'name' => 'foto',
                'type' => 'file',
                'options' => array(
                    'label' => 'Foto do produto*:',
                ),
            )
        );
        $this->add(array(
           'name' => 'categoria',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
               'label' => 'Categoria do produto*:',
               'object_manager' => $em,
               'target_class' => '\Admin\Entity\Categoria',
               'property' => 'nome',
               'empty_option' => 'SELECIONE UMA CATEGORIA',
               'label_generator' => function($target){
                   return $target->nome;
               }
           ),
       ));

       $this->add(
           array(
               'type' => 'submit',
               'name' => 'send',
               'attributes' => array(
                   'value' => 'Salvar',
                   'class' => 'btn btn-primary'
               )
           )
       );
    }

    public function getFileInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();
        $fileInput = new InputFilter\FileInput('foto');
        $fileInput->setRequired(true);
        $fileInput->getValidatorChain()
            ->attachByName('filesize',      array('max' => 204800))
            ->attachByName('filemimetype',  array('mimeType' => 'image/png, image/jpeg, image/jpg'))
            ->attachByName('fileimagesize', array('maxWidth' => 1000, 'maxHeight' => 1000));
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => getcwd().'/public/img/fotos_produtos/foto.jpg',
                'randomize' => true,
            )
        );

        return $fileInput;
    }
}
