<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231122102321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE times DROP FOREIGN KEY FK_1DD7EE8CBEDD5CD7');
        $this->addSql('DROP TABLE workshops');
        $this->addSql('DROP INDEX IDX_1DD7EE8CBEDD5CD7 ON times');
        $this->addSql('ALTER TABLE times DROP workshops_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE workshops (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, zipcode VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE times ADD workshops_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE times ADD CONSTRAINT FK_1DD7EE8CBEDD5CD7 FOREIGN KEY (workshops_id) REFERENCES workshops (id)');
        $this->addSql('CREATE INDEX IDX_1DD7EE8CBEDD5CD7 ON times (workshops_id)');
    }
}
