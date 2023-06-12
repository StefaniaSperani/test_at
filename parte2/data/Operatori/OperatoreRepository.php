<?php
namespace data\Operatori;

use data\RepositoryManager;

class OperatoreRepository
{
    private $class;
    private $owner;

    function __construct(RepositoryManager $owner)
    {
        $this->class = Operatore::class;
        $this->owner = $owner;
    }

    protected function getEntityManager()
    {
        return $this->owner->getEntityManager();
    }

    public function getRepoManager(): RepositoryManager
    {
        return $this->owner;
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

    public function findBy(array $params, array $sort = null): array
    {
        return $this->getEntityManager()->getRepository($this->class)->findBy($params, $sort);
    }

    public function deleteById(string $id)
    {
        $commandText = "DELETE {$this->class} e WHERE e.id = :id";
        $command = $this->getEntityManager()->createQuery($commandText);
        $command->setParameter("id", $id);
        return $command->getResult();
    }

    public function delete(object $entry)
    {
        $this->getEntityManager()->remove($entry);
    }

    public function save(object $entity)
    {
        $this->getEntityManager()->persist($entity);
    }

}


//insieme alla classe DTO si occupa di fare le operazioni sulla tabella(gestisce la comunciazione con il database)