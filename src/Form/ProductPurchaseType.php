<?php

namespace App\Form;

use App\Entity;
use App\FormData;
use Symfony\Bridge\Doctrine\Form\Type as DoctrineFormTypes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as FormTypes;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductPurchaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                "product",
                DoctrineFormTypes\EntityType::class,
                [
                    'label' => "Product",

                    'class' => Entity\Product::class,
                    'choice_label' => function (Entity\Product $product) {
                        return "{$product->getName()} ({$product->getPrice()} EUR)";
                    }
                ]
            )
            ->add(
                "tax_id",
                FormTypes\TextType::class,
                [
                    'label' => "Tax ID"
                ]
            )
            ->add(
                "submit",
                FormTypes\SubmitType::class,
                [
                    'label' => "Purchase"
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormData\ProductPurchase::class
        ]);
    }
}
