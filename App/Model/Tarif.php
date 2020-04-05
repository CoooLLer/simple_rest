<?php

namespace App\Model;

use App\Core\Interfaces\ModelInterface;

class Tarif implements ModelInterface
{
    private string $id;

    private string $title;

    private float $price;

    private string $link;

    private int $speed;

    private int $payPeriod;

    private int $tarifGroupId;

    private $dataMapping = [
        'ID' => [
            'propertyName' => 'id',
            'type' => 'int'
        ],
        'title' => [
            'propertyName' => 'title',
            'type' => 'string'
        ],
        'price' => [
            'propertyName' => 'price',
            'type' => 'float'
        ],
        'link' => [
            'propertyName' => 'link',
            'type' => 'string'
        ],
        'speed' => [
            'propertyName' => 'speed',
            'type' => 'int'
        ],
        'pay_period' => [
            'propertyName' => 'payPeriod',
            'type' => 'int'
        ],
        'tarif_group_id' => [
            'propertyName' => 'tarifGroupId',
            'type' => 'int'
        ],
    ];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Tarif
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Tarif
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Tarif
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return Tarif
     */
    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return Tarif
     */
    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return int
     */
    public function getPayPeriod(): int
    {
        return $this->payPeriod;
    }

    /**
     * @param int $payPeriod
     * @return Tarif
     */
    public function setPayPeriod(int $payPeriod): self
    {
        $this->payPeriod = $payPeriod;
        return $this;
    }

    /**
     * @return int
     */
    public function getTarifGroupId(): int
    {
        return $this->tarifGroupId;
    }

    /**
     * @param int $tarifGroupId
     * @return Tarif
     */
    public function setTarifGroupId(int $tarifGroupId): self
    {
        $this->tarifGroupId = $tarifGroupId;
        return $this;
    }

    public function getDataMapping()
    {
        return $this->dataMapping;
    }

}