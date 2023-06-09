<?php
namespace data\Operatori;

use data\models\OperatoreCreationModel;
use data\RepositoryManager;

class OperatoreService
{
    public static function createOperatore(OperatoreCreationModel $model): Operatore
    {
        $operatore = new Operatore();
        $operatore->nome = $model->nome;

        $repoManager = new RepositoryManager();
        $repoManager->getRepOperatori()->save($operatore);
        $repoManager->flushData();

        return $operatore;
    }

    public static function findAll(): array
    {
        return (new RepositoryManager())->getRepOperatori()->findAll();
    }
}