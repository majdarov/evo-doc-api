<?php

namespace App\DataFixtures;

use App\Entity\{Barcode, Contragent, ContragentType, Product, Category};
use App\Helper\ProdCatHelper;
use App\Helper\ProductHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $def_types = ['shiper', 'storage', 'shop', 'customer', 'write_of'];
        $helper = new ProdCatHelper();

        foreach ($def_types as $type) {
            $cnt_type = new ContragentType();
            $cnt_type->setCntType($type);
            $manager->persist($cnt_type);

            $cnt = new Contragent();
            $cnt->setCntName('Default ' . $type);
            $cnt->setCntType($cnt_type);
            $cnt->setCntInfo('Default ' . $type . ' info');
            $manager->persist($cnt);
        }

        for ($i = 0; $i < 2; $i++) {
            ${"category$i"} = $helper->createCategory(10500 + $i, 'Category 1050'.$i, \null);
            ${"category$i"}->addBarcode(
                (new Barcode)
                    ->setBarcode(
                        ${"category$i"}::createBarcode('1050'.$i, '7777')
                    )
            );
            $manager->persist(${"category$i"});
        }

        for ($j = 0; $j < 20; $j++) {
            $product = $helper->createProduct(10000 + $j, 'Product ' . (10000 + $j), $helper::BC_AUTO);
            if ($j % 3 === 0) {
                $product->setParent($category0);
            } elseif ($j % 2 === 0) {
                $product->setParent($category1);
            }
            $manager->persist($product);
        }
        $manager->flush();
    }
}
