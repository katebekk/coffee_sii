<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330035735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee ADD region_of_origin_id INT NOT NULL');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3717C435 FOREIGN KEY (region_of_origin_id) REFERENCES region_of_origin (id)');
        $this->addSql('CREATE INDEX IDX_538529B3717C435 ON coffee (region_of_origin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B3717C435');
        $this->addSql('DROP INDEX IDX_538529B3717C435 ON coffee');
        $this->addSql('ALTER TABLE coffee DROP region_of_origin_id');
    }
}
