<?php

namespace App\Controller;

use App\Entity\Age;
use App\Entity\Player;
use App\Entity\Status;
use App\Repository\StatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, SessionInterface $session, StatusRepository $statusRepository)
    {

        $session->clear();

        $player = new Player();
        if (isset($_POST['pseudo']) && isset($_POST['status'])) {
            $dataPseudo = $_POST['pseudo'];
            $dataStatus = $_POST['status'];
            $status = $this->getDoctrine()
                ->getRepository(Status::class)
                ->findOneBy(['name' => $dataStatus]);
            $player->setPseudo($dataPseudo);
            $player->setStatus($status);
            $player->setPosition(1);
            $session->set('player', $player);

            return $this->redirectToRoute('custom_car');
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController'
        ]);
    }

    /**
     * @Route("/creation_personnage", name="custom_car")
     */
    public function select(SessionInterface $session)
    {
        if (empty($_POST['pseudo']) || empty($_POST['status'])) {
            $this->redirectToRoute('home');
        }
        if (isset($_POST['age']) && isset($_POST['gender'])) {
            $dataAge = $_POST['age'];
            $dataGender = $_POST['gender'];
            $dataGlasses = isset($_POST['glasses']) ? true : false ;
            $dataDentalCare = isset($_POST['dentalCare']) ? true : false;
            $dataPathology = isset($_POST['pathology']) ? true : false;
            $dataHospital = isset($_POST['hospital']) ? true : false ;
            $player = $session->get('player');
        }

        $player = $session->get('player');
        $playerStatus = $player->getStatus();
        $ageChoice = $this->getDoctrine()
            ->getRepository(Age::class)
            ->findby(['status' => $playerStatus]);
        return $this->render('home/customCar.html.twig', [
                'ageChoice' => $ageChoice,
            ]
        );
    }


    /**
     * @Route("/edit_avatar", name="edit_avatar")
     */
    public function editAvatar(Request $request, SessionInterface $session)
    {
        $player = $session->get('player');
        $player->setGender($request->get('gender'));
        $player->setHaveGlasses($request->get('glasses') ? true : false);
        $player->setHaveDentalCare($request->get('dentalCare') ? true : false);
        $player->setDoctorVisitFrequency($request->get('pathology') ? 1 : 0);
        $player->setAge($request->get('age'));
        $session->set('player', $player);
        return $this->json($player);
    }
}
