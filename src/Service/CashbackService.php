<?php


namespace App\Service;


use App\Entity\Loose;
use App\Entity\Player;
use App\Repository\AgeRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CashbackService
{
    public $ageRepository;
    private $logger;
    public $session;
    public $refundCalculatorService;


    public function __construct(
        AgeRepository $ageRepository,
        LoggerInterface $logger,
        SessionInterface $session,
        RefundCalculatorService $refundCalculatorService
    )
    {
        $this->session = $session;
        $this->logger = $logger;
        $this->ageRepository = $ageRepository;
        $this->refundCalculatorService = $refundCalculatorService;
    }

    public function giveSubscription(Player $player): float
    {
        $playerAge = $player->getAge();
        $age = $this->ageRepository
            ->findOneBy(['id' => $playerAge]);
        $price = $age->getPrice();
        return $price;
    }

    public function calculateInitialCashback(Player $player): float
    {
        $subscription = $this->giveSubscription($player);
        $annualSub = $subscription * 12;
        $taxes = ($annualSub * 20) / 100;
        $annualSubHT = $annualSub - $taxes;
        $cashback = $annualSubHT / 2;
        return $cashback;
    }

    public function decrementCashBack(float $refund): float
    {
        $cashBack = $this->session->get('player')->getCashBack();
        $cashBackRemaining = 0;
        if (($cashBack - $refund) > 0) {
            $cashBackRemaining = $cashBack - $refund;
        }
        return $cashBackRemaining;
    }

    /**
     * @param SessionInterface $session
     */
    public function initializeCashback()
    {
        $cashback = $this->calculateInitialCashback($this->session->get('player'));
        $player = $this->session->get('player');
        $player->setCashback($cashback);
        $player->setCashbackInit($cashback);
        $this->session->get('player', $player);
    }

    /**
     * @param Loose $loose
     * @param RefundCalculatorService $refundCalculatorService
     * @param SessionInterface $session
     */
    public function calculateLooseCoast(
        Loose $loose
    )
    {
        $refunds = $loose->getRefunds();
        $soin = [];

        $totalResteACharge = 0;
        $totalResteAChargeSansTipTip = 0;
        $totalRemboursementSecu = 0;
        $totalRemboursementTipTip = 0;
        $totalCoutReel = 0;

        foreach ($refunds as $key => $refund) {
            if ($refund->getId() !== 25) {
                $totalResteACharge += $this->refundCalculatorService->leftToPay($refund);
                $totalResteAChargeSansTipTip += $this->refundCalculatorService->leftToPayWithoutTipTip($refund);
                $totalRemboursementSecu += $this->refundCalculatorService->SecuRefundedAmount($refund);
                $totalRemboursementTipTip += $this->refundCalculatorService->TipTipRefundedAmount($refund);
                $totalCoutReel += $refund->getRegulatedPrice();
            } else {
                $totalRemboursementTipTip += 25;
                $totalCoutReel += $refund->getRegulatedPrice();
            }
            if ($refund->getId() !== 25) {
                $soin[$key] =
                    [
                        'soin' => $refund->getBenefit(),
                        'coutDuSoin' => $refund->getRegulatedPrice(),
                        'remboursementSecu' => $this->refundCalculatorService->SecuRefundedAmount($refund),
                        'rembTipTip' => $this->refundCalculatorService->TipTipRefundedAmount($refund),
                        'resteACharge' => $this->refundCalculatorService->leftToPay($refund),
                        'restAChargeSansTipTip' => $this->refundCalculatorService->leftToPayWithoutTipTip($refund),
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
        $totalTour = [
            'totalRemboursementSecu' => $totalRemboursementSecu,
            'totalRemboursementTipTip' => $totalRemboursementTipTip,
            'totalResteACharge' => $totalResteACharge,
            'totalResteAChargeSansTipTip' => $totalResteAChargeSansTipTip,
            'totalCoutReel' => $totalCoutReel,
        ];
        $player = $this->session->get('player');
        $cashBack = $this->decrementCashBack($totalRemboursementTipTip);
        $player->setCashback($cashBack);

        if ($this->session->has('totalGame')) {
            $totalGame = $this->session->get('totalGame');
            $totalGame = [
                'totalRemboursementSecu' => $totalRemboursementSecu + $totalGame['totalRemboursementSecu'],
                'totalRemboursementTipTip' => $totalRemboursementTipTip + $totalGame['totalRemboursementTipTip'],
                'totalResteACharge' => $totalResteACharge + $totalGame['totalResteACharge'],
                'totalResteAChargeSansTipTip' => $totalResteAChargeSansTipTip + $totalGame['totalResteAChargeSansTipTip'],
                'totalCoutReel' => $totalCoutReel + $totalGame['totalCoutReel'],
            ];
            $this->session->set('totalGame', $totalGame);
        } else {
            $this->session->set('totalGame', $totalTour);
        }

        $this->session->set('player', $player);
        $this->session->set('totalTour', $totalTour);
        $this->session->set('soin', $soin);

    }
}
