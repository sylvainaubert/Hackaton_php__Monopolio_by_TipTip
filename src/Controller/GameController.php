<?php

namespace App\Controller;

use App\Entity\Loose;
use App\Form\FinalPlayerType;
use App\Service\CashbackService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @param SessionInterface $session
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param CashbackService $cashbackService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(
        SessionInterface $session,
        Request $request,
        \Swift_Mailer $mailer,
        CashbackService $cashbackService
    )
    {

        dump($session->get('player'));
        if(empty($session->get('totalGame'))) {
            $cashbackService->initializeCashback();
        }

        if (!$session->has('player')) {
            return $this->redirectToRoute('home');
        }

        if (isset($_GET['submitLooses'])) {
            $looseID = $_GET['submitLooses'];
            $loose = $this->getDoctrine()
                ->getRepository(Loose::class)
                ->findOneBy(['id' => $looseID]);
            $cashbackService->calculateLooseCoast($loose);
        }

        $player = $session->get('player');
        $openPopup = $session->get('openPopup');

        $form = $this->createForm(FinalPlayerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            $clientFullName = $player->getFirstname() . ' ' . $player->getLastname();
            $message = (new \Swift_Message('Demande de souscription'))
                ->setFrom('tip.tip45000@gmail.com')
                ->setTo('tom.maail@tonsite.fr')
                ->setBody(
                    $this->renderView('email.twig.html', [
                        'fullName' => $clientFullName,
                            'player' => $data

                        ]
                    ),
                    'text/html'
                );
            $mailer->send($message);
        }

        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
            'player'=>$player,
            'form' => $form->createView(),
            'openPopup' => $openPopup,
        ]);
    }
}
