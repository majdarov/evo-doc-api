<?php

namespace App\Helper;

use App\Entity\{DocProd, Document, Product, Contragent};
use DateTime;

class DocumentHelper
{
  public function createDocument(
    string $doc_num,
    DateTime $doc_date,
    Contragent $cnt_seller,
    Contragent $cnt_receiver,
  ): ?Document {
    $document = new Document();
    $document
      ->setDocNum($doc_num)
      ->setDocDate($doc_date)
      ->setCntSeller($cnt_seller)
      ->setCntReceiver($cnt_receiver);

    return $document;
  }

  public function addProduct(
    Document $document,
    Product $product,
    float $price,
    float $amount
  ): ?DocProd {
    $doc_prod = new DocProd();
    $doc_prod
      ->setDocument($document)
      ->setProduct($product)
      ->setPrice($price)
      ->setAmount($amount);

    return $doc_prod;
  }
}
