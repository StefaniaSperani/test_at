<?php
namespace data\Operatori;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
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
     * @GeneratedValue
     * @Column(type="integer", name="id")
     */
    public $id;

    /**
     * @Column(type="string", name="nome")
     */
    public $nome;

    /**
     * @Column(type="string", name="cognome")
     */
    public $cognome;

    /**
     * @Column(type="string", name="username")
     */
    public $username;

    /**
     * @Column(type="string", name="mansione")
     */
    public $mansione;

    /**
     * @Column(type="string", name="stato")
     */
    public $stato;
}


//classe DTO conosce la struttura della tabella