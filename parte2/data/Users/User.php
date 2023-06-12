<?php
namespace data\Users;

use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;

/**
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * @Id
     * @Column(name="id", type="integer")
     */
    public $id;

    /**
     * @Column(type="string", name="username")
     */
    public $username;

    /**
     * @Column(type="string", name="password")
     */
    public $password;
}