<?php

namespace App\Tests\Helper;

use App\Entity\Barcode;
use App\Entity\Product;

class ProductHelper
{
  public function createProduct(int $code = 10000, string $name = 'test product'): ?Product
  {
    $product = (new Product())
      ->setProductName($name)
      ->setCode($code)
      ->setAllowToSell(true)
      ->setPrice(1.50)
      ->setCostPrice(1.00)
      ->setQuantity(1);

    $barcode = (new Barcode())
      ->setBarcode($product::createBarcode($product->getCode(), '7321'));
    $barcode->setInstance($product);

    return $product;
  }
}
