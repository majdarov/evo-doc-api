#  Приложение evo-doc-api v0.0.1
## Приложение и API товарного учета

автор: majdarov@gmail.com

##  Сущности

### Документы

- **Document**:
    - *id* `uuid`
    - *doc_num* `string`
    - *doc_date* `\DateTimeImmutable`
    - *seller* `App\Entity\Contragent`
    - *receiver* `App\Entity\Contragent`
    - *products* array(`App\Entity\DocProd`)
        - product_id `uuid`
        - price `float`
        - amount `float`

- **DocProd**:
    - *document_id* `uuid`
    - *product_id* `uuid`
    - *price* `float`
    - *amount* `float`

## Тесты


## Автотесты размещены в папке:

***Good luke!***
