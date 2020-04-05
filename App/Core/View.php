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

        $error = ['result' => 'error'];

        if (Kernel::getInstance()->getConfig()['show_json_error_description']) {
            $error['description'] = $description;
        }

        echo json_encode($error);
    }
}