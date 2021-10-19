#  Приложение evo-doc-api v:0.0.1
## Приложение и API товарного учета

автор: <majdarov@gmail.com>

##  Сущности

### Документы

**Document**: [`App\Entity\Document`](src/Entity/Document.php)
- *id* `uuid`
- *doc_num* `string`
- *doc_date* `\DateTimeImmutable`
- *seller* [`App\Entity\Contragent`](src/Entity/Contragent.php)
- *receiver* [`App\Entity\Contragent`](src/Entity/Contragent.php)
- *products* [`array(App\Entity\DocProd)`](src/Entity/DocProd.php)

***

**DocProd**: [`App\Entity\DocProd`](src/Entity/DocProd.php)
- *document_id* `uuid`
- *product_id* `uuid`
- *price* `float`
- *amount* `float`

***

**Contragent** [`App\Entity\Contragent`](src/Entity/Contragent.php)
- *id* `uuid`
- *cnt_name* `string`
- *cnt_type* [`App\Entity\ContragentType`](src/Entity/ContragentType.php)
- *cnt_info* `string`
- *sentDocuments* [`array(App\Entity\Document)`](src/Entity/Document.php)
- *receivedDocuments* [`array(App\Entity\Document)`](src/Entity/Document.php)

***

**ContragentType** [`App\Entity\ContragentType`](src/Entity/ContragentType.php)
- *id* `uuid`
- *cnt_type* `string`
- *contragents* [`array(App\Entity\Contragent)`](src/Entity/Contragent.php)

***

### Товары

**ProdCat** [`App\Entity\ProdCat`](src/Entity/ProdCat.php)
- *id* `uuid`
- *instance_name* `string`
- *code* `integer`
- *parent* [`App\Entity\Category`]((src/Entity/Category.php))
- *barcodes* [`array(App\Entity\Barcode)`](src/Entity/Barcode.php)

## Тесты

![under construction](public/images/under-construction.gif)

## Автотесты размещены в папке:

***Good luke!***
