<?php


namespace App\Repository;


use App\Core\Interfaces\DatabaseInterface;
use App\Model\Service;
use App\Service\ModelService;

class ServiceRepository
{
    private $tableName = 'services';
    private $database = null;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function getServiceById(int $id): ?Service
    {
        $serviceData = $this->database->query('SELECT * FROM ' . $this->tableName . ' WHERE id = :id', ['id' => $id]);
        if (count($serviceData) === 0) {
            return null;
        }

        /** @var Service $service */
        $service = ModelService::fillModel(new Service(), $serviceData[0]);

        return $service;
    }
}