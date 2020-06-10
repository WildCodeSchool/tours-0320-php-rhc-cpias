<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608141647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE signalement_esin (id INT AUTO_INCREMENT NOT NULL, identifiant_de_la_fiche INT NOT NULL, emission_de_la_fiche DATE NOT NULL, date_de_dernière_modification DATE NOT NULL, code_finess_etablissement INT NOT NULL, episode_précédent DATE NOT NULL, envoyé_au_cnr TINYINT(1) NOT NULL, nom_cnr_ou_labo VARCHAR(255) NOT NULL, n_cas_0 INT NOT NULL, epidemie_cas_groupés LONGTEXT NOT NULL, caractère_nosocomial TINYINT(1) NOT NULL, origine_cas_importés INT NOT NULL, autres_etablissements_concernés INT NOT NULL, autres_etabs LONGTEXT DEFAULT NULL, code_micro_organisme INT NOT NULL, code_site INT NOT NULL, investigation LONGTEXT DEFAULT NULL, hypothèse_cause LONGTEXT DEFAULT NULL, justification LONGTEXT DEFAULT NULL, praticien_hygiène LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE signalement_esin');
    }
}
