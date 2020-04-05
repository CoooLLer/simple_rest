<?php


namespace App\Repository;


use App\Core\Interfaces\DatabaseInterface;
use App\Model\Tarif;
use App\Service\ModelService;

class TarifRepository
{
    private $tableName = 'tarifs';
    private $database = null;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    public function getTarifById(int $id): ?Tarif
    {
        $tarifData = $this->database->query('SELECT * FROM ' . $this->tableName . ' WHERE id = :id', ['id' => $id]);
        if (count($tarifData) === 0) {
            return null;
        }

        /** @var Tarif $tarif */
        $tarif = ModelService::fillModel(new Tarif(), $tarifData[0]);

        return $tarif;
    }

    /**
     * @param int $tarifGroupId
     * @return Tarif[]|null
     */
    public function getTarifsByGroupId(int $tarifGroupId): array
    {
        $tarifsData = $this->database->query('SELECT * FROM ' . $this->tableName . ' WHERE tarif_group_id = :tarif_group_id', ['tarif_group_id' => $tarifGroupId]);
        if (count($tarifsData) === 0) {
            return null;
        }

        /** @var Tarif[] $tarifs */
        $tarifs = [];
        foreach ($tarifsData as $tarifData) {
            $tarifs[] = ModelService::fillModel(new Tarif(), $tarifData);
        }

        return $tarifs;
    }
}