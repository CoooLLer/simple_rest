<?php


namespace App\Repository;


use App\Core\Interfaces\DatabaseInterface;
use App\Model\Tariff;
use App\Service\ModelService;

class TariffRepository
{
    private $tableName = 'tarifs';
    private $database = null;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function getTariffById(int $id): ?Tariff
    {
        $tariffData = $this->database->selectQuery('SELECT * FROM ' . $this->tableName . ' WHERE ID = :id', ['id' => $id]);
        if (count($tariffData) === 0) {
            return null;
        }

        /** @var Tariff $tariff */
        $tariff = ModelService::fillModel(new Tariff(), $tariffData[0]);

        return $tariff;
    }

    /**
     * @param int $tarifGroupId
     * @return Tariff[]|null
     */
    public function getTariffsByGroupId(int $tarifGroupId): array
    {
        $tarifsData = $this->database->selectQuery('SELECT * FROM ' . $this->tableName . ' WHERE tarif_group_id = :tarif_group_id', ['tarif_group_id' => $tarifGroupId]);
        if (count($tarifsData) === 0) {
            return null;
        }

        /** @var Tariff[] $tarifs */
        $tarifs = [];
        foreach ($tarifsData as $tarifData) {
            $tarifs[] = ModelService::fillModel(new Tariff(), $tarifData);
        }

        return $tarifs;
    }
}