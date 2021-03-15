<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210315171230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE change_request ADD package_id INT NOT NULL');
        $this->addSql('ALTER TABLE change_request ADD CONSTRAINT FK_CB902D36F44CABFF FOREIGN KEY (package_id) REFERENCES package (id)');
        $this->addSql('CREATE INDEX IDX_CB902D36F44CABFF ON change_request (package_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE change_request DROP FOREIGN KEY FK_CB902D36F44CABFF');
        $this->addSql('DROP INDEX IDX_CB902D36F44CABFF ON change_request');
        $this->addSql('ALTER TABLE change_request DROP package_id');
    }
}
