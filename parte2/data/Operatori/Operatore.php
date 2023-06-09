<?php
namespace data\Operatori;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;

/**
 * @Entity
 * @Table(name="operators")
 */
class Operatore
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     */
    public $id;

    /**
     * @Column(type="string", name="nome")
     */
    public $nome;
}