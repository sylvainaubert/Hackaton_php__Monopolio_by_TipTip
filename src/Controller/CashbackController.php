<?php

namespace App\Controller;

use App\Entity\Loose;
use App\Service\CashbackService;
use App\Service\RefundCalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CashbackController extends AbstractController
{
    /**
     * @Route("/test", name="cashback")
     */
    public function index()
    {

        return $this->render('cashback/index.html.twig', [
            'controller_name' => 'CashbackController',
        ]);
    }


    public function initializeCashback(CashbackService $cashbackService, SessionInterface $session)
    {
        $cashback = $cashbackService->calculateInitialCashback($session->get('player'));
        $player = $session->get('player');
        $player->setCashback($cashback);
        $session->get('player', $player);
    }


    /**
     * @param Loose $loose
     * @param RefundCalculatorService $refundCalculatorService
     * @param SessionInterface $session
     * @param CashbackService $cashbackService
     * @return SessionInterface
     */
    public function calculateLooseCoast(
        Loose $loose,
        RefundCalculatorService $refundCalculatorService,
        SessionInterface $session
    )
    {
        $refunds = $loose->getRefunds();
        $soin = [];

        $totalResteACharge = 0;
        $totalResteAChargeSansTipTip = 0;
        $totalRemboursementSecu = 0;
        $totalRemboursementTipTip = 0;

        foreach ($refunds as $key => $refund) {
            if ($refund->getId() !== 25) {
                $totalResteACharge += $refundCalculatorService->leftToPay($refund);
                $totalResteAChargeSansTipTip += $refundCalculatorService->leftToPayWithoutTipTip($refund);
                $totalRemboursementSecu += $refundCalculatorService->SecuRefundedAmount($refund);
                $totalRemboursementTipTip += $refundCalculatorService->TipTipRefundedAmount($refund);
            } else {
                $totalRemboursementTipTip += 25;
            }
            if ($refund->getId() !== 25) {
                $soin[$key] =
                    [
                        'soin' => $refund->getBenefit(),
                        'coutDuSoin' => $refund->getRegulatedPrice(),
                        'remboursementSecu' => $refundCalculatorService->SecuRefundedAmount($refund),
                        'rembTipTip' => $refundCalculatorService->TipTipRefundedAmount($refund),
                        'resteACharge' => $refundCalculatorService->leftToPay($refund),
                        'restAChargeSansTipTip' => $refundCalculatorService->leftToPayWithoutTipTip($refund),
                    ];
            } else {
                $soin[$key] =
                    [
                        'soin' => 'consultation médecin généraliste',
                        'coutDuSoin' => 25,
                        'remboursementSecu' => 0,
                        'rembTipTip' => 0,
                        'resteACharge' => 0,
                        'restAChargeSansTipTip' => 25,
                    ];
            }
        }
        $totalTour = ['totalRemboursementSecu' => $totalRemboursementSecu,
            'totalRemboursementTipTip' => $totalRemboursementTipTip,
            'totalResteACharge' => $totalResteACharge,
            'totalResteAChargeSansTipTip' => $totalResteAChargeSansTipTip,];
        $player = $session->get('player');
        $cashBack = $this->decrementCashBack($totalRemboursementTipTip);
        $player->setCashback($cashBack);

        if ($session->has('totalGame')) {
            $totalGame = $session->get('totalGame');
            $totalGame = ['totalRemboursementSecu' => $totalRemboursementSecu + $totalGame['totalRemboursementSecu'],
                'totalRemboursementTipTip' => $totalRemboursementTipTip + $totalGame['totalRemboursementTipTip'],
                'totalResteACharge' => $totalResteACharge + $totalGame['totalResteACharge'],
                'totalResteAChargeSansTipTip' => $totalResteAChargeSansTipTip + $totalGame['totalResteAChargeSansTipTip'],];
            $session->set('totalGame', $totalGame);
        } else {
            $session->set('totalGame', $totalTour);
        }

        $session->set('player', $player);
        $session->set('totalTour', $totalTour);
        $session->set('soin', $soin);

        return $session;
    }
}
