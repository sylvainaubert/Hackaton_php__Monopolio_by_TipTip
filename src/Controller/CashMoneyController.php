<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CashMoneyController extends AbstractController
{
    /**
     * @Route("/cash/money", name="cash_money")
     */
    public function index()
    {
        $value = 100;

        return $this->render('cash_money/index.html.twig', [
            'controller_name' => 'CashMoneyController',
            'value' => $value,
        ]);
    }
}
