<?php

namespace App\Controller;

use App\Form;
use App\FormData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function index(Request $request): Response
    {
        $formData = new FormData\ProductPurchase();
        $form = $this->createForm(
            Form\ProductPurchaseType::class, 
            $formData, 
            ['method'=>"POST"]
        );
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            if ($form->isValid()){
                return $this->redirectToRoute(
                    "app_purchase", 
                    [
                        'product' => $formData->getProduct()->getId(),
                        'tax_id' => $formData->getTaxID()
                    ]
                );
            }
        }

        return $this->render(
            'root/index.html.twig', 
            [
                'form' => $form
            ]
        );
    }
}
