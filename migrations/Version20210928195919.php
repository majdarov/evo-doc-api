<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210928195919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE barcode (barcode VARCHAR(255) NOT NULL, instance_id UUID NOT NULL, PRIMARY KEY(barcode, instance_id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_97AE026697AE0266 ON barcode (barcode)');
        $this->addSql('CREATE INDEX IDX_97AE02663A51721D ON barcode (instance_id)');
        $this->addSql('COMMENT ON COLUMN barcode.instance_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE category (id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE contragent (id UUID NOT NULL, cnt_type_id UUID DEFAULT NULL, cnt_name VARCHAR(255) NOT NULL, cnt_info VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2185188B14F65548 ON contragent (cnt_type_id)');
        $this->addSql('COMMENT ON COLUMN contragent.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN contragent.cnt_type_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE contragent_type (id UUID NOT NULL, cnt_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN contragent_type.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE evo_document (id UUID NOT NULL, cnt_seller_id UUID NOT NULL, cnt_receiver_id UUID NOT NULL, doc_num VARCHAR(255) DEFAULT NULL, doc_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EDFFC182102B87C7 ON evo_document (cnt_seller_id)');
        $this->addSql('CREATE INDEX IDX_EDFFC18251A079E1 ON evo_document (cnt_receiver_id)');
        $this->addSql('COMMENT ON COLUMN evo_document.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN evo_document.cnt_seller_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN evo_document.cnt_receiver_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE prod_cat (id UUID NOT NULL, parent_id UUID DEFAULT NULL, instance_name VARCHAR(255) NOT NULL, code INT NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D5E466B7727ACA70 ON prod_cat (parent_id)');
        $this->addSql('COMMENT ON COLUMN prod_cat.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN prod_cat.parent_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, measure_name VARCHAR(10) NOT NULL, tax VARCHAR(255) NOT NULL, product_type VARCHAR(128) NOT NULL, price INT NOT NULL, allow_to_sell BOOLEAN NOT NULL, description VARCHAR(255) DEFAULT NULL, article_number VARCHAR(255) DEFAULT NULL, cost_price DOUBLE PRECISION NOT NULL, quantity DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE barcode ADD CONSTRAINT FK_97AE02663A51721D FOREIGN KEY (instance_id) REFERENCES prod_cat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1BF396750 FOREIGN KEY (id) REFERENCES prod_cat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE contragent ADD CONSTRAINT FK_2185188B14F65548 FOREIGN KEY (cnt_type_id) REFERENCES contragent_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evo_document ADD CONSTRAINT FK_EDFFC182102B87C7 FOREIGN KEY (cnt_seller_id) REFERENCES contragent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evo_document ADD CONSTRAINT FK_EDFFC18251A079E1 FOREIGN KEY (cnt_receiver_id) REFERENCES contragent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prod_cat ADD CONSTRAINT FK_D5E466B7727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBF396750 FOREIGN KEY (id) REFERENCES prod_cat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE prod_cat DROP CONSTRAINT FK_D5E466B7727ACA70');
        $this->addSql('ALTER TABLE evo_document DROP CONSTRAINT FK_EDFFC182102B87C7');
        $this->addSql('ALTER TABLE evo_document DROP CONSTRAINT FK_EDFFC18251A079E1');
        $this->addSql('ALTER TABLE contragent DROP CONSTRAINT FK_2185188B14F65548');
        $this->addSql('ALTER TABLE barcode DROP CONSTRAINT FK_97AE02663A51721D');
        $this->addSql('ALTER TABLE category DROP CONSTRAINT FK_64C19C1BF396750');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADBF396750');
        $this->addSql('DROP TABLE barcode');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE contragent');
        $this->addSql('DROP TABLE contragent_type');
        $this->addSql('DROP TABLE evo_document');
        $this->addSql('DROP TABLE prod_cat');
        $this->addSql('DROP TABLE product');
    }
}
