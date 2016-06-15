<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\CategoriaForm;
use Admin\Validator\CategoriaValidator;

class CategoriaController extends AbstractActionController
{
    public function indexAction()
    {
        $categorias = $this->getServiceLocator()->get('CategoriaService')
            ->fetchAll();

        return new ViewModel(array(
            'categorias' => $categorias,
        ));
    }

    public function createAction()
    {
        $categoriaForm = new CategoriaForm();
        $request = $this->getRequest();

        if($request->isPost()){
            $categoriaForm->setInputFilter(new CategoriaValidator());
            $values = $request->getPost();
            $categoriaForm->setData($values);

            if($categoriaForm->isValid()){
                $values = $categoriaForm->getData();
                $this->getServiceLocator()->get('CategoriaService')
                    ->salvarCategoria($values);

                return $this->redirect()->toUrl('/admin/categoria/index');
            }
        }

        return new ViewModel(array(
            'form' => $categoriaForm,
        ));
    }

    public function updateAction()
    {
        $categoriaForm = new CategoriaForm();
        $request = $this->getRequest();
        $id = (int)$this->params()->fromRoute('id', 0);

        if($request->isPost()){
            $categoriaForm->setInputFilter(new CategoriaValidator());
            $values = $request->getPost();
            $categoriaForm->setData($values);

            if($categoriaForm->isValid()){
                $values = $categoriaForm->getData();
                $this->getServiceLocator()->get('CategoriaService')
                    ->editarCategoria($id, $values);

                return $this->redirect()->toUrl('/admin/categoria/index');
            }
        }
        $categoria = $this->getServiceLocator()->get('CategoriaService')
            ->fetch($id);
        $categoriaForm->bind($categoria);

        return new ViewModel(array(
            'form' => $categoriaForm,
        ));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if($id > 0){
            try{
                $this->getServiceLocator()->get('CategoriaService')
                    ->removerCategoria($id);
            }catch(\Exception $e){
                var_dump($e);exit;
            }finally{
                return $this->redirect()->toUrl('/admin/categoria/index');
            }
        }
    }
}
