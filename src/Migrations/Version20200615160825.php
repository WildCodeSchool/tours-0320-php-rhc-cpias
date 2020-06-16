<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615160825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement_esin ADD code_micro_organisme1 INT NOT NULL, ADD code_micro_organisme2 INT NOT NULL, ADD code_micro_organisme3 INT NOT NULL, ADD code_site_un INT NOT NULL, ADD code_site_deux INT NOT NULL, ADD code_site_trois INT NOT NULL, DROP code_micro_organisme, DROP code_site, DROP investigation, DROP justification, DROP hypothese_cause, DROP praticien_hygiene, CHANGE caractere_nosocomial caractere_nosocomial INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement_esin ADD code_micro_organisme INT NOT NULL, ADD code_site INT NOT NULL, ADD investigation LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD justification LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD hypothese_cause LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD praticien_hygiene LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP code_micro_organisme1, DROP code_micro_organisme2, DROP code_micro_organisme3, DROP code_site_un, DROP code_site_deux, DROP code_site_trois, CHANGE caractere_nosocomial caractere_nosocomial TINYINT(1) NOT NULL');
    }
}
