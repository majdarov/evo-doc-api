<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211002192307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE product (id UUID NOT NULL, measure_name VARCHAR(10) NOT NULL, tax VARCHAR(255) NOT NULL, product_type VARCHAR(128) NOT NULL, price DOUBLE PRECISION NOT NULL, allow_to_sell BOOLEAN NOT NULL, description VARCHAR(255) DEFAULT NULL, article_number VARCHAR(255) DEFAULT NULL, cost_price DOUBLE PRECISION NOT NULL, quantity DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE contragent (id UUID NOT NULL, cnt_type_id UUID DEFAULT NULL, cnt_name VARCHAR(255) NOT NULL, cnt_info VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_2185188b14f65548 ON contragent (cnt_type_id)');
        $this->addSql('COMMENT ON COLUMN contragent.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN contragent.cnt_type_id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE prod_cat (id UUID NOT NULL, parent_id UUID DEFAULT NULL, instance_name VARCHAR(255) NOT NULL, code INT NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_d5e466b7727aca70 ON prod_cat (parent_id)');
        $this->addSql('COMMENT ON COLUMN prod_cat.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN prod_cat.parent_id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE barcode (barcode VARCHAR(255) NOT NULL, instance_id UUID NOT NULL, PRIMARY KEY(barcode, instance_id))');
        $this->addSql('CREATE INDEX idx_97ae02663a51721d ON barcode (instance_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_97ae026697ae0266 ON barcode (barcode)');
        $this->addSql('COMMENT ON COLUMN barcode.instance_id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE category (id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN category.id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE contragent_type (id UUID NOT NULL, cnt_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN contragent_type.id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE document (id UUID NOT NULL, cnt_seller_id UUID NOT NULL, cnt_receiver_id UUID NOT NULL, doc_num VARCHAR(255) DEFAULT NULL, doc_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_d8698a7651a079e1 ON document (cnt_receiver_id)');
        $this->addSql('CREATE INDEX idx_d8698a76102b87c7 ON document (cnt_seller_id)');
        $this->addSql('COMMENT ON COLUMN document.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN document.cnt_seller_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN document.cnt_receiver_id IS \'(DC2Type:uuid)\'');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE doc_prod (document_id UUID NOT NULL, product_id UUID NOT NULL, price DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(document_id, product_id))');
        $this->addSql('CREATE INDEX idx_ecaea6414584665a ON doc_prod (product_id)');
        $this->addSql('CREATE INDEX idx_ecaea641c33f7837 ON doc_prod (document_id)');
        $this->addSql('COMMENT ON COLUMN doc_prod.document_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN doc_prod.product_id IS \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE product');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE contragent');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE prod_cat');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE barcode');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE category');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE contragent_type');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE document');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE doc_prod');
    }
}
