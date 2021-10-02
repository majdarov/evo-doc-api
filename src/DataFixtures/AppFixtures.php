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
            $cnt->setCntInfo('Default ' . $type);
            $manager->persist($cnt);
        }


            $category = $helper->createCategory(10500, 'Category 10500', \null);
            $manager->persist($category);
            $category2 = $helper->createCategory(10500, 'Category 10500 2', \null);
            $manager->persist($category2);

            for ($j = 0; $j < 20; $j++) {
                $product = $helper->createProduct(10000 + $j, 'Product ' . (10000 + $j), $helper::BC_AUTO);
                if ($j % 3 === 0) {
                    $product->setParent($category);
                } elseif ($j % 2 === 0) {
                    $product->setParent($category2);
                }
                $manager->persist($product);
            }
            $manager->flush();
    }
}
