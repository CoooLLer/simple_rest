<?php
namespace App\Core\Interfaces;

interface DatabaseInterface
{
     public function selectQuery(string $query, array $params);
}