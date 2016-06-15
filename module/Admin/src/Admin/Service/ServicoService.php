<?php
namespace Admin\Service;

use Admin\Entity\Servico;
use Doctrine\ORM\EntityManager;

class ServicoService
{
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function fetch($id)
    {
        return $this->entityManager->find('\Admin\Entity\Servico', $id);
    }

    public function fetchAll()
    {
        $servicos = $this->entityManager
            ->getRepository('\Admin\Entity\Servico')
            ->findAll();

        return $servicos;
    }

    public function salvarServico($values)
    {
        $servico = new Servico();
        $servico->setHora($values['hora']);
        $servico->setTaxa($values['taxa']);
        $servico->setEspecificacao($values['especificacao']);
        $this->entityManager->persist($servico);
        $this->entityManager->flush();
    }

    public function editarServico($id, $values)
    {
        $servico = $this->fetch($id);
        $servico->setHora($values['hora']);
        $servico->setTaxa($values['taxa']);
        $servico->setEspecificacao($values['especificacao']);
        $this->entityManager->persist($servico);
        $this->entityManager->flush();
    }

    public function removerServico($id)
    {
        $servico = $this->fetch($id);
        $this->entityManager->remove($servico);
        $this->entityManager->flush();
    }
}
