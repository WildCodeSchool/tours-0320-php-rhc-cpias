<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200713135532 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE finess (id INT AUTO_INCREMENT NOT NULL, etablissement VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(255) NOT NULL, finess INT NOT NULL, coordinates VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE esin (id INT AUTO_INCREMENT NOT NULL, identifiant_de_la_fiche INT NOT NULL, emission_de_la_fiche DATE NOT NULL, date_derniere_modif DATE NOT NULL, code_finess_etab INT NOT NULL, episode_precedent DATE NOT NULL, envoi_au_cnr INT NOT NULL, nom_cnr_ou_labo VARCHAR(255) NOT NULL, nb_cas INT NOT NULL, epidemie_cas_groupes LONGTEXT NOT NULL, caractere_nosocomial INT DEFAULT NULL, origine_cas_importes INT NOT NULL, etab_concernes INT NOT NULL, autres_etabs LONGTEXT DEFAULT NULL, code_micro_organisme1 INT NOT NULL, code_micro_organisme2 INT NOT NULL, code_micro_organisme3 INT NOT NULL, code_site_un INT NOT NULL, code_site_deux INT NOT NULL, code_site_trois INT NOT NULL, investigation LONGTEXT DEFAULT NULL, hypothese_cause LONGTEXT DEFAULT NULL, justification LONGTEXT DEFAULT NULL, praticien_hygiene LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strain (id INT AUTO_INCREMENT NOT NULL, finess_id INT NOT NULL, creno VARCHAR(255) NOT NULL, date_prelevement DATE NOT NULL, type_prelevement VARCHAR(255) NOT NULL, micro_organisme VARCHAR(255) NOT NULL, resistance VARCHAR(255) NOT NULL, INDEX IDX_A630CD72DB9C770E (finess_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE strain ADD CONSTRAINT FK_A630CD72DB9C770E FOREIGN KEY (finess_id) REFERENCES finess (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE strain DROP FOREIGN KEY FK_A630CD72DB9C770E');
        $this->addSql('DROP TABLE finess');
        $this->addSql('DROP TABLE esin');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE strain');
    }
}
