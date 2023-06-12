<?php
namespace data\Operatori;

use data\models\OperatoreDataModel;
use data\RepositoryManager;

class OperatoreService
{
    public static function createOperatore(OperatoreDataModel $model): Operatore
    {
        $operatore = new Operatore();
        $operatore->nome = $model->nome;
        $operatore->cognome = $model->cognome;
        $operatore->username = $model->username;
        $operatore->mansione = $model->mansione;
        $operatore->stato = $model->stato;

        $repoManager = new RepositoryManager();
        $repoManager->getRepOperatori()->save($operatore);
        $repoManager->flushData();

        return $operatore;
    }

    public static function updateOperatore(OperatoreDataModel $model): Operatore
    {
        $repOperatori = (new RepositoryManager())->getRepOperatori();

        $operatore = $repOperatori->findById($model->id);
        if (!isset($operatore))
            throw new \Exception("OPERATOR_NOT_FOUND");

        $operatore->nome = $model->nome;
        $operatore->cognome = $model->cognome;
        $operatore->mansione = $model->mansione;
        $operatore->stato = $model->stato;

        $repOperatori->save($operatore);
        $repOperatori->getRepoManager()->flushData();

        return $operatore;
    }

    public static function deleteOperatore(string $id)
    {
        $repOperatori = (new RepositoryManager())->getRepOperatori();
        $repOperatori->deleteById($id);
    }

    public static function findAll(): array
    {
        return (new RepositoryManager())->getRepOperatori()->findAll();
    }

    public static function findById(string $id): object
    {
        return (new RepositoryManager())->getRepOperatori()->findById($id);
    }

}

// questa classe non conosce la struttura dati della tabella, ecc ma sa che esiste un database (fa da interfaccia ai dati)
//e si occupa di fare delle elaborazioni esi ricollega al repositoryManagaer