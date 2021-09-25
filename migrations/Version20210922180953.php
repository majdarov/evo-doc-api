<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210922180953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE barcode_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE barcode (id INT NOT NULL, product_id UUID NOT NULL, barcode VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97AE02664584665A ON barcode (product_id)');
        $this->addSql('COMMENT ON COLUMN barcode.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE product_group (id UUID NOT NULL, parent_id UUID DEFAULT NULL, name VARCHAR(128) NOT NULL, barcodes TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product_group.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN product_group.parent_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN product_group.barcodes IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE barcode ADD CONSTRAINT FK_97AE02664584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD parent_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD product_type VARCHAR(128)');
        $this->addSql("UPDATE product SET product_type = 'NORMAL'");
        $this->addSql('ALTER TABLE product ALTER COLUMN product_type SET NOT NULL');
        $this->addSql('ALTER TABLE product ADD price DOUBLE PRECISION'); //not null
        $this->addSql('ALTER TABLE product ADD allow_to_sell BOOLEAN'); //not null
        $this->addSql('ALTER TABLE product ADD description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD article_number VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD cost_price DOUBLE PRECISION'); //not null
        $this->addSql('ALTER TABLE product ADD quantity DOUBLE PRECISION'); //not null
        $this->addSql("UPDATE product SET price = 0.01, allow_to_sell = true, cost_price = 0.01, quantity = 0");
        $this->addSql('ALTER TABLE product ALTER COLUMN price SET NOT NULL');
        $this->addSql('ALTER TABLE product ALTER COLUMN allow_to_sell SET NOT NULL');
        $this->addSql('ALTER TABLE product ALTER COLUMN cost_price SET NOT NULL');
        $this->addSql('ALTER TABLE product ALTER COLUMN quantity SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN product.parent_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB3750AF4 FOREIGN KEY (parent_id) REFERENCES product_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04ADB3750AF4 ON product (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADB3750AF4');
        $this->addSql('DROP SEQUENCE barcode_id_seq CASCADE');
        $this->addSql('DROP TABLE barcode');
        $this->addSql('DROP TABLE product_group');
        $this->addSql('DROP INDEX IDX_D34A04ADB3750AF4');
        $this->addSql('ALTER TABLE product DROP parent_id');
        $this->addSql('ALTER TABLE product DROP product_type');
        $this->addSql('ALTER TABLE product DROP price');
        $this->addSql('ALTER TABLE product DROP allow_to_sell');
        $this->addSql('ALTER TABLE product DROP description');
        $this->addSql('ALTER TABLE product DROP article_number');
        $this->addSql('ALTER TABLE product DROP cost_price');
        $this->addSql('ALTER TABLE product DROP quantity');
    }
}
