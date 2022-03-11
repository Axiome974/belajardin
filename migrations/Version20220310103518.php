<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220310103518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE about_section_icon_section (about_section_id INT NOT NULL, icon_section_id INT NOT NULL, INDEX IDX_3A54743C1B1B4F1C (about_section_id), INDEX IDX_3A54743C2B2CE90A (icon_section_id), PRIMARY KEY(about_section_id, icon_section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE icon_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about_section_icon_section ADD CONSTRAINT FK_3A54743C1B1B4F1C FOREIGN KEY (about_section_id) REFERENCES about_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE about_section_icon_section ADD CONSTRAINT FK_3A54743C2B2CE90A FOREIGN KEY (icon_section_id) REFERENCES icon_section (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about_section_icon_section DROP FOREIGN KEY FK_3A54743C1B1B4F1C');
        $this->addSql('ALTER TABLE about_section_icon_section DROP FOREIGN KEY FK_3A54743C2B2CE90A');
        $this->addSql('DROP TABLE about_section');
        $this->addSql('DROP TABLE about_section_icon_section');
        $this->addSql('DROP TABLE icon_section');
    }
}
