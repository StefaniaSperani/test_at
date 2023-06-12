<?php
namespace data\Users;

use data\RepositoryManager;

class UserRepository
{
    private $class;
    private $owner;

    function __construct(RepositoryManager $owner)
    {
        $this->class = User::class;
        $this->owner = $owner;
    }

    protected function getEntityManager()
    {
        return $this->owner->getEntityManager();
    }

    public function findAll()
    {
        $rep = $this->getEntityManager()->getRepository($this->class);
        return $rep->findAll();
    }
    public function findById(string $id): object
    {
        return $this->getEntityManager()->find($this->class, $id);
    }

}