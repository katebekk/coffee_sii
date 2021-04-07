<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403100010 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE count_feature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE count_feature_coffee_sort (count_feature_id INT NOT NULL, coffee_sort_id INT NOT NULL, INDEX IDX_9995E0593F39BCFE (count_feature_id), INDEX IDX_9995E059DB4C07 (coffee_sort_id), PRIMARY KEY(count_feature_id, coffee_sort_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE count_feature_value (id INT AUTO_INCREMENT NOT NULL, coffee_sort_id INT NOT NULL, feature_id INT NOT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_AC5D340ADB4C07 (coffee_sort_id), INDEX IDX_AC5D340A60E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE count_possible_values (id INT AUTO_INCREMENT NOT NULL, feature_id INT NOT NULL, min DOUBLE PRECISION NOT NULL, max DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_E9D5697360E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quan_feature (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quan_feature_coffee_sort (quan_feature_id INT NOT NULL, coffee_sort_id INT NOT NULL, INDEX IDX_A66654F47C969AAB (quan_feature_id), INDEX IDX_A66654F4DB4C07 (coffee_sort_id), PRIMARY KEY(quan_feature_id, coffee_sort_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quan_feature_value (id INT AUTO_INCREMENT NOT NULL, coffee_sort_id INT NOT NULL, feature_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_439DE54FDB4C07 (coffee_sort_id), INDEX IDX_439DE54F60E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quan_possible_values (id INT AUTO_INCREMENT NOT NULL, feature_id INT NOT NULL, possible_values LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_950FDFB160E4B879 (feature_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE count_feature_coffee_sort ADD CONSTRAINT FK_9995E0593F39BCFE FOREIGN KEY (count_feature_id) REFERENCES count_feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE count_feature_coffee_sort ADD CONSTRAINT FK_9995E059DB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE count_feature_value ADD CONSTRAINT FK_AC5D340ADB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id)');
        $this->addSql('ALTER TABLE count_feature_value ADD CONSTRAINT FK_AC5D340A60E4B879 FOREIGN KEY (feature_id) REFERENCES count_feature (id)');
        $this->addSql('ALTER TABLE count_possible_values ADD CONSTRAINT FK_E9D5697360E4B879 FOREIGN KEY (feature_id) REFERENCES count_feature (id)');
        $this->addSql('ALTER TABLE quan_feature_coffee_sort ADD CONSTRAINT FK_A66654F47C969AAB FOREIGN KEY (quan_feature_id) REFERENCES quan_feature (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quan_feature_coffee_sort ADD CONSTRAINT FK_A66654F4DB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quan_feature_value ADD CONSTRAINT FK_439DE54FDB4C07 FOREIGN KEY (coffee_sort_id) REFERENCES coffee_sort (id)');
        $this->addSql('ALTER TABLE quan_feature_value ADD CONSTRAINT FK_439DE54F60E4B879 FOREIGN KEY (feature_id) REFERENCES quan_feature (id)');
        $this->addSql('ALTER TABLE quan_possible_values ADD CONSTRAINT FK_950FDFB160E4B879 FOREIGN KEY (feature_id) REFERENCES quan_feature (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE count_feature_coffee_sort DROP FOREIGN KEY FK_9995E0593F39BCFE');
        $this->addSql('ALTER TABLE count_feature_value DROP FOREIGN KEY FK_AC5D340A60E4B879');
        $this->addSql('ALTER TABLE count_possible_values DROP FOREIGN KEY FK_E9D5697360E4B879');
        $this->addSql('ALTER TABLE quan_feature_coffee_sort DROP FOREIGN KEY FK_A66654F47C969AAB');
        $this->addSql('ALTER TABLE quan_feature_value DROP FOREIGN KEY FK_439DE54F60E4B879');
        $this->addSql('ALTER TABLE quan_possible_values DROP FOREIGN KEY FK_950FDFB160E4B879');
        $this->addSql('DROP TABLE count_feature');
        $this->addSql('DROP TABLE count_feature_coffee_sort');
        $this->addSql('DROP TABLE count_feature_value');
        $this->addSql('DROP TABLE count_possible_values');
        $this->addSql('DROP TABLE quan_feature');
        $this->addSql('DROP TABLE quan_feature_coffee_sort');
        $this->addSql('DROP TABLE quan_feature_value');
        $this->addSql('DROP TABLE quan_possible_values');
    }
}
