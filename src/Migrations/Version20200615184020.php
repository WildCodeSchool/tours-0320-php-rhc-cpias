<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615184020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE strain (id INT AUTO_INCREMENT NOT NULL, finess_id INT NOT NULL, creno VARCHAR(255) NOT NULL, date_prelevement DATE NOT NULL, type_prelevement VARCHAR(255) NOT NULL, micro_organisme VARCHAR(255) NOT NULL, resistance VARCHAR(255) NOT NULL, INDEX IDX_A630CD72DB9C770E (finess_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE strain ADD CONSTRAINT FK_A630CD72DB9C770E FOREIGN KEY (finess_id) REFERENCES finess (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE strain');
    }
}
