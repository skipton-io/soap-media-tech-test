<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410175518 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score_difficulties (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scores (id INT AUTO_INCREMENT NOT NULL, difficulty_id INT NOT NULL, user_id INT NOT NULL, score INT NOT NULL, INDEX IDX_750375EFCFA9DAE (difficulty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375EFCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES score_difficulties (id)');
        $this->addSql('CREATE INDEX IDX_750375EA76ED395 ON scores (user_id)');
        $this->addSql('INSERT INTO score_difficulties (`value`) VALUES ("Easy"), ("Moderate"), ("Difficult")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE scores DROP FOREIGN KEY FK_750375EFCFA9DAE');
        $this->addSql('DROP TABLE score_difficulties');
        $this->addSql('DROP TABLE scores');
    }
}
