<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919074946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accessoires (id INT AUTO_INCREMENT NOT NULL, article_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_B661BA4F289EC824 (article_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crampons (id INT AUTO_INCREMENT NOT NULL, article_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_F87D9C1E289EC824 (article_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE epauliere (id INT AUTO_INCREMENT NOT NULL, article_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, price INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_5EA23F5B289EC824 (article_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE accessoires ADD CONSTRAINT FK_B661BA4F289EC824 FOREIGN KEY (article_type_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE crampons ADD CONSTRAINT FK_F87D9C1E289EC824 FOREIGN KEY (article_type_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE epauliere ADD CONSTRAINT FK_5EA23F5B289EC824 FOREIGN KEY (article_type_id) REFERENCES articles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE accessoires DROP FOREIGN KEY FK_B661BA4F289EC824');
        $this->addSql('ALTER TABLE crampons DROP FOREIGN KEY FK_F87D9C1E289EC824');
        $this->addSql('ALTER TABLE epauliere DROP FOREIGN KEY FK_5EA23F5B289EC824');
        $this->addSql('DROP TABLE accessoires');
        $this->addSql('DROP TABLE crampons');
        $this->addSql('DROP TABLE epauliere');
    }
}
