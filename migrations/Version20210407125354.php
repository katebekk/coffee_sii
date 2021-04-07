<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407125354 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coffee_sort_quan_feature (coffee_sort_id INT NOT NULL, quan_feature_id INT NOT NULL, INDEX IDX_A3D21755DB4C07 (coffee_sort_id), INDEX IDX_A3D217557C969AAB (quan_feature_id), PRIMARY KEY(coffee_sort_id, quan_feature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coffee_sort_count_feature (coffee_sort_id INT NOT NULL, count_feature_id INT NOT NULL, INDEX IDX_F80C4D54DB4C07 (coffee_sort_id), INDEX IDX_F80C4D543F39BCFE (count_feature_id), PRIMARY KEY(coffee_sort_id, count_feature_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coffee_sort_quan_feature ADD CONSTRAINT FK_A3D21755DB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_sort_quan_feature ADD CONSTRAINT FK_A3D217557C969AAB FOREIGN KEY (quan_feature_id) REFERENCES quan_feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_sort_count_feature ADD CONSTRAINT FK_F80C4D54DB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coffee_sort_count_feature ADD CONSTRAINT FK_F80C4D543F39BCFE FOREIGN KEY (count_feature_id) REFERENCES count_feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quan_possible_values DROP FOREIGN KEY FK_950FDFB160E4B879');
        $this->addSql('DROP INDEX UNIQ_950FDFB160E4B879 ON quan_possible_values');
        $this->addSql('ALTER TABLE quan_possible_values DROP feature_id, DROP possible_values');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coffee_sort_quan_feature');
        $this->addSql('DROP TABLE coffee_sort_count_feature');
        $this->addSql('ALTER TABLE quan_possible_values ADD feature_id INT NOT NULL, ADD possible_values LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE quan_possible_values ADD CONSTRAINT FK_950FDFB160E4B879 FOREIGN KEY (feature_id) REFERENCES quan_feature (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_950FDFB160E4B879 ON quan_possible_values (feature_id)');
    }
}
