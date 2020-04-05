<?php
namespace App\Core\Interfaces;

interface DatabaseInterface
{
     public function query(string $query, array $params);
}