<?php

namespace App\Tests;

use App\Entity\Product;
use App\Entity\Barcode;
use App\Tests\Helper\ProductHelper;
use phpDocumentor\Reflection\Types\This;
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

    public function testWriteAndReadProduct(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        //$routerService = self::$container->get('router');
        //$myCustomService = self::$container->get(CustomService::class);

        //write $product into DB
        $product = (new ProductHelper())->createProduct();
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        //read $product from repsitory;
        $read_product = $this->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['product_name ' => $product->getProductName()]);

        $this->assertEquals($product, $read_product);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
