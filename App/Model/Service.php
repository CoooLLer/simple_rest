<?php

namespace App\Model;

use App\Core\Interfaces\ModelInterface;
use DateTime;

class Service implements ModelInterface
{
    private int $id;

    private int $userId;

    private int $tarifId;

    private DateTime $payday;

    private $dataMapping = [
        'ID' => [
            'propertyName' => 'id',
            'type' => 'int'
        ],
        'user_id' => [
            'propertyName' => 'userId',
            'type' => 'int'
        ],
        'tarif_id' => [
            'propertyName' => 'tarifId',
            'type' => 'int'
        ],
        'payday' => [
            'propertyName' => 'payday',
            'type' => 'datetime'
        ],
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Service
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Service
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getTarifId(): int
    {
        return $this->tarifId;
    }

    /**
     * @param int $tarifId
     * @return Service
     */
    public function setTarifId(int $tarifId): self
    {
        $this->tarifId = $tarifId;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPayday(): DateTime
    {
        return $this->payday;
    }

    /**
     * @param DateTime $payday
     * @return Service
     */
    public function setPayday(DateTime $payday): self
    {
        $this->payday = $payday;
        return $this;
    }

    public function getDataMapping()
    {
        return $this->dataMapping;
    }
}