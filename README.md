#  Приложение evo-doc-api v0.0.1
## Приложение и API товарного учета

автор: majdarov@gmail.com
-------------------------

##  Сущности

### Документы

> **Document**: `App\Entity\Document`
> - *id* `uuid`
> - *doc_num* `string`
> - *doc_date* `\DateTimeImmutable`
> - *seller* `App\Entity\Contragent`
> - *receiver* `App\Entity\Contragent`
> - *products* `array(App\Entity\DocProd)`

> **DocProd**: `App\Entity\DocProd`
> - *document_id* `uuid`
> - *product_id* `uuid`
> - *price* `float`
> - *amount* `float`

> **Contragent** `App\Entity\Contragent`
> - *id* `uuid`
> - *cnt_name* `string`
> - *cnt_type* `App\Entity\ContragentType`
> - *cnt_info* `string`
> - *sentDocuments* `array(App\Entity\Document)`
> - *receivedDocuments* `array(App\Entity\Document)`

> **ContragentType** `App\Entity\ContragentType`
> - *id* `uuid`
> - *cnt_type* `string`
> - *contragents* `array(App\Entity\Contragent)`

### Товары

***************
**ProdCat** `App\Entity\ProdCat`
- *id* `uuid`
- *instance_name* `string`
- *code* `integer`
- *parent* `App\Entity\Category`
- *barcodes* `array(App\Entity\Barcode)`

## Тесты

![under construction](public/images/under-construction.gif)

## Автотесты размещены в папке:

***Good luke!***
