<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330040144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee ADD climatic_zone_id INT NOT NULL, ADD method_of_processing_id INT NOT NULL');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3ABFBC61C FOREIGN KEY (climatic_zone_id) REFERENCES climatic_zone (id)');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3D5659DCD FOREIGN KEY (method_of_processing_id) REFERENCES method_of_processing_coffee (id)');
        $this->addSql('CREATE INDEX IDX_538529B3ABFBC61C ON coffee (climatic_zone_id)');
        $this->addSql('CREATE INDEX IDX_538529B3D5659DCD ON coffee (method_of_processing_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B3ABFBC61C');
        $this->addSql('ALTER TABLE coffee DROP FOREIGN KEY FK_538529B3D5659DCD');
        $this->addSql('DROP INDEX IDX_538529B3ABFBC61C ON coffee');
        $this->addSql('DROP INDEX IDX_538529B3D5659DCD ON coffee');
        $this->addSql('ALTER TABLE coffee DROP climatic_zone_id, DROP method_of_processing_id');
    }
}
