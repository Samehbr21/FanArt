<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationClientController extends AbstractController
{
    /**
     * @Route("/formation/client", name="formation_client")
     */
    public function index(): Response
    {
        return $this->render('formation_client/index.html.twig', [
            'controller_name' => 'FormationClientController',
        ]);
    }
    /**
     *@param FormationRepository $repository
     * @return Response
     * @Route ("listformationclient",name ="listformationclient")
     */
    public function ListClientformation(FormationRepository $repository, Request $request){
        $search = new PropertySearch();
        $form = $this -> createForm(PropertySearchType::class,$search);
        $form->handleRequest($request);
        $formarion=[];
        if($form->isSubmitted() && $form->isValid()){
            $prix = $search->getMaxprice();
            if ($prix!="")
                $formarion=$this->getDoctrine()->getRepository()
                    ->findBy(['prix'=>$prix]);
            else
                $formarion=$this->getDoctrine()->getRepository()
                    ->findAll();
        }
        $formarion=$repository ->findAll();
        return $this->render('formation_client/Listeformationclient.html.twig',
            ['formation' => $formarion, 'form' =>$form->createView()]
        );
    }
    /**
     * @Route("/formation/searchName", name="searchName")
     */
    function SearchName (FormationRepository $repository,Request $request){
        $data=$request->get('find');
        $nom=$repository->findBy(['nomformation'=>$data]);
        return $this->render('formation/Listeformation.html.twig', [
            'formation' => $nom,
        ]);
    }

    /**
     * @Route("/formation/formationOrderASC" , name="formationOrderASC")
     */
    public function FormationOrderASC(){
        $repository = $this->getDoctrine()->getRepository(formation::class);
        $form = $repository->trierdomaineASC();
        return $this->render('formation/Listeformation.html.twig', ['formation' => $form,]);
    }

    /**
     * @Route("/formation/formationOrderDESC" , name="formationOrderDESC")
     */
    public function FormationOrderDESC(){
        $repository = $this->getDoctrine()->getRepository(formation::class);
        $form = $repository->trierdomaineDESC();
        return $this->render('formation/Listformation.html.twig', ['formation' => $form,]);
    }


}
