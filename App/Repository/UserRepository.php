<?php


namespace App\Repository;


use App\Core\Interfaces\DatabaseInterface;
use App\Model\User;
use App\Service\ModelService;

class UserRepository
{
    private $tableName = 'users';
    private $database = null;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function getUserById(int $id): ?User
    {
        $userData = $this->database->query('SELECT * FROM ' . $this->tableName . ' WHERE id = :id', ['id' => $id]);
        if (count($userData) === 0) {
            return null;
        }

        /** @var User $user */
        $user = ModelService::fillModel(new User(), $userData[0]);

        return $user;
    }

}