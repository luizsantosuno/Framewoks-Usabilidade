<?php

namespace Admin\Service;

use Admin\Entity\Categoria;
use Doctrine\ORM\EntityManager;

class CategoriaService
{
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function fetch($id)
    {
        return $this->entityManager->find('\Admin\Entity\Categoria', $id);
    }

    public function fetchAll()
    {
        $categorias = $this->entityManager
            ->getRepository('\Admin\Entity\Categoria')
            ->findAll();

        return $categorias;
    }

    public function salvarCategoria($values)
    {
        $categoria = new Categoria();
        $categoria->setNome($values['nome']);
        $this->entityManager->persist($categoria);
        $this->entityManager->flush();
    }

    public function editarCategoria($id, $values)
    {
        $categoria = $this->fetch($id);
        $categoria->setNome($values['nome']);
        $this->entityManager->persist($categoria);
        $this->entityManager->flush();
    }

    public function removerCategoria($id)
    {
        $categoria = $this->fetch($id);
        $this->entityManager->remove($categoria);
        $this->entityManager->flush();
    }
}
