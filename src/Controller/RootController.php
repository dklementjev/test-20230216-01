<?php

namespace App\Controller;

use App\Entity;
use App\Form;
use App\FormData;
use Doctrine\Persistence\ManagerRegistry;
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

    #[Route('/purchase/{product<\d+>}', name: 'app_purchase')]
    public function purchase(Request $request, ManagerRegistry $doctrine): Response
    {
        $taxID = $request->get("tax_id");
        $taxIDPrefix = $this->extractTaxIDPrefix($taxID);

        /** @var \App\Repository\ProductRepository $productRepo */
        $productRepo = $doctrine->getRepository(Entity\Product::class);
        $productId = $request->get("product");
        $product = $productRepo->getById($productId);
        if (empty($product)) {
            throw $this->createNotFoundException("Product not found");
        }

        /** @var \App\Repository\CountryRepository $countryRepo */
        $countryRepo = $doctrine->getRepository(Entity\Country::class);        
        $country = $countryRepo->getByTaxIDPrefix($taxIDPrefix);
        if (empty($country)) {
            throw $this->createNotFoundException("Country not found (unknown tax ID prefix?)");
        }

        $vat = $country->getVAT();

        return $this->render(
            "root/purchase.html.twig",
            [
                'product' => $product,
                'country' => $country,
                'vat' => $vat
            ]
        );
    }

    protected function extractTaxIDPrefix(?string $taxID): ?string
    {
        if (empty($taxID)) {
            return null;
        }

        return substr($taxID, 0, 2);
    }
}
