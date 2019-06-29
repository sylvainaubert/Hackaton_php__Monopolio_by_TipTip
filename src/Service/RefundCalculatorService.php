<?php


namespace App\Service;


use App\Entity\Refund;

class RefundCalculatorService
{

    public function SecuRefundedAmount(Refund $refund): float
    {
        $secuRefund = 0;

        if($refund->getSecuSupported()) {
            $secuBasic = $refund->getBasicRefund();
            $secuRate = $refund->getRefundRate();
            $secuRefund = ($secuBasic * $secuRate) / 100;
        }

        return $secuRefund;
    }

    public function TipTipRefundedAmount(Refund $refund): float
    {
        $secuRefund = $this->SecuRefundedAmount($refund);
        $tipTipRate = $refund->getRefundRateTipTip();
        $basicRefund = $refund->getBasicRefund();
        if($refund->getSecuSupported()) {
            $tipTipRefund = ($secuRefund * $tipTipRate) / 100;
            if (($tipTipRefund + $secuRefund) > $basicRefund) {
                $tipTipRefundedAmount = ($basicRefund - $secuRefund);
            } else {
                $tipTipRefundedAmount = $tipTipRefund;
            }
        } else {
            $tipTipRefundedAmount = $basicRefund;
        }
        return $tipTipRefundedAmount;
    }

    public function leftToPay(Refund $refund): float
    {
        $secuRefund = $this->SecuRefundedAmount($refund);
        $tipTipRefund = $this->TipTipRefundedAmount($refund);
        $regulatedPrice = $refund->getRegulatedPrice();
        $leftToPay = ($regulatedPrice - ($secuRefund + $tipTipRefund));
        return $leftToPay;
    }

    public function leftToPayWithoutTipTip(Refund $refund) : float
    {
        $secuRefund = $this->SecuRefundedAmount($refund);
        $regulatedPrice = $refund->getRegulatedPrice();
        if($refund->getSecuSupported()) {
            $leftToPayWithouTipTip = $regulatedPrice - $secuRefund;
        } else {
            $leftToPayWithouTipTip = $regulatedPrice;
        }
        return $leftToPayWithouTipTip;
    }
}