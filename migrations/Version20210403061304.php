<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210403061304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE countbl_feature ADD coffee_class_id INT NOT NULL');
        $this->addSql('ALTER TABLE countbl_feature ADD CONSTRAINT FK_1762ABDD3247459 FOREIGN KEY (coffee_class_id) REFERENCES coffee_class (id)');
        $this->addSql('CREATE INDEX IDX_1762ABDD3247459 ON countbl_feature (coffee_class_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE countbl_feature DROP FOREIGN KEY FK_1762ABDD3247459');
        $this->addSql('DROP INDEX IDX_1762ABDD3247459 ON countbl_feature');
        $this->addSql('ALTER TABLE countbl_feature DROP coffee_class_id');
    }
}
