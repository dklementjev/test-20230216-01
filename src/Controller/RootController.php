<?php

namespace App\Controller;

use App\Form;
use App\FormData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RootController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function index(): Response
    {
        $formData = new FormData\ProductPurchase();
        $form = $this->createForm(
            Form\ProductPurchaseType::class, 
            $formData, 
            ['method'=>"POST"]
        );

        return $this->render('root/index.html.twig', [
            'controller_name' => 'RootController',
            'form' => $form
        ]);
    }
}
