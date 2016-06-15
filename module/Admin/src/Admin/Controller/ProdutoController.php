<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\ProdutoForm;
use Admin\Validator\ProdutoValidator;

class ProdutoController extends AbstractActionController
{
    public function indexAction()
    {
        $produtos = $this->getServiceLocator()->get('ProdutoService')
            ->fetchAll();
        // foreach ($produtos as $produto) {
        //     var_dump($produtos[0]->categorias);
        // }
        // exit;
        return new ViewModel(array(
            'produtos' => $produtos,
        ));
    }

    public function createAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $produtoForm = new ProdutoForm($entityManager);
        $request = $this->getRequest();

        if($request->isPost()){
            $validator = new ProdutoValidator();
            $validator->add($produtoForm->getFileInputFilter());
            $produtoForm->setInputFilter($validator);
            $values = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $produtoForm->setData($values);

            if($produtoForm->isValid()){
                $values = $produtoForm->getData();
                $this->getServiceLocator()->get('ProdutoService')
                    ->salvarProduto($values);

                return $this->redirect()->toUrl('/admin/produto/index');
            }
        }

        return new ViewModel(array(
            'form' => $produtoForm,
        ));
    }

    public function updateAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $produtoForm = new ProdutoForm($entityManager);
        $request = $this->getRequest();
        $id = (int)$this->params()->fromRoute('id', 0);

        if($request->isPost()){
            $produtoForm->setInputFilter(new ProdutoValidator());
            $values = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $produtoForm->setData($values);

            if($produtoForm->isValid()){
                $values = $produtoForm->getData();
                $this->getServiceLocator()->get('ProdutoService')
                    ->editarProduto($id, $values);

                return $this->redirect()->toUrl('/admin/produto/index');
            }
        }
        $produto = $this->getServiceLocator()->get('ProdutoService')
            ->fetch($id);
        $produtoForm->bind($produto);

        return new ViewModel(array(
            'form' => $produtoForm,
        ));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if($id > 0){
            try{
                $this->getServiceLocator()->get('ProdutoService')
                    ->removerProduto($id);
            }catch(\Exception $e){
                var_dump($e);exit;
            }finally{
                return $this->redirect()->toUrl('/admin/produto/index');
            }
        }
    }

}
