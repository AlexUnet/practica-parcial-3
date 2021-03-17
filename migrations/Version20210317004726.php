<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317004726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE package CHANGE cable_id cable_id INT DEFAULT NULL, CHANGE telephony_id telephony_id INT DEFAULT NULL, CHANGE internet_id internet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE chanel_id chanel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE package_id package_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE package CHANGE cable_id cable_id INT DEFAULT NULL, CHANGE telephony_id telephony_id INT DEFAULT NULL, CHANGE internet_id internet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE program CHANGE chanel_id chanel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE package_id package_id INT DEFAULT NULL');
    }
}
