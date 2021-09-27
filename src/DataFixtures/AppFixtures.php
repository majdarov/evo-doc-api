<?php

namespace App\DataFixtures;

use App\Entity\Contragent;
use App\Entity\ContragentType;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $def_types = ['shiper', 'storage', 'shop', 'customer', 'write_of'];

        foreach ($def_types as $type) {
            $cnt_type = new ContragentType();
            $cnt_type->setCntType($type);
            $manager->persist($cnt_type);

            $cnt = new Contragent();
            $cnt->setCntName('Default ' . $type);
            $cnt->setCntType($cnt_type);
            $cnt->setCntInfo('Default ' . $type);
            $manager->persist($cnt);
        }

        $product = new Product();
        $product
            ->setProductName('Test product')
            ->setCode(10000)
            ->setTax('NO_VAT');
        $manager->persist($product);

        $manager->flush();
    }
}
