<?php

namespace App\Helper;

use App\Entity\Barcode;
use App\Entity\Product;
use App\Entity\Category;

class ProdCatHelper
{
  public const BC_AUTO = 'bc-auto';

  public static function createProduct(
    int $code,
    string $name,
    Barcode|string $bc = \null
  ): ?Product {
    $product = (new Product())
      ->setName($name)
      ->setCode($code)
      ->setAllowToSell(true)
      ->setPrice(0)
      ->setCostPrice(0)
      ->setQuantity(0);

    if ($bc instanceof Barcode) {
      $product->addBarcode($bc);
    } elseif ($bc === self::BC_AUTO) {
      $product->addBarcode(
        (new Barcode)
          ->setBarcode($product::createBarcode($product->getCode(), '7321'))
      );
    }
    return $product;
  }

  public static function createCategory(
    int $code,
    string $name,
    ?Category $parent
  ): ?Category {
    $category = (new Category())
      ->setName($name)
      ->setCode($code);
    if (null !== $parent) {
      $category->setParent($parent);
    }
    return $category;
  }
}
