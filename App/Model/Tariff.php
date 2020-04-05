<?php

namespace App\Model;

use App\Core\Interfaces\ModelInterface;
use DateTime;
use DateTimeZone;

class Tariff implements ModelInterface
{
    private string $id;

    private string $title;

    private float $price;

    private string $link;

    private int $speed;

    private int $payPeriod;

    private int $tariffGroupId;

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
            'propertyName' => 'tariffGroupId',
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
     * @return Tariff
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
     * @return Tariff
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
     * @return Tariff
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
     * @return Tariff
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
     * @return Tariff
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
     * @return Tariff
     */
    public function setPayPeriod(int $payPeriod): self
    {
        $this->payPeriod = $payPeriod;
        return $this;
    }

    /**
     * @return int
     */
    public function getTariffGroupId(): int
    {
        return $this->tariffGroupId;
    }

    /**
     * @param int $tariffGroupId
     * @return Tariff
     */
    public function setTariffGroupId(int $tariffGroupId): self
    {
        $this->tariffGroupId = $tariffGroupId;
        return $this;
    }

    public function getDataMapping()
    {
        return $this->dataMapping;
    }

    public function getPayDay(): DateTime
    {
        return (new DateTime('today midnight', new DateTimeZone('Europe/Moscow')))->modify('+' . $this->getPayPeriod() . ' months');
    }

}