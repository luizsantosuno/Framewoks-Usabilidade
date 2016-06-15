<?php

namespace Admin\Entity;

use Core\Test\ModelTestCase;
use \Admin\Entity\Servico;
use \Admin\Provider\Add;

require_once __DIR__ . '/../Provider/Add.php';

/**
* @group Model
* @author Harold C. S. Becker
*/
class ServicoTest extends ModelTestCase
{
    use Add;

    /**
    *
    * @return \Zend\InputFilter\InputFilter
    */
    public function testGetInputFilter()
    {
        $servico = new Servico();
        $filtro = $servico->getInputFilter();
        $this->assertInstanceOf("Zend\InputFilter\InputFilter", $filtro);

        return $filtro;
    }

    /**
    * @depends testGetInputFilter
    * @param Zend\InputFilter\InputFilter $filtro
    */
    public function testInputFilterValid($filtro)
    {
        $this->assertEquals(4, $filtro->count());
        $this->assertTrue($filtro->has('id'));
        $this->assertTrue($filtro->has('hora'));
        $this->assertTrue($filtro->has('taxa'));
        $this->assertTrue($filtro->has('especificacao'));
    }

    /**
    * Teste de Inserção válida no banco
    *
    */
    public function testInsert()
    {
        $servico = $this->addServico();
        $this->assertEquals(1, $servico->getId());
        $this->assertEquals(10, $servico->getHora());
        $this->assertEquals(10.0, $servico->getTaxa());
        $this->assertEquals("ESPECIFICAÇÃO", $servico->getEspecificacao());
    }

    /**
    * Teste de atualização válido no banco de dados
    *
    */
    public function testUpdate()
    {
        $servico = $this->addServico();
        $servico->setHora(9);
        $servico->setTaxa(15.90);
        $servico->setEspecificacao("update data");
        $this->getEntityManager()->persist($servico);
        $this->getEntityManager()->flush();
        $this->assertEquals(9, $servico->getHora());
        $this->assertEquals(15.90, $servico->getTaxa());
        $this->assertEquals("UPDATE DATA", $servico->getEspecificacao());
    }

    /**
    * Teste de remoção válida no banco de dados
    *
    */
    public function testDelete()
    {
        $servico = $this->addServico();
        $query = $this->getEntityManager()
                ->createQuery("select s from Admin\Entity\Servico s");
        $result = $query->getResult();
        $this->assertEquals(1, count($result));
        $this->getEntityManager()->remove($servico);
        $this->getEntityManager()->flush();
        $query = $this->getEntityManager()
                ->createQuery("select s from Admin\Entity\Servico s");
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
        $servico = new Servico();
        $servico->setTaxa(null);
        $this->getEntityManager()->persist($servico);
        $this->getEntityManager()->flush();
    }

}
