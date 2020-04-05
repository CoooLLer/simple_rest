<?php

namespace App\Controller;

use App\Core\Kernel;
use App\Core\View;
use App\Repository\ServiceRepository;
use App\Repository\TarifRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeZone;

class UserServicesController
{

    private View $view;

    public function __construct()
    {
        $this->view = Kernel::getInstance()->getView();
    }

    public function getUserServiceTarifs(int $userId, int $serviceId)
    {
        $userRepository = new UserRepository(Kernel::getInstance()->getDatabase());
        $user = $userRepository->getUserById($userId);
        if (!$user) {
            $this->view->sendError('No user found');
            return;
        }

        $serviceRepository = new ServiceRepository(Kernel::getInstance()->getDatabase());
        $service = $serviceRepository->getServiceById($serviceId);
        if (!$service) {
            $this->view->sendError('No service found');
            return;
        }

        $tarifRepository = new TarifRepository(Kernel::getInstance()->getDatabase());
        $serviceTarif = $tarifRepository->getTarifById($service->getTarifId());
        if (!$serviceTarif) {
            $this->view->sendError('No tarif found');
            return;
        }

        $tarifs = $tarifRepository->getTarifsByGroupId($serviceTarif->getTarifGroupId());

        $data = [
            'result' => 'ok',
        ];
        $data['tarifs'] = [
            'title' => $serviceTarif->getTitle(),
            'link' => $serviceTarif->getLink(),
            'speed' => $serviceTarif->getSpeed(),
        ];
        foreach ($tarifs as $tarif) {
            $data['tarifs']['tarifs'][] = [
                'ID' => $tarif->getId(),
                'title' => $tarif->getTitle(),
                'price' => $tarif->getPrice(),
                'pay_period' => $tarif->getPayPeriod(),
                'new_payday' => (new DateTime('today midnight', new DateTimeZone('Europe/Moscow')))->modify('+' . $tarif->getPayPeriod() . ' months')->format('UO'),
                'speed' => $tarif->getSpeed()
            ];
        }

        $this->view->sendJson($data);

    }

    public function setUserServiceTarif(int $userId, int $serviceId, object $data)
    {

    }
}