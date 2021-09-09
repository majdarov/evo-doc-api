<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210909100821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE evo_document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE evo_document (id INT NOT NULL, cnt_seller_id INT NOT NULL, cnt_receiver_id INT NOT NULL, doc_num VARCHAR(255) DEFAULT NULL, doc_date DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EDFFC182102B87C7 ON evo_document (cnt_seller_id)');
        $this->addSql('CREATE INDEX IDX_EDFFC18251A079E1 ON evo_document (cnt_receiver_id)');
        $this->addSql('ALTER TABLE evo_document ADD CONSTRAINT FK_EDFFC182102B87C7 FOREIGN KEY (cnt_seller_id) REFERENCES contragent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evo_document ADD CONSTRAINT FK_EDFFC18251A079E1 FOREIGN KEY (cnt_receiver_id) REFERENCES contragent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE evo_document_id_seq CASCADE');
        $this->addSql('DROP TABLE evo_document');
    }
}
