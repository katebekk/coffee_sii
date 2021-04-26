<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210424045936 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_52210B25E237E06 ON count_feature (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF768B4F5E237E06 ON quan_feature (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_950FDFB15E237E06 ON quan_possible_values (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_52210B25E237E06 ON count_feature');
        $this->addSql('DROP INDEX UNIQ_EF768B4F5E237E06 ON quan_feature');
        $this->addSql('DROP INDEX UNIQ_950FDFB15E237E06 ON quan_possible_values');
    }
}
