<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031063336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE about_section (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_5A624DCE93CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE about_section_icon_section (about_section_id INT NOT NULL, icon_section_id INT NOT NULL, INDEX IDX_3A54743C1B1B4F1C (about_section_id), INDEX IDX_3A54743C2B2CE90A (icon_section_id), PRIMARY KEY(about_section_id, icon_section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diapositive (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, position INT NOT NULL, is_visible TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_C2BCA50793CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_uploaded (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, filepath VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE icon_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_picture (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, subtitle VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_406E604793CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio_section_portfolio_picture (portfolio_section_id INT NOT NULL, portfolio_picture_id INT NOT NULL, INDEX IDX_79DCC6CBEA052708 (portfolio_section_id), INDEX IDX_79DCC6CBDC6379CD (portfolio_picture_id), PRIMARY KEY(portfolio_section_id, portfolio_picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_section_icon_section (service_section_id INT NOT NULL, icon_section_id INT NOT NULL, INDEX IDX_5FFB51B94E72DACE (service_section_id), INDEX IDX_5FFB51B92B2CE90A (icon_section_id), PRIMARY KEY(service_section_id, icon_section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE about_section ADD CONSTRAINT FK_5A624DCE93CB796C FOREIGN KEY (file_id) REFERENCES file_uploaded (id)');
        $this->addSql('ALTER TABLE about_section_icon_section ADD CONSTRAINT FK_3A54743C1B1B4F1C FOREIGN KEY (about_section_id) REFERENCES about_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE about_section_icon_section ADD CONSTRAINT FK_3A54743C2B2CE90A FOREIGN KEY (icon_section_id) REFERENCES icon_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diapositive ADD CONSTRAINT FK_C2BCA50793CB796C FOREIGN KEY (file_id) REFERENCES file_uploaded (id)');
        $this->addSql('ALTER TABLE portfolio_picture ADD CONSTRAINT FK_406E604793CB796C FOREIGN KEY (file_id) REFERENCES file_uploaded (id)');
        $this->addSql('ALTER TABLE portfolio_section_portfolio_picture ADD CONSTRAINT FK_79DCC6CBEA052708 FOREIGN KEY (portfolio_section_id) REFERENCES portfolio_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portfolio_section_portfolio_picture ADD CONSTRAINT FK_79DCC6CBDC6379CD FOREIGN KEY (portfolio_picture_id) REFERENCES portfolio_picture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_section_icon_section ADD CONSTRAINT FK_5FFB51B94E72DACE FOREIGN KEY (service_section_id) REFERENCES service_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_section_icon_section ADD CONSTRAINT FK_5FFB51B92B2CE90A FOREIGN KEY (icon_section_id) REFERENCES icon_section (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE about_section_icon_section DROP FOREIGN KEY FK_3A54743C1B1B4F1C');
        $this->addSql('ALTER TABLE about_section DROP FOREIGN KEY FK_5A624DCE93CB796C');
        $this->addSql('ALTER TABLE diapositive DROP FOREIGN KEY FK_C2BCA50793CB796C');
        $this->addSql('ALTER TABLE portfolio_picture DROP FOREIGN KEY FK_406E604793CB796C');
        $this->addSql('ALTER TABLE about_section_icon_section DROP FOREIGN KEY FK_3A54743C2B2CE90A');
        $this->addSql('ALTER TABLE service_section_icon_section DROP FOREIGN KEY FK_5FFB51B92B2CE90A');
        $this->addSql('ALTER TABLE portfolio_section_portfolio_picture DROP FOREIGN KEY FK_79DCC6CBDC6379CD');
        $this->addSql('ALTER TABLE portfolio_section_portfolio_picture DROP FOREIGN KEY FK_79DCC6CBEA052708');
        $this->addSql('ALTER TABLE service_section_icon_section DROP FOREIGN KEY FK_5FFB51B94E72DACE');
        $this->addSql('DROP TABLE about_section');
        $this->addSql('DROP TABLE about_section_icon_section');
        $this->addSql('DROP TABLE diapositive');
        $this->addSql('DROP TABLE file_uploaded');
        $this->addSql('DROP TABLE icon_section');
        $this->addSql('DROP TABLE portfolio_picture');
        $this->addSql('DROP TABLE portfolio_section');
        $this->addSql('DROP TABLE portfolio_section_portfolio_picture');
        $this->addSql('DROP TABLE service_section');
        $this->addSql('DROP TABLE service_section_icon_section');
        $this->addSql('DROP TABLE user');
    }
}
