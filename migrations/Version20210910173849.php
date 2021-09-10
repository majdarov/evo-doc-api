<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910173849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
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
        $this->addSql('CREATE TABLE product (id UUID NOT NULL, product_name VARCHAR(255) NOT NULL, code INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE contragent ADD CONSTRAINT FK_2185188B14F65548 FOREIGN KEY (cnt_type_id) REFERENCES contragent_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evo_document ADD CONSTRAINT FK_EDFFC182102B87C7 FOREIGN KEY (cnt_seller_id) REFERENCES contragent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evo_document ADD CONSTRAINT FK_EDFFC18251A079E1 FOREIGN KEY (cnt_receiver_id) REFERENCES contragent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE evo_document DROP CONSTRAINT FK_EDFFC182102B87C7');
        $this->addSql('ALTER TABLE evo_document DROP CONSTRAINT FK_EDFFC18251A079E1');
        $this->addSql('ALTER TABLE contragent DROP CONSTRAINT FK_2185188B14F65548');
        $this->addSql('DROP TABLE contragent');
        $this->addSql('DROP TABLE contragent_type');
        $this->addSql('DROP TABLE evo_document');
        $this->addSql('DROP TABLE product');
    }
}
