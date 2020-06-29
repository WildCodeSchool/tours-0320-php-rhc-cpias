<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619135521 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE upload');
        $this->addSql('ALTER TABLE signalement_esin ADD code_micro_organisme1 INT NOT NULL, ADD code_micro_organisme2 INT NOT NULL, ADD code_micro_organisme3 INT NOT NULL, ADD code_site_un INT NOT NULL, ADD code_site_deux INT NOT NULL, ADD code_site_trois INT NOT NULL, DROP code_micro_organisme, DROP code_site, CHANGE caractere_nosocomial caractere_nosocomial INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE signalement_esin ADD code_micro_organisme INT NOT NULL, ADD code_site INT NOT NULL, DROP code_micro_organisme1, DROP code_micro_organisme2, DROP code_micro_organisme3, DROP code_site_un, DROP code_site_deux, DROP code_site_trois, CHANGE caractere_nosocomial caractere_nosocomial TINYINT(1) NOT NULL');
    }
}
