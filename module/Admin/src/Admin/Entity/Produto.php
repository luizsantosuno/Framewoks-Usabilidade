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
* @ORM\Table(name="produto")
*/
class Produto extends Entity
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
    * @ORM\Column(type="float")
    *
    * @var float $preco
    */
    protected $preco;

    /**
    * @ORM\Column(type="string")
    *
    * @var string $especificacao
    */
    protected $especificacao;

    /**
    * @ORM\Column(type="float")
    *
    * @var float $lucro
    */
    protected $lucro;

    /**
    * @ORM\Column(type="string")
    *
    * @var string $foto
    */
    protected $foto;

    /**
    * @ORM\ManyToMany(targetEntity="Admin\Entity\Categoria")
    *   * @ORM\JoinTable(name = "categoria_produto",
    *       joinColumns = {@ORM\JoinColumn(name = "id_produto", referencedColumnName = "id")},
    *       inverseJoinColumns = {@ORM\JoinColumn(name = "id_categoria", referencedColumnName = "id")}
    *   )
    *
    * @var ArrayCollection $categorias
    */
    protected $categorias;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
