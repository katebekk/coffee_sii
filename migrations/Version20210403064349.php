<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403064349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B3ABFBC61C');
        $this->addSql('ALTER TABLE countbl_feature DROP FOREIGN KEY FK_1762ABDD3247459');
        $this->addSql('ALTER TABLE quan_feature DROP FOREIGN KEY FK_EF768B4F3247459');
        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B3D5659DCD');
        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B3717C435');
        $this->addSql('DROP TABLE climatic_zone');
        $this->addSql('DROP TABLE coffee');
        $this->addSql('DROP TABLE coffee_class');
        $this->addSql('DROP TABLE countbl_feature');
        $this->addSql('DROP TABLE method_of_processing_coffee');
        $this->addSql('DROP TABLE quan_feature');
        $this->addSql('DROP TABLE region_of_origin');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE climatic_zone (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coffee (id INT AUTO_INCREMENT NOT NULL, region_of_origin_id INT NOT NULL, climatic_zone_id INT NOT NULL, method_of_processing_id INT NOT NULL, growth_height INT NOT NULL, rainfall INT NOT NULL, average_growing_temperature INT NOT NULL, average_height_coffee_tree INT NOT NULL, grain_size DOUBLE PRECISION NOT NULL, kind_of_coffee_tree VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, average_price_per_kilogram INT NOT NULL, evaluation_cql INT NOT NULL, caffeine_content DOUBLE PRECISION NOT NULL, density INT NOT NULL, kislotnost INT NOT NULL, growth_height_min INT NOT NULL, growth_height_max INT NOT NULL, rainfall_min INT NOT NULL, rainfall_max INT NOT NULL, growing_temperature_min INT NOT NULL, growing_temperature_max INT NOT NULL, average_height_coffee_tree_min INT NOT NULL, average_height_coffee_tree_max INT NOT NULL, grain_size_min DOUBLE PRECISION NOT NULL, grain_size_max DOUBLE PRECISION NOT NULL, average_price_per_kilogram_min INT NOT NULL, average_price_per_kilogram_max INT NOT NULL, evaluation_cqlmin INT NOT NULL, evaluation_cqlmax INT NOT NULL, caffeine_content_min DOUBLE PRECISION NOT NULL, class VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_538529B3717C435 (region_of_origin_id), INDEX IDX_538529B3ABFBC61C (climatic_zone_id), INDEX IDX_538529B3D5659DCD (method_of_processing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coffee_class (id INT AUTO_INCREMENT NOT NULL, class VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE countbl_feature (id INT AUTO_INCREMENT NOT NULL, coffee_class_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, min DOUBLE PRECISION NOT NULL, max DOUBLE PRECISION NOT NULL, INDEX IDX_1762ABDD3247459 (coffee_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE method_of_processing_coffee (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quan_feature (id INT AUTO_INCREMENT NOT NULL, coffee_class_id INT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, possible_values LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', INDEX IDX_EF768B4F3247459 (coffee_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE region_of_origin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3717C435 FOREIGN KEY (region_of_origin_id) REFERENCES region_of_origin (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3ABFBC61C FOREIGN KEY (climatic_zone_id) REFERENCES climatic_zone (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3D5659DCD FOREIGN KEY (method_of_processing_id) REFERENCES method_of_processing_coffee (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE countbl_feature ADD CONSTRAINT FK_1762ABDD3247459 FOREIGN KEY (coffee_class_id) REFERENCES coffee_class (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE quan_feature ADD CONSTRAINT FK_EF768B4F3247459 FOREIGN KEY (coffee_class_id) REFERENCES coffee_class (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
