<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210411040307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quan_feature_value_quan_possible_values (quan_feature_value_id INT NOT NULL, quan_possible_values_id INT NOT NULL, INDEX IDX_11362D12B030E7DE (quan_feature_value_id), INDEX IDX_11362D1234C295C3 (quan_possible_values_id), PRIMARY KEY(quan_feature_value_id, quan_possible_values_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quan_feature_value_quan_possible_values ADD CONSTRAINT FK_11362D12B030E7DE FOREIGN KEY (quan_feature_value_id) REFERENCES quan_feature_value (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quan_feature_value_quan_possible_values ADD CONSTRAINT FK_11362D1234C295C3 FOREIGN KEY (quan_possible_values_id) REFERENCES quan_possible_values (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE count_feature_value ADD min DOUBLE PRECISION NOT NULL, ADD max DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quan_feature_value_quan_possible_values');
        $this->addSql('ALTER TABLE count_feature_value DROP min, DROP max');
    }
}
