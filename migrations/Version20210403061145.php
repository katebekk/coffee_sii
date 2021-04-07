<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403061145 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coffee_class (id INT AUTO_INCREMENT NOT NULL, class VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE countbl_feature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, min DOUBLE PRECISION NOT NULL, max DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quan_feature (id INT AUTO_INCREMENT NOT NULL, coffee_class_id INT NOT NULL, name VARCHAR(255) NOT NULL, possible_values LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_EF768B4F3247459 (coffee_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quan_feature ADD CONSTRAINT FK_EF768B4F3247459 FOREIGN KEY (coffee_class_id) REFERENCES coffee_class (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quan_feature DROP FOREIGN KEY FK_EF768B4F3247459');
        $this->addSql('DROP TABLE coffee_class');
        $this->addSql('DROP TABLE countbl_feature');
        $this->addSql('DROP TABLE quan_feature');
    }
}
