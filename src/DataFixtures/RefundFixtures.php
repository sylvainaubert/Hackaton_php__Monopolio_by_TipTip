<?php

namespace App\DataFixtures;

use App\Entity\Refund;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RefundFixtures extends Fixture
{
    const REFUND = [
        [
            'benefit' => 'honoraires hospitalisation',
            'regulated_price' => 2000,
            'basic_refund' => 2000,
            'refund_rate' => 80,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'frais de séjour hospitalisation',
            'regulated_price' => 200,
            'basic_refund' => 200,
            'refund_rate' => 80,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'frais de transport',
            'regulated_price' => 150,
            'basic_refund' => 150,
            'refund_rate' => 65,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'forfait journalier',
            'regulated_price' => 20,
            'basic_refund' => 20,
            'refund_rate' => 0,
            'refund_rate_tip_tip' => 20,
            'secu_supported' => 0,
        ],
        [
            'benefit' => 'lit accompagnant',
            'regulated_price' => 100,
            'basic_refund' => 100,
            'refund_rate' => 0,
            'refund_rate_tip_tip' => 90,
            'secu_supported' => 0,
        ],
        [
            'benefit' => 'chambre seul',
            'regulated_price' => 250,
            'basic_refund' => 250,
            'refund_rate' => 0,
            'refund_rate_tip_tip' => 0,
            'secu_supported' => 0,
        ],
        [
            'benefit' => 'consultation médecin généraliste',
            'regulated_price' => 25,
            'basic_refund' => 25,
            'refund_rate' => 70,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'consultation médecin spécialiste',
            'regulated_price' => 35,
            'basic_refund' => 25,
            'refund_rate' => 70,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'consultation paramédicale',
            'regulated_price' => 22,26,
            'basic_refund' => 22,26,
            'refund_rate' => 60,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'prélévement sanguin',
            'regulated_price' => 25,
            'basic_refund' => 25,
            'refund_rate' => 60,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'médicaments',
            'regulated_price' => 10,
            'basic_refund' => 10,
            'refund_rate' => 65,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'détartrage',
            'regulated_price' => 28,
            'basic_refund' => 28,
            'refund_rate' => 70,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'carie',
            'regulated_price' => 25,
            'basic_refund' => 25,
            'refund_rate' => 70,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'prélévement sanguin',
            'regulated_price' => 25,
            'basic_refund' => 25,
            'refund_rate' => 60,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'lunettes',
            'regulated_price' => 5,
            'basic_refund' => 5,
            'refund_rate' => 1,
            'refund_rate_tip_tip' => 0,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'appareil auditif',
            'regulated_price' => 300,
            'basic_refund' => 300,
            'refund_rate' => 60,
            'refund_rate_tip_tip' => 0,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'telemedecine',
            'regulated_price' => 25,
            'basic_refund' => 25,
            'refund_rate' => 70,
            'refund_rate_tip_tip' => 100,
            'secu_supported' => 1,
        ],
        [
            'benefit' => 'dent sur pivot',
            'regulated_price' => 1500,
            'basic_refund' => 0,
            'refund_rate' => 0,
            'refund_rate_tip_tip' => 0,
            'secu_supported' => 0,
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::REFUND as $key => $refundValue) {
            $refund = new refund();
            $refund->setBenefit($refundValue['benefit']);
            $refund->setRegulatedPrice($refundValue['regulated_price']);
            $refund->setBasicRefund($refundValue['basic_refund']);
            $refund->setRefundRate($refundValue['refund_rate']);
            $refund->setRefundRateTipTip($refundValue['refund_rate_tip_tip']);
            $refund->setSecuSupported($refundValue['secu_supported']);
            $this->addReference('refund' . $key, $refund);
            $manager->persist($refund);
        }
        $manager->flush();
    }
}

