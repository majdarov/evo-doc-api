<?php

namespace App\Tests;

use App\Entity\Product;
use App\Entity\Barcode;
use App\Lib\BarcodeTrait;
use App\Lib\ProductInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testDefaultProduct()
    {
        $product = (new Product())
            ->setProductName('default product')
            ->setCode(3)
            ->setQuantity(1)
            ->setPrice(1.00)
            ->setCostPrice(2.00);

        $barcode = (new Barcode())
            ->setInstance($product)
            ->setBarcode($product::createBarcode($product->getCode(), '7321'));

        $product->addBarcode($barcode);

        $this->assertEquals('default product', $product->getProductName(), 'default product');
        $this->assertSame(ProductInterface::MEASURE_NAMES[0], $product->getMeasureName(), 'assert шт');
        $this->assertSame(ProductInterface::TAXES[0], $product->getTax(), 'assert NO_VAT');
        $this->assertSame(ProductInterface::TYPES[0], $product->getProductType(), 'assert NORMAL');
        $this->assertEquals('2000000000039', $product::createBarcode($product->getCode()));
        $this->assertEquals('2073210000038', $product::createBarcode($product->getCode(), '7321'));
        $this->assertEquals($product->getBarcodes()[0], $barcode);
        $bc = BarcodeTrait::createBarcode($product->getCode(), '7321');
        $this->assertEquals('2073210000038', $bc);

        return $product;
    }

    /**
     * @depends testDefaultProduct
     */
    public function testDb(Product $product)
    {
        $productRepository = $this->createMock(ObjectRepository::class);
        $productRepository->expects($this->any())
            ->method('find')
            ->willReturn($product);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($productRepository);

        $new_product = new Product($objectManager);
        $this->assertEquals('2073210000038', $new_product::createBarcode($product->getCode(), '7321'));
    }
}
