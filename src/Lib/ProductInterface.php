<?php

namespace App\Lib;

interface ProductInterface
{
  public const MEASURE_NAMES = ['шт', 'л', 'кг', 'м', 'км', 'м2', 'м3', 'компл', 'упак', 'ед', 'дроб'];
  public const TYPES = ['NORMAL', 'DAIRY_MARKED', 'ALCOHOL_NOT_MARKED', 'ALCOHOL_MARKED', 'SHOES_MARKED', 'SERVICE', 'MEDICINE_MARKED', 'TOBACCO_MARKED', 'PERFUME_MARKED', 'PHOTOS_MARKED', 'TYRES_MARKED', 'TOBACCO_PRODUCTS_MARKED', 'LIGHT_INDUSTRY_MARKED'];
  public const TAXES = ['NO_VAT', 'VAT_0', 'VAT_10', 'VAT_10_110', 'VAT_18', 'VAT_18_118'];
}
