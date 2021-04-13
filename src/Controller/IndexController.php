<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FriendshipFormType;
use App\Generator\CharacterCollectionGenerator;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request,CharacterCollectionGenerator $characterCollectionGenerator): Response
    {
        $form = $this->createForm(FriendshipFormType::class);

        $form -> handleRequest($request);
        if($form->isSubmitted()){
            //Generate entities
            $characterCollectionGenerator->addToCollection($form->getData());
            dump($characterCollectionGenerator->characterArray);
        }

        return $this -> render("index.html.twig",[
            "form" => $form->createView(),
        ]);
    }
}
