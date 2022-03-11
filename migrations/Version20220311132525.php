<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220311132525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_section_icon_section (service_section_id INT NOT NULL, icon_section_id INT NOT NULL, INDEX IDX_5FFB51B94E72DACE (service_section_id), INDEX IDX_5FFB51B92B2CE90A (icon_section_id), PRIMARY KEY(service_section_id, icon_section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service_section_icon_section ADD CONSTRAINT FK_5FFB51B94E72DACE FOREIGN KEY (service_section_id) REFERENCES service_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_section_icon_section ADD CONSTRAINT FK_5FFB51B92B2CE90A FOREIGN KEY (icon_section_id) REFERENCES icon_section (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_section_icon_section DROP FOREIGN KEY FK_5FFB51B94E72DACE');
        $this->addSql('DROP TABLE service_section');
        $this->addSql('DROP TABLE service_section_icon_section');
    }
}
