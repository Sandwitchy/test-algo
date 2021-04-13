<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FriendshipFormType;
use App\Manager\CharacterCollectionManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request,CharacterCollectionManager $characterCollectionManager, SessionInterface $session): Response
    {
        $form = $this->createForm(FriendshipFormType::class);
        $form -> handleRequest($request);

        if($form->isSubmitted()){
            //clear session
            if($form->get("clear")->isClicked()){
                $session->set("characterArray",null);
                $session->set("rawData", null);
                
                return $this->redirectToRoute("index");
            }else{
                //add already submitted data to the manager
                if(!empty($session->get("characterArray"))){
                    $characterCollectionManager->setCharacterArray($session->get("characterArray")); 
                }

                if(!empty($form->getData()["character_to_test"])){
                    $result = $characterCollectionManager->isMyFriend($form->getData()["character_to_test"]);
                }else{
                    
                    //Keep the raw data in session for showing the different lines to the user
                    $rawData = empty($session->get("rawData")) ? [] : $session->get("rawData");
                    $rawData[] = $form->getData();
                    $session->set("rawData",$rawData);
                    //add to array
                    $characterCollectionManager->addToArray($form->getData());
        
                    //keep in session to add others links
                    $session->set("characterArray",$characterCollectionManager->getCharacterArray());
            
               
                    return $this->redirectToRoute("index");
                }
                
            }
            
        }

        return $this -> render("index.html.twig",[
            "form" => $form->createView(),
            "rawData" => $session->get("rawData"),
            "result" => isset($result) ? $result : null,
            "character_to_test" => isset($form->getData()["character_to_test"]) ? $form->getData()["character_to_test"] : null
        ]);
    }
}
