<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220309130204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diapositive ADD file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE diapositive ADD CONSTRAINT FK_C2BCA50793CB796C FOREIGN KEY (file_id) REFERENCES file_uploaded (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2BCA50793CB796C ON diapositive (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diapositive DROP FOREIGN KEY FK_C2BCA50793CB796C');
        $this->addSql('DROP INDEX UNIQ_C2BCA50793CB796C ON diapositive');
        $this->addSql('ALTER TABLE diapositive DROP file_id');
    }
}
