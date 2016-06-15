<?php

namespace Admin\Provider;

use \Admin\Entity\Categoria;
use \Admin\Entity\Produto;
use \Admin\Entity\Servico;

/**
*
* @author Harold C. S. Becker
*/
trait Add
{
    /**
    * Instanciação e inserção na Classe Categoria
    *
    * @return \Admin\Entity\Categoria
    */
    public function addCategoria()
    {
        $categoria = new Categoria();
        $categoria->setNome("Nootbook");
        $categoria->setProdutos(null);
        $this->getEntityManager()->persist($categoria);
        $this->getEntityManager()->flush();

        return $categoria;
    }

    /**
    * Instanciação e inserção na Classe Produto
    *
    * @return \Admin\Entity\Produto
    */
    public function addProduto()
    {
        $produto = new Produto();
        $produto->setCategoria($this->addCategoria());
        $produto->setEspecificacao("Especifição Produto");
        $produto->setFotos("/home/Desktop/imagem.png");
        $produto->setLucro(70.5);
        $produto->setNome("Dell Inspiron");
        $produto->setPreco(3898.00);
        $this->getEntityManager()->persist($produto);
        $this->getEntityManager()->flush();

        return $produto;
    }

    /**
    * Instanciação e inserção na Classe Servico
    *
    * @return \Admin\Entity\Servico
    */
    public function addServico()
    {
        $servico = new Servico();
        $servico->setHora(10);
        $servico->setTaxa(10.0);
        $servico->setEspecificacao("Especificação");
        $this->getEntityManager()->persist($servico);
		$this->getEntityManager()->flush();

        return $servico;
    }

}
