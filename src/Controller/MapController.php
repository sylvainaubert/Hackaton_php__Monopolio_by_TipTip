<?php

namespace App\Controller;

use App\Repository\MapRepository;
use App\Service\RefundCalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function index(MapRepository $mapRepository, SessionInterface $session, RefundCalculatorService $calculatorService)
    {
        dump($session);
        $map = $mapRepository->findFirst();
        $player = $session->get('player');

        return $this->render('map/index.html.twig', [
            'map' =>$map,
            'player' => $player,
            'calculatorService' => $calculatorService,
        ]);
    }
}
