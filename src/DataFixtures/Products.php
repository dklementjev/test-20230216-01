<?php

namespace App\DataFixtures;

use App\Entity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Products extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['name' => "Headphones", 'price' => 100],
            ['name' => "Phone cover", 'price' => 20]
        ];

        foreach ($data as $dataRow) {
            $product = new Entity\Product();
            $product->setName($dataRow['name']);
            $product->setPrice($dataRow['price']);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
