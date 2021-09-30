<?php

namespace App\DataFixtures;

use App\Entity\{Barcode, Contragent, ContragentType, Product, Category};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
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
            ->setName('Test product')
            ->setCode(10000)
            ->setAllowToSell(true)
            ->setPrice(1.50)
            ->setCostPrice(1.00)
            ->setQuantity(1);
        $product->addBarcode(
            (new Barcode())
                ->setBarcode($product::createBarcode(10000, '7321'))
        );
        $product->setParent(
            (new Category())
                ->setName('test category_1')
                ->setCode(10500)
        );

        $manager->persist($product);
        $manager->flush();

        $product->setName($product->getName() . '_updated');
        $manager->flush();
    }
}
