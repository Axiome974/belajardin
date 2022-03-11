<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310105248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about_section ADD file_id INT NOT NULL');
        $this->addSql('ALTER TABLE about_section ADD CONSTRAINT FK_5A624DCE93CB796C FOREIGN KEY (file_id) REFERENCES file_uploaded (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A624DCE93CB796C ON about_section (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about_section DROP FOREIGN KEY FK_5A624DCE93CB796C');
        $this->addSql('DROP INDEX UNIQ_5A624DCE93CB796C ON about_section');
        $this->addSql('ALTER TABLE about_section DROP file_id');
    }
}
