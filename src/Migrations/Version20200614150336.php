<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200614150336 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE strain (id INT AUTO_INCREMENT NOT NULL, creno VARCHAR(255) NOT NULL, date_prelevement DATE NOT NULL, type_prelevement VARCHAR(255) NOT NULL, micro_organisme VARCHAR(255) NOT NULL, resistance VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esin_suite (id INT AUTO_INCREMENT NOT NULL, investigation LONGTEXT DEFAULT NULL, hypothese_cause LONGTEXT DEFAULT NULL, justification LONGTEXT DEFAULT NULL, praticien_hygiene LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE signalement_esin ADD date_derniere_modif DATE NOT NULL, ADD code_finess_etab INT NOT NULL, ADD episode_precedent DATE NOT NULL, ADD envoi_au_cnr TINYINT(1) NOT NULL, ADD nb_cas INT NOT NULL, ADD caractere_nosocomial INT DEFAULT NULL, ADD origine_cas_importes INT NOT NULL, ADD etab_concernes INT NOT NULL, ADD code_micro_organisme1 INT NOT NULL, ADD code_micro_organisme2 INT NOT NULL, ADD code_micro_organisme3 INT NOT NULL, ADD code_site_un INT NOT NULL, ADD code_site_deux INT NOT NULL, ADD code_site_trois INT NOT NULL, DROP date_de_dernière_modification, DROP code_finess_etablissement, DROP episode_précédent, DROP envoyé_au_cnr, DROP n_cas_0, DROP caractère_nosocomial, DROP origine_cas_importés, DROP autres_etablissements_concernés, DROP code_micro_organisme, DROP code_site, DROP investigation, DROP hypothèse_cause, DROP justification, DROP praticien_hygiène, CHANGE epidemie_cas_groupés epidemie_cas_groupes LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE strain');
        $this->addSql('DROP TABLE esin_suite');
        $this->addSql('ALTER TABLE signalement_esin ADD date_de_dernière_modification DATE NOT NULL, ADD code_finess_etablissement INT NOT NULL, ADD episode_précédent DATE NOT NULL, ADD n_cas_0 INT NOT NULL, ADD caractère_nosocomial TINYINT(1) NOT NULL, ADD origine_cas_importés INT NOT NULL, ADD autres_etablissements_concernés INT NOT NULL, ADD code_micro_organisme INT NOT NULL, ADD code_site INT NOT NULL, ADD investigation LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD hypothèse_cause LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD justification LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD praticien_hygiène LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP date_derniere_modif, DROP code_finess_etab, DROP episode_precedent, DROP nb_cas, DROP caractere_nosocomial, DROP origine_cas_importes, DROP etab_concernes, DROP code_micro_organisme1, DROP code_micro_organisme2, DROP code_micro_organisme3, DROP code_site_un, DROP code_site_deux, DROP code_site_trois, CHANGE envoi_au_cnr envoyé_au_cnr TINYINT(1) NOT NULL, CHANGE epidemie_cas_groupes epidemie_cas_groupés LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
