<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DiceController extends AbstractController
{

    const CELL_NUMBER = 42;
    /**
     * @Route("/dice", name="dice")
     */
    public function index(SessionInterface $session)
    {
        if (!$session->has('player')) {
            return $this->redirectToRoute('home');
        }

        $session->set('openPopup', false);

        $player = $session->get('player');
        $actualDiceNumber = $player->getPosition();

        if (isset($_POST['dice-number'])) {
            $openPopup = $_POST['openPopup'];
            $diceNumber = $_POST['dice-number'];
            $session->set('diceNumber', $diceNumber);
            $session->set('openPopup', true);
            $position = $actualDiceNumber + $diceNumber;
            if ($position > self::CELL_NUMBER) {
                $endPosition = self::CELL_NUMBER;
                $player->setPosition($endPosition);
                $session->set('player', $player);
                return $this->redirectToRoute('game');
            }

            $player->setPosition($position);
            $session->set('player', $player);

            return $this->redirectToRoute('game');
        }

        return $this->render('dice/index.html.twig', [
            'dice' => $session->get('diceNumber') ?? 1,
            'position' => $position ?? 1,

        ]);
    }

    /**
     * @Route("/delete-player", name="delete_player")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deletePlayer(SessionInterface $session)
    {
        $session->clear();

        return $this->redirectToRoute('game');
    }
}
