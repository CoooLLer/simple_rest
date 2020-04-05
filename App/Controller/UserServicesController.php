<?php

namespace App\Controller;

use App\Core\Kernel;
use App\Core\View;
use App\Repository\ServiceRepository;
use App\Repository\TariffRepository;
use App\Repository\UserRepository;

class UserServicesController
{

    private View $view;
    private UserRepository $userRepository;
    private ServiceRepository $serviceRepository;
    private TariffRepository $tariffRepository;

    public function __construct()
    {
        $this->view = Kernel::getInstance()->getView();
        $this->userRepository = new UserRepository(Kernel::getInstance()->getDatabase());
        $this->serviceRepository = new ServiceRepository(Kernel::getInstance()->getDatabase());
        $this->tariffRepository = new TariffRepository(Kernel::getInstance()->getDatabase());
    }

    public function getUserServiceTariffs(int $userId, int $serviceId)
    {
        $user = $this->userRepository->getUserById($userId);
        if (!$user) {
            $this->view->sendError('No user found');
            return;
        }

        $service = $this->serviceRepository->getServiceById($serviceId);
        if (!$service) {
            $this->view->sendError('No service found');
            return;
        }

        $serviceTarif = $this->tariffRepository->getTariffById($service->getTarifId());
        if (!$serviceTarif) {
            $this->view->sendError('No tarif found');
            return;
        }

        $tarifs = $this->tariffRepository->getTariffsByGroupId($serviceTarif->getTariffGroupId());

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
                'new_payday' => $tarif->getPayDay()->format('UO'),
                'speed' => $tarif->getSpeed()
            ];
        }

        $this->view->sendJson($data);

    }

    public function setUserServiceTariff(int $userId, int $serviceId, object $data)
    {
        if (empty($data->tarif_id)) {
            $this->view->sendError('tarif_id is not passed');
        }

        $tarif = $this->tariffRepository->getTariffById($data->tarif_id);
        if (!$tarif) {
            $this->view->sendError('No tariff found');
        }
        if ($this->serviceRepository->setTariff($serviceId, $tarif)) {
            $this->view->sendJson(['result' => 'ok']);
        } else {
            $this->view->sendError('Error occurred while setting tariff');
        }
    }
}