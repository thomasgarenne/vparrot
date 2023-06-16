<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230616134143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brands DROP FOREIGN KEY FK_7EA24434727ACA70');
        $this->addSql('ALTER TABLE brands ADD CONSTRAINT FK_7EA24434727ACA70 FOREIGN KEY (parent_id) REFERENCES brands (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE brands DROP FOREIGN KEY FK_7EA24434727ACA70');
        $this->addSql('ALTER TABLE brands ADD CONSTRAINT FK_7EA24434727ACA70 FOREIGN KEY (parent_id) REFERENCES brands (id)');
    }
}
