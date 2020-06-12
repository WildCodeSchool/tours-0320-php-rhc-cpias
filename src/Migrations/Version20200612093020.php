<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612093020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE signalement_esin ADD date_derniere_modif DATE NOT NULL, ADD code_finess_etab INT NOT NULL, ADD episode_precedent DATE NOT NULL, ADD envoi_au_cnr TINYINT(1) NOT NULL, ADD nb_cas INT NOT NULL, ADD caractere_nosocomial TINYINT(1) NOT NULL, ADD origine_cas_importes INT NOT NULL, ADD etab_concernes INT NOT NULL, ADD hypothese_cause LONGTEXT DEFAULT NULL, ADD praticien_hygiene LONGTEXT DEFAULT NULL, DROP date_de_dernière_modification, DROP code_finess_etablissement, DROP episode_précédent, DROP envoyé_au_cnr, DROP n_cas_0, DROP caractère_nosocomial, DROP origine_cas_importés, DROP autres_etablissements_concernés, DROP hypothèse_cause, DROP praticien_hygiène, CHANGE epidemie_cas_groupés epidemie_cas_groupes LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE finess ADD coordinates VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE finess DROP coordinates');
        $this->addSql('ALTER TABLE signalement_esin ADD date_de_dernière_modification DATE NOT NULL, ADD code_finess_etablissement INT NOT NULL, ADD episode_précédent DATE NOT NULL, ADD envoyé_au_cnr TINYINT(1) NOT NULL, ADD n_cas_0 INT NOT NULL, ADD caractère_nosocomial TINYINT(1) NOT NULL, ADD origine_cas_importés INT NOT NULL, ADD autres_etablissements_concernés INT NOT NULL, ADD hypothèse_cause LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD praticien_hygiène LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP date_derniere_modif, DROP code_finess_etab, DROP episode_precedent, DROP envoi_au_cnr, DROP nb_cas, DROP caractere_nosocomial, DROP origine_cas_importes, DROP etab_concernes, DROP hypothese_cause, DROP praticien_hygiene, CHANGE epidemie_cas_groupes epidemie_cas_groupés LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
