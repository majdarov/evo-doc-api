<?php

namespace App\Lib;

abstract class AbstractProductCategory
{
  use BarcodeTrait;

  /**
     * @ORM\OneToMany(targetEntity=Barcode::class, mappedBy="instance", orphanRemoval=true, cascade={"persist", "remove", "merge"})
     */
  private $barcodes;

  abstract public function getBarcodes();

  abstract public function addBarcode();
}
