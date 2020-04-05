<?php


namespace App\Core;


class View
{
    public function sendJson(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public function sendError(string $description)
    {
        header('Content-Type: application/json');
        echo json_encode([
            'result' => 'error',
            'description' => $description
        ]);
    }
}