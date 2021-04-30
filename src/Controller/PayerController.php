<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Service\SmsGatewayService;
use Infobip\Configuration;
use Infobip\Api\SendSmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

class PayerController extends AbstractController
{
    public $x;
    public function setformation($idformation){
        $x=$idformation;
    }
    public function getformation(){
        return $this->x;
    }


    /**
     * @param Request $request
     * @param $idformation
     * @return Response
     * @Route("/payer{idformation}", name="payer")
     */
    public function index(FormationRepository $repository,Request $request,$idformation): Response
    {
        $this->setformation($idformation);
        $formation=$repository->findOneBy(['idformation'=>$idformation]);

        return $this->render('payer/index.html.twig', [
            'formation'=>$formation,
        ]);
    }


    /**
     * @return Response
     * @Route ("/inscrire", name="checkout")
     */
    public function checkout(\Swift_Mailer $mailer)
    {
        $idformation = $this->getformation();

        // $email = $u->getEmail();
        $message = (new \Swift_Message("Confirmation de la formation "))
            ->setFrom('samehbr63@gmail.com')
            ->setTo("sameh.benromdhane@esprit.tn")
            ->setBody(
                'Vous êtes inscrit a la formation. Merci de contacter l administration pour plus des
                informations. ');
        $mailer->send($message);
        return $this->redirectToRoute('formationcl');

    }


    /**
     * @Route ("/success",name="success")
     */
    public function success(){
        return $this->render('payer/Confimer.html.twig');



    }
    /**
     * @Route ("/error",name="error")
     */
    public function error(){
        return $this->render('payer/Erreur.html.twig');



    }
}