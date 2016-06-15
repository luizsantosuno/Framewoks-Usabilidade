<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Core\Model\Entity as Entity;

/**
* @category Admin
* @package Entity
* @author Harold C. S. Becker <hcsb@unochapeco.edu.br>
* @ORM\Entity
* @ORM\Table(name="categoria")
*/
class Categoria extends Entity
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
    * @ORM\Column(type="string")
    *
    * @var string $nome
    */
    protected $nome;

    /**
    * @ORM\ManyToMany(targetEntity="Produto", mappedBy="categorias")
    *
    * @var ArrayCollection $produtos
    */
    protected $produtos;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
    }

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
    * @param string $nome
    */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
    *
    * @return string
    */
    public function getNome()
    {
        return $this->nome;
    }

    /**
    *
    * @param Doctrine\Common\Collections\ArrayCollection $produtos
    */
    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;
    }

    /**
    *
    * @return Doctrine\Common\Collections\ArrayCollection
    */
    public function getProdutos()
    {
        return $this->produtos;
    }
}
