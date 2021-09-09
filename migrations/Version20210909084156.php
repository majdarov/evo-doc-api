<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909084156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contragent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contragent_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contragent (id INT NOT NULL, cnt_type_id INT DEFAULT NULL, cnt_name VARCHAR(255) NOT NULL, cnt_info VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2185188B14F65548 ON contragent (cnt_type_id)');
        $this->addSql('CREATE TABLE contragent_type (id INT NOT NULL, cnt_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE contragent ADD CONSTRAINT FK_2185188B14F65548 FOREIGN KEY (cnt_type_id) REFERENCES contragent_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE contragent DROP CONSTRAINT FK_2185188B14F65548');
        $this->addSql('DROP SEQUENCE contragent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contragent_type_id_seq CASCADE');
        $this->addSql('DROP TABLE contragent');
        $this->addSql('DROP TABLE contragent_type');
    }
}
