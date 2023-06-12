<?php
namespace data\Users;

use data\models\UserLoginModel;
use data\RepositoryManager;

class UserService
{
    public static function createUser(UserLoginModel $model): User
    {
        $user = new User();
        $user->username = $model->username;
        $user->password = $model->password;


        $repoManager = new RepositoryManager();
        $repoManager->getRepUser()->save($user);

        return $user;
    }

    public static function findAll(): array
    {
        return (new RepositoryManager())->getRepUser()->findAll();
    }
}