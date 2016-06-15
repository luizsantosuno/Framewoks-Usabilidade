<?php

namespace Admin\Entity;

use Core\Test\ModelTestCase;
use Admin\Entity\Produto;
use \Admin\Provider\Add;


require_once __DIR__ . '/../Provider/Add.php';

/**
* @group Ola
* @author Harold C. S. Becker
*/
class ProdutoTest extends ModelTestCase
{
    use Add;

    /**
    *
    * @return Zend\InputFilter\InputFiter
    */
    public function testGetInputFilter()
    {
        $produto = new Produto();
        $filtro = $produto->getInputFilter();
        $this->assertInstanceOf("Zend\InputFilter\InputFilter", $filtro);

        return $filtro;
    }

    /**
    *
    * @depends testGetInputFilter
    * @param Zend\InputFilter\InputFilter
    */
    public function testInputFilterValid($filtro)
    {
        $this->assertEquals(7, count($filtro));
        $this->assertTrue($filtro->has('id'));
        $this->assertTrue($filtro->has('nome'));
        $this->assertTrue($filtro->has('preco'));
        $this->assertTrue($filtro->has('especificacao'));
        $this->assertTrue($filtro->has('lucro'));
        $this->assertTrue($filtro->has('foto'));
        $this->assertTrue($filtro->has('categoria'));
    }

    /**
    * Teste de Inserção válida no banco
    *
    */
    public function testInsert()
    {
        $produto = $this->addProduto();
        $this->assertEquals(1, $produto->getId());
        $this->assertEquals('DELL INSPIRION', $produto->getNome());
        $this->assertEquals(3898.00, $produto->getPreco());
        $this->assertEquals('ESPECIFICAÇÃO PRODUTO', $produto->getEspecificacao());
        $this->assertEquals(70.5, $produto->getLucro());
        $this->assertEquals('/home/Desktop/imagem.png', $produto->getFoto());
        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $produto->getCategoria());
    }

    /**
    * Teste de atualização válido no banco de dados
    *
    */
    public function testUpdate()
    {
        $produto = $this->addProduto();
        $produto->setNome('Acer');
        $produto->setPreco(3000.00);
        $produto->setEspecificacao('Produto acer');
        $produto->setLucro(10);
        $produto->setFoto('/home/Desktop/acer.jpg');
    }

    /**
    * Teste de remoção válida no banco de dados
    *
    */
    public function testDelete()
    {
        $produto = $this->addProduto();
        $query = $this->getEntityManager()->createQuery("select p from Admin\Entity\Produto p");
        $result = $query->getResult();
        $this->assertEquals(1, count($result));
        $this->getEntityManager()->remove($produto);
        $this->getEntityManager()->flush();
        $query = $this->getEntityManager()->createQuery("select p from Admin\Entity\Produto p");
        $result = $query->getResut();
        $this->assertEquals(0, cout($result));
    }

    /**
    * Teste uma inserção inválida no banco de dados
    *
    * @expectedException Core\Model\EntityException
    */
    public function testInvalidInsert()
    {
        $produto = new Produto();
        $produto->setNome(null);
        $this->getEntityManager()->persist($produto);
        $this->getEntityManager()->flush();
    }

}
