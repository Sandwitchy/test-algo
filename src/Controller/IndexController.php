<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\FriendshipFormType;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $form = $this->createForm(FriendshipFormType::class);


        return $this -> render("index.html.twig",[
            "form" => $form->createView(),
        ]);
    }
}
