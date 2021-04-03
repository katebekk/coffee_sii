<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329060805 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coffee (id INT AUTO_INCREMENT NOT NULL, region_of_origin VARCHAR(100) NOT NULL, growth_height INT NOT NULL, climatic_zone VARCHAR(255) NOT NULL, rainfall INT NOT NULL, average_growing_temperature INT NOT NULL, average_height_coffee_tree INT NOT NULL, grain_size DOUBLE PRECISION NOT NULL, kind_of_coffee_tree VARCHAR(255) NOT NULL, average_price_per_kilogram INT NOT NULL, evaluation_cql INT NOT NULL, caffeine_content DOUBLE PRECISION NOT NULL, method_of_processing_coffee VARCHAR(255) NOT NULL, density INT NOT NULL, kislotnost VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coffee');
    }
}
