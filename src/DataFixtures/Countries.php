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
                    'name' => "Germany",
                    'tax_id_prefix' => "DE",
                ],
                'vat' => [
                    'percent' => "19.00"
                ]
            ],
            [
                'country' => [
                    'name' => "Italy",
                    'tax_id_prefix' => "IT",
                ],
                'vat' => [
                    'percent' => "22.00"
                ]
            ],
            [
                'country' => [
                    'name' => "Greece",
                    'tax_id_prefix' => "GR",
                ],
                'vat' => [
                    'percent' => "24.00"
                ]
            ],
        ];

        foreach ($data as $dataRow) {
            $country = new Entity\Country();
            $country->setName($dataRow['country']['name']);
            $country->setTaxIDPrefix($dataRow['country']['tax_id_prefix']);

            $vat = new Entity\VAT();
            $vat->setPercent($dataRow['vat']['percent']);
            $country->setVAT($vat);

            $manager->persist($country);
        }

        $manager->flush();
    }
}
