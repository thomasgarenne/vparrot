<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616142221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE times ADD open_am VARCHAR(10) NOT NULL, ADD close_am VARCHAR(10) NOT NULL, ADD open_pm VARCHAR(10) NOT NULL, ADD close_pm VARCHAR(10) NOT NULL, DROP am_open, DROP am_close, DROP pm_open, DROP pm_close');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE times ADD am_open TIME DEFAULT NULL, ADD am_close TIME DEFAULT NULL, ADD pm_open TIME DEFAULT NULL, ADD pm_close TIME DEFAULT NULL, DROP open_am, DROP close_am, DROP open_pm, DROP close_pm');
    }
}
