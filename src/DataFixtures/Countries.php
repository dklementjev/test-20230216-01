<?php

namespace App\DataFixtures;

use App\Entity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Countries extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'country' => [
                    'name' => "Germany"
                ],
                'vat' => [
                    'percent' => "19.00"
                ]
            ],
            [
                'country' => [
                    'name' => "Italy"
                ],
                'vat' => [
                    'percent' => "22.00"
                ]
            ],
            [
                'country' => [
                    'name' => "Greece"
                ],
                'vat' => [
                    'percent' => "24.00"
                ]
            ],
        ];

        foreach ($data as $dataRow) {
            $country = new Entity\Country();
            $country->setName($dataRow['country']['name']);
            $vat = new Entity\VAT();
            $vat->setPercent($dataRow['vat']['percent']);
            $country->setVAT($vat);            
            $manager->persist($country);
        }

        $manager->flush();
    }
}
