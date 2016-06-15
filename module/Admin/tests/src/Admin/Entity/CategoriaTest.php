<?php

namespace Admin\Entity;

use Core\Test\ModelTestCase;
use \Admin\Entity\Categoria;
use \Admin\Provider\Add;

require_once __DIR__ . '/../Provider/Add.php';

/**
* @group Model
* @author Harold C. S. Becker
*/
class CategoriaTest extends ModelTestCase
{
    use Add;

    /**
    *
    * @return \Zend\InputFilter\InputFilter
    */
    public function testGetInputFilter()
    {
        $categoria = new Categoria();
        $filtro = $categoria->getInputFilter();
        $this->assertInstanceOf("Zend\InputFilter\InputFilter", $filtro);

        return $filtro;
    }

    /**
    * @depends testGetInputFilter
    * @param Zend\InputFilter\InputFilter $filtro
    */
    public function testInputFilterValid($filtro)
    {
        $this->assertEquals(2, count($filtro));
        $this->assertTrue($filtro->has('id'));
        $this->assertTrue($filtro->has('nome'));
        $this->assertTrue($filtro->has('produtos'))
    }

    /**
    * Teste de Inserção válida no banco
    *
    */
    public function testInsert()
    {
        $categoria = $this->addCategoria();
        $this->assertEquals(1, $categoria->getId());
        $this->assertEquals("NOOTBOOK", $categoria->getNome());
        $this->assertInstanceOf("Doctrine\Common\Collections\ArrayCollection", $categoria->getProdutos());
    }

    /**
    * Teste de atualização válido no banco de dados
    *
    */
    public function testUpdate()
    {
        $categoria = $this->addCategoria();
        $categoria->setNome("Computador");
        $this->getEntityManager()->persist($categoria);
        $this->getEntityManager()->flush();
        $this->assertEquals("COMPUTADOR", $categoria->getNome());
    }

    /**
    * Teste de remoção válida no banco de dados
    *
    */
    public function testDelete()
    {
        $categoria = $this->addCategoria();
        $query = $this->getEntityManager()->createQuery("select c from Admin\Entity\Categoria c");
        $result = $query->getResult();
        $this->assertEquals(1, count($result));
        $this->getEntityManager()->remove($categoria);
        $this->getEntityManager()->flush();
        $query = $this->getEntityManager()->createQuery("select c from Admin\Entity\Categoria c");
        $result = $query->getResult();
        $this->assertEquals(0, count($result));
    }

    /**
    * Teste uma inserção inválida no banco de dados
    *
    * @expectedException Core\Model\EntityException
    */
    public function testInvalidInsert()
    {
        $categoria = new Categoria();
        $categoria->setNome(null);
        $this->getEntityManager()->persist($categoria);
        $this->getEntityManager()->flush();
    }

}
