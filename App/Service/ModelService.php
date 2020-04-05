<?php


namespace App\Service;


use App\Core\Interfaces\ModelInterface;
use App\Core\Kernel;
use DateTime;

class ModelService
{
    public static function fillModel(ModelInterface $model, array $data) {
        $dataMappings = $model->getDataMapping();
        foreach ($dataMappings as $key => $property) {
            switch ($property['type']) {
                case 'datetime':
                    $value = new DateTime($data[$key]);
                    break;
                case 'string':
                    $value = $data[$key];
                    if (!empty(Kernel::getInstance()->getConfig()['database']['charset']) && Kernel::getInstance()->getConfig()['database']['charset'] !== 'UTF-8') {
                        $value = iconv(Kernel::getInstance()->getConfig()['database']['charset'], 'UTF-8', $value);
                    }
                    break;
                case 'float':
                    $value = (float)$data[$key];
                    break;
                default:
                    $value = $data[$key];
                    break;
            }


            $model->{'set' . ucfirst($property['propertyName'])}($value);
        }

        return $model;
    }
}