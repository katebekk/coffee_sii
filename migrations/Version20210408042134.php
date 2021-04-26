<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408042134 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quan_possible_values ADD feature_id INT NOT NULL');
        $this->addSql('ALTER TABLE quan_possible_values ADD CONSTRAINT FK_950FDFB160E4B879 FOREIGN KEY (feature_id) REFERENCES quan_feature (id)');
        $this->addSql('CREATE INDEX IDX_950FDFB160E4B879 ON quan_possible_values (feature_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quan_possible_values DROP FOREIGN KEY FK_950FDFB160E4B879');
        $this->addSql('DROP INDEX IDX_950FDFB160E4B879 ON quan_possible_values');
        $this->addSql('ALTER TABLE quan_possible_values DROP feature_id');
    }
}
