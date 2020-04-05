<?php


namespace App\Repository;


use App\Core\Interfaces\DatabaseInterface;
use App\Model\Service;
use App\Model\Tariff;
use App\Service\ModelService;

class ServiceRepository
{
    private $tableName = 'services';
    private $database = null;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @param int $id
     * @return Service|null
     */
    public function getServiceById(int $id): ?Service
    {
        $serviceData = $this->database->selectQuery('SELECT * FROM ' . $this->tableName . ' WHERE ID = :id', ['id' => $id]);
        if (count($serviceData) === 0) {
            return null;
        }

        /** @var Service $service */
        $service = ModelService::fillModel(new Service(), $serviceData[0]);

        return $service;
    }

    /**
     * @param int $serviceId
     * @param Tariff $tarif
     * @return bool
     */
    public function setTariff(int $serviceId, Tariff $tarif): bool
    {
        $query = 'UPDATE ' . $this->tableName . ' SET tarif_id = :tarif_id, payday = :payday WHERE ID = :id';
        if ($this->database->updateQuery($query, ['tarif_id' => $tarif->getId(), 'payday' => $tarif->getPayDay()->format('Y-m-d H:i:s'), 'id' => $serviceId])) {
            return true;
        }

        return false;
    }
}