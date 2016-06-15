<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\ServicoForm;
use Admin\Validator\ServicoValidator;

class ServicoController extends AbstractActionController
{
    public function indexAction()
    {
        $servicos = $this->getServiceLocator()->get('ServicoService')
            ->fetchAll();

        return new ViewModel(array(
            'servicos' => $servicos,
        ));
    }

    public function createAction()
    {
        $servicoForm = new ServicoForm();
        $request = $this->getRequest();

        if($request->isPost()){
            $servicoForm->setInputFilter(new ServicoValidator());
            $values = $request->getPost();
            $servicoForm->setData($values);

            if($servicoForm->isValid()){
                $values = $servicoForm->getData();
                $this->getServiceLocator()->get('ServicoService')
                    ->salvarServico($values);

                return $this->redirect()->toUrl('/admin/servico/index');
            }
        }

        return new ViewModel(array(
            'form' => $servicoForm,
        ));
    }

    public function updateAction()
    {
        $servicoForm = new ServicoForm();
        $request = $this->getRequest();
        $id = (int)$this->params()->fromRoute('id', 0);

        if($request->isPost()){
            $servicoForm->setInputFilter(new ServicoValidator());
            $values = $request->getPost();
            $servicoForm->setData($values);

            if($servicoForm->isValid()){
                $values = $servicoForm->getData();
                $this->getServiceLocator()->get('ServicoService')
                    ->editarServico($id, $values);

                return $this->redirect()->toUrl('/admin/servico/index');
            }
        }
        $servico = $this->getServiceLocator()->get('ServicoService')
            ->fetch($id);
        $servicoForm->bind($servico);

        return new ViewModel(array(
            'form' => $servicoForm,
        ));
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);

        if($id > 0){
            try{
                $this->getServiceLocator()->get('ServicoService')
                    ->removerServico($id);
            }catch(\Exception $e){
                var_dump($e);exit;
            }finally{
                return $this->redirect()->toUrl('/admin/servico/index');
            }
        }
    }

}
