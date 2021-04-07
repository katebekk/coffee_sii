<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406051441 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE count_feature_coffee_sort');
        $this->addSql('DROP TABLE quan_feature_coffee_sort');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE count_feature_coffee_sort (count_feature_id INT NOT NULL, coffee_sort_id INT NOT NULL, INDEX IDX_9995E0593F39BCFE (count_feature_id), INDEX IDX_9995E059DB4C07 (coffee_sort_id), PRIMARY KEY(count_feature_id, coffee_sort_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quan_feature_coffee_sort (quan_feature_id INT NOT NULL, coffee_sort_id INT NOT NULL, INDEX IDX_A66654F47C969AAB (quan_feature_id), INDEX IDX_A66654F4DB4C07 (coffee_sort_id), PRIMARY KEY(quan_feature_id, coffee_sort_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE count_feature_coffee_sort ADD CONSTRAINT FK_9995E0593F39BCFE FOREIGN KEY (count_feature_id) REFERENCES count_feature (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE count_feature_coffee_sort ADD CONSTRAINT FK_9995E059DB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quan_feature_coffee_sort ADD CONSTRAINT FK_A66654F47C969AAB FOREIGN KEY (quan_feature_id) REFERENCES quan_feature (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quan_feature_coffee_sort ADD CONSTRAINT FK_A66654F4DB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
