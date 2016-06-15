<?php
namespace Admin\Service;

use Admin\Entity\Produto;
use Doctrine\ORM\EntityManager;

class ProdutoService
{
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function fetch($id)
    {
        return $this->entityManager->find('\Admin\Entity\Produto', $id);
    }

    public function fetchAll()
    {
        $produtos = $this->entityManager
            ->getRepository('\Admin\Entity\Produto')
            ->findAll();

        return $produtos;
    }

    public function salvarProduto($values)
    {
        $produto = new Produto();
        $categoria = $this->entityManager->getRepository('\Admin\Entity\Categoria')
            ->findOneBy(array('id' => (int)$values['categoria']));
        $produto->nome = $values['nome'];
        $produto->preco = (int)$values['preco'];
        $produto->especificacao = $values['especificacao'];
        $produto->lucro = (int)$values['lucro'];
        $file = str_replace(getcwd().'/public/img/fotos_produtos/', '', $values['foto']['tmp_name']);
        $produto->foto = $file;
        $produto->categorias = $categoria;

        $this->entityManager->persist($produto);
        $this->entityManager->flush();
    }

    public function editarProduto($id, $values)
    {
        $produto = $this->fetch($id);
        $categoria = $this->entityManager->getRepository('\Admin\Entity\Categoria')
            ->findOneBy(array('id' =>  $values['categoria']));
        $produto->nome = $values['nome'];
        $produto->preco = (int)$values['preco'];
        $produto->especificacao = $values['especificacao'];
        $produto->lucro = (int)$values['lucro'];
        $file = str_replace(getcwd().'/public/img/fotos_produtos/', '', $values['foto']['tmp_name']);
        $produto->foto = $file;
        $produto->scategorias = $categoria;
        $this->entityManager->persist($produto);
        $this->entityManager->flush();
    }

    public function removerProduto($id)
    {
        $produto = $this->fetch($id);
        $this->entityManager->remove($produto);
        $this->entityManager->flush();
    }
}
