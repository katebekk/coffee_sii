<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330043829 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee ADD growth_height_min INT NOT NULL, ADD growth_height_max INT NOT NULL, ADD rainfall_min INT NOT NULL, ADD rainfall_max INT NOT NULL, ADD growing_temperature_min INT NOT NULL, ADD growing_temperature_max INT NOT NULL, ADD average_height_coffee_tree_min INT NOT NULL, ADD average_height_coffee_tree_max INT NOT NULL, ADD grain_size_min DOUBLE PRECISION NOT NULL, ADD grain_size_max DOUBLE PRECISION NOT NULL, ADD average_price_per_kilogram_min INT NOT NULL, ADD average_price_per_kilogram_max INT NOT NULL, ADD evaluation_cqlmin INT NOT NULL, ADD evaluation_cqlmax INT NOT NULL, ADD caffeine_content_min DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee DROP growth_height_min, DROP growth_height_max, DROP rainfall_min, DROP rainfall_max, DROP growing_temperature_min, DROP growing_temperature_max, DROP average_height_coffee_tree_min, DROP average_height_coffee_tree_max, DROP grain_size_min, DROP grain_size_max, DROP average_price_per_kilogram_min, DROP average_price_per_kilogram_max, DROP evaluation_cqlmin, DROP evaluation_cqlmax, DROP caffeine_content_min');
    }
}
