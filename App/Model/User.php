<?php

namespace App\Model;

use App\Core\Interfaces\ModelInterface;

class User implements ModelInterface
{
    private int $id;

    private string $login;

    private string $nameFirst;

    private string $nameLast;

    private $dataMapping = [
        'ID' => [
            'propertyName' => 'id',
            'type' => 'int'
        ],
        'login' => [
            'propertyName' => 'login',
            'type' => 'string'
        ],
        'name_first' => [
            'propertyName' => 'nameFirst',
            'type' => 'string'
        ],
        'name_last' => [
            'propertyName' => 'nameLast',
            'type' => 'string'
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
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return User
     */
    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameFirst(): string
    {
        return $this->nameFirst;
    }

    /**
     * @param string $nameFirst
     * @return User
     */
    public function setNameFirst(string $nameFirst): self
    {
        $this->nameFirst = $nameFirst;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameLast(): string
    {
        return $this->nameLast;
    }

    /**
     * @param string $nameLast
     * @return User
     */
    public function setNameLast(string $nameLast): self
    {
        $this->nameLast = $nameLast;
        return $this;
    }

    public function getDataMapping()
    {
        return $this->dataMapping;
    }
}