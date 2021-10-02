<?php

namespace App\Tests;

use App\Entity\ProdCat;
use App\Entity\Product;
use App\Repository\ProdCatRepository;
use App\Repository\ProductRepository;
use App\Helper\ProdCatHelper;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager;
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testWriteAndReadProduct(): ?string
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        //$routerService = self::$container->get('router');
        //$myCustomService = self::$container->get(CustomService::class);,

        //write $product into DB
        $helper = new ProdCatHelper();
        $product = $helper::createProduct(10000, 'test_product', $helper::BC_AUTO);

        $product->setParent($helper::createCategory(100500, 'test category_1', \null));

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        //read $product from repsitory;
        $repository = $this->entityManager
            ->getRepository(Product::class);
        $read_product = $repository->findOneBy(['instance_name' => $product->getName()]);

        $this->assertEquals($product->getId(), $read_product->getId());

        //test barcode
        $bc = $product::createBarcode($product->getCode(), '7321');
        $read_bc = $read_product->getBarcodes()[0]->getBarcode();
        $this->assertEquals($bc, $read_bc);

        return $read_product->getId();
    }

    /**
     * @depends testWriteAndReadProduct
     * */
    public function testUpdateDeleteProduct(string $id)
    {
        $kernel = self::bootKernel();
        $this->assertSame('test', $kernel->getEnvironment());
        $manager = $this->entityManager;

        $repository = $manager->getRepository(Product::class);

        // test update product
        $product_for_update = $manager->find(Product::class, $id);
        $product_for_update->setName('test updated_name');
        $manager->flush();

        $updated_product = $repository->findOneBy(['instance_name' => $product_for_update->getName()]);
        $this->assertIsObject($updated_product, 'not object');
        if (\is_object($updated_product)) {
            $this->assertEquals($product_for_update->getName(), $updated_product->getName());
        }

        // test delete(remove) product
        $manager->remove($product_for_update);
        $manager->flush();

        $this->assertNull($manager->find(Product::class, $id));
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
