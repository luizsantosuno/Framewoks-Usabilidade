<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Core\Model\Entity as Entity;

/**
* @category Admin
* @package Entity
* @author Harold C. S. Becker <hcsb@unochapeco.edu.br>
* @ORM\Entity
* @ORM\Table(name="servico")
*/
class Servico extends Entity
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    *
    * @var integer $id
    */
    protected $id;

    /**
    * @ORM\Column(type="integer")
    *
    * @var integer $hora
    */
    protected $hora;

    /**
    * @ORM\Column(type="float")
    *
    * @var float $taxa
    */
    protected $taxa;

    /**
    * @ORM\Column(type="string")
    *
    * @var string $especificacao
    */
    protected $especificacao;

    /**
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    *
    * @param string $hora
    */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
    *
    * @return string
    */
    public function getHora()
    {
        return $this->hora;
    }

    /**
    *
    * @param float $taxa
    */
    public function setTaxa($taxa)
    {
        $this->taxa = $taxa;
    }

    /**
    *
    * @return float
    */
    public function getTaxa()
    {
        return $this->taxa;
    }

    /**
    *
    * @param string $especificacao
    */
    public function setEspecificacao($especificacao)
    {
        $this->especificacao = $especificacao;
    }

    /**
    *
    * @return string
    */
    public function getespecificacao()
    {
        return $this->especificacao;
    }
}
