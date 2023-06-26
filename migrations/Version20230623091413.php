<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230623091413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE times CHANGE open_am open_am DATETIME NOT NULL, CHANGE close_am close_am DATETIME NOT NULL, CHANGE open_pm open_pm DATETIME NOT NULL, CHANGE close_pm close_pm DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE times CHANGE open_am open_am VARCHAR(10) NOT NULL, CHANGE close_am close_am VARCHAR(10) NOT NULL, CHANGE open_pm open_pm VARCHAR(10) NOT NULL, CHANGE close_pm close_pm VARCHAR(10) NOT NULL');
    }
}
