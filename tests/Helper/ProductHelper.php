<?php

namespace App\Tests\Helper;

use App\Entity\Barcode;
use App\Entity\Product;
use App\Entity\Category;

class ProductHelper
{
  public function createProduct(int $code = 10000, string $name = 'test product'): ?Product
  {
    $product = (new Product())
      ->setName($name)
      ->setCode($code)
      ->setAllowToSell(true)
      ->setPrice(1.50)
      ->setCostPrice(1.00)
      ->setQuantity(1);

    $product->addBarcode(
      (new Barcode())
        ->setBarcode($product::createBarcode($product->getCode(), '7321'))
    );

    $product->setParent(
      (new Category())
        ->setName('test category_1')
        ->setCode(100500)
    );

    return $product;
  }
}
