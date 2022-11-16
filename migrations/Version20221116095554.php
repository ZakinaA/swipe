<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116095554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe_instrument (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE classe_intstrument');
        $this->addSql('ALTER TABLE accessoire ADD etat_id INT DEFAULT NULL, ADD instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE accessoire ADD CONSTRAINT FK_8FD026AD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE accessoire ADD CONSTRAINT FK_8FD026ACF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('CREATE INDEX IDX_8FD026AD5E86FF ON accessoire (etat_id)');
        $this->addSql('CREATE INDEX IDX_8FD026ACF11D9C ON accessoire (instrument_id)');
        $this->addSql('ALTER TABLE compte ADD professeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260BAB22EE9 ON compte (professeur_id)');
        $this->addSql('ALTER TABLE cours ADD professeur_id INT DEFAULT NULL, ADD type_cours_id INT NOT NULL, ADD instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CB3305F4C FOREIGN KEY (type_cours_id) REFERENCES type_cours (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CBAB22EE9 ON cours (professeur_id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CB3305F4C ON cours (type_cours_id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9CCF11D9C ON cours (instrument_id)');
        $this->addSql('ALTER TABLE couter ADD tranche_id INT DEFAULT NULL, ADD type_cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE couter ADD CONSTRAINT FK_8D58231BB76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('ALTER TABLE couter ADD CONSTRAINT FK_8D58231BB3305F4C FOREIGN KEY (type_cours_id) REFERENCES type_cours (id)');
        $this->addSql('CREATE INDEX IDX_8D58231BB76F6B31 ON couter (tranche_id)');
        $this->addSql('CREATE INDEX IDX_8D58231BB3305F4C ON couter (type_cours_id)');
        $this->addSql('ALTER TABLE eleve ADD responsable_id INT NOT NULL, ADD compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F753C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F753C59D72 ON eleve (responsable_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ECA105F7F2C56620 ON eleve (compte_id)');
        $this->addSql('ALTER TABLE emprunter ADD eleve_id INT DEFAULT NULL, ADD instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emprunter ADD CONSTRAINT FK_E23B93FA6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE emprunter ADD CONSTRAINT FK_E23B93FCF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('CREATE INDEX IDX_E23B93FA6CC7B2 ON emprunter (eleve_id)');
        $this->addSql('CREATE INDEX IDX_E23B93FCF11D9C ON emprunter (instrument_id)');
        $this->addSql('ALTER TABLE inscription ADD eleve_id INT DEFAULT NULL, ADD cours_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D67ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6A6CC7B2 ON inscription (eleve_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D67ECF78B0 ON inscription (cours_id)');
        $this->addSql('ALTER TABLE instrument ADD marque_id INT DEFAULT NULL, ADD couleur_id INT DEFAULT NULL, ADD etat_id INT DEFAULT NULL, ADD type_instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDC31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DDD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE instrument ADD CONSTRAINT FK_3CBF69DD7C1CAAA9 FOREIGN KEY (type_instrument_id) REFERENCES type_instrument (id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DD4827B9B2 ON instrument (marque_id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DDC31BA576 ON instrument (couleur_id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DDD5E86FF ON instrument (etat_id)');
        $this->addSql('CREATE INDEX IDX_3CBF69DD7C1CAAA9 ON instrument (type_instrument_id)');
        $this->addSql('ALTER TABLE intervenir ADD instrument_id INT DEFAULT NULL, ADD profesionnel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervenir ADD CONSTRAINT FK_DFB07992CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
        $this->addSql('ALTER TABLE intervenir ADD CONSTRAINT FK_DFB07992A1C11C1F FOREIGN KEY (profesionnel_id) REFERENCES profesionnel (id)');
        $this->addSql('CREATE INDEX IDX_DFB07992CF11D9C ON intervenir (instrument_id)');
        $this->addSql('CREATE INDEX IDX_DFB07992A1C11C1F ON intervenir (profesionnel_id)');
        $this->addSql('ALTER TABLE responsable ADD tranche_id INT DEFAULT NULL, ADD compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07B76F6B31 FOREIGN KEY (tranche_id) REFERENCES tranche (id)');
        $this->addSql('ALTER TABLE responsable ADD CONSTRAINT FK_52520D07F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_52520D07B76F6B31 ON responsable (tranche_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_52520D07F2C56620 ON responsable (compte_id)');
        $this->addSql('ALTER TABLE type_instrument ADD classe_instrument_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_instrument ADD CONSTRAINT FK_21BCBFF8CE879FB1 FOREIGN KEY (classe_instrument_id) REFERENCES classe_instrument (id)');
        $this->addSql('CREATE INDEX IDX_21BCBFF8CE879FB1 ON type_instrument (classe_instrument_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_instrument DROP FOREIGN KEY FK_21BCBFF8CE879FB1');
        $this->addSql('CREATE TABLE classe_intstrument (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE classe_instrument');
        $this->addSql('ALTER TABLE accessoire DROP FOREIGN KEY FK_8FD026AD5E86FF');
        $this->addSql('ALTER TABLE accessoire DROP FOREIGN KEY FK_8FD026ACF11D9C');
        $this->addSql('DROP INDEX IDX_8FD026AD5E86FF ON accessoire');
        $this->addSql('DROP INDEX IDX_8FD026ACF11D9C ON accessoire');
        $this->addSql('ALTER TABLE accessoire DROP etat_id, DROP instrument_id');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260BAB22EE9');
        $this->addSql('DROP INDEX UNIQ_CFF65260BAB22EE9 ON compte');
        $this->addSql('ALTER TABLE compte DROP professeur_id');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CB3305F4C');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CCF11D9C');
        $this->addSql('DROP INDEX IDX_FDCA8C9CBAB22EE9 ON cours');
        $this->addSql('DROP INDEX IDX_FDCA8C9CB3305F4C ON cours');
        $this->addSql('DROP INDEX IDX_FDCA8C9CCF11D9C ON cours');
        $this->addSql('ALTER TABLE cours DROP professeur_id, DROP type_cours_id, DROP instrument_id');
        $this->addSql('ALTER TABLE couter DROP FOREIGN KEY FK_8D58231BB76F6B31');
        $this->addSql('ALTER TABLE couter DROP FOREIGN KEY FK_8D58231BB3305F4C');
        $this->addSql('DROP INDEX IDX_8D58231BB76F6B31 ON couter');
        $this->addSql('DROP INDEX IDX_8D58231BB3305F4C ON couter');
        $this->addSql('ALTER TABLE couter DROP tranche_id, DROP type_cours_id');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F753C59D72');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7F2C56620');
        $this->addSql('DROP INDEX IDX_ECA105F753C59D72 ON eleve');
        $this->addSql('DROP INDEX UNIQ_ECA105F7F2C56620 ON eleve');
        $this->addSql('ALTER TABLE eleve DROP responsable_id, DROP compte_id');
        $this->addSql('ALTER TABLE emprunter DROP FOREIGN KEY FK_E23B93FA6CC7B2');
        $this->addSql('ALTER TABLE emprunter DROP FOREIGN KEY FK_E23B93FCF11D9C');
        $this->addSql('DROP INDEX IDX_E23B93FA6CC7B2 ON emprunter');
        $this->addSql('DROP INDEX IDX_E23B93FCF11D9C ON emprunter');
        $this->addSql('ALTER TABLE emprunter DROP eleve_id, DROP instrument_id');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A6CC7B2');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D67ECF78B0');
        $this->addSql('DROP INDEX IDX_5E90F6D6A6CC7B2 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D67ECF78B0 ON inscription');
        $this->addSql('ALTER TABLE inscription DROP eleve_id, DROP cours_id');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD4827B9B2');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDC31BA576');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DDD5E86FF');
        $this->addSql('ALTER TABLE instrument DROP FOREIGN KEY FK_3CBF69DD7C1CAAA9');
        $this->addSql('DROP INDEX IDX_3CBF69DD4827B9B2 ON instrument');
        $this->addSql('DROP INDEX IDX_3CBF69DDC31BA576 ON instrument');
        $this->addSql('DROP INDEX IDX_3CBF69DDD5E86FF ON instrument');
        $this->addSql('DROP INDEX IDX_3CBF69DD7C1CAAA9 ON instrument');
        $this->addSql('ALTER TABLE instrument DROP marque_id, DROP couleur_id, DROP etat_id, DROP type_instrument_id');
        $this->addSql('ALTER TABLE intervenir DROP FOREIGN KEY FK_DFB07992CF11D9C');
        $this->addSql('ALTER TABLE intervenir DROP FOREIGN KEY FK_DFB07992A1C11C1F');
        $this->addSql('DROP INDEX IDX_DFB07992CF11D9C ON intervenir');
        $this->addSql('DROP INDEX IDX_DFB07992A1C11C1F ON intervenir');
        $this->addSql('ALTER TABLE intervenir DROP instrument_id, DROP profesionnel_id');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07B76F6B31');
        $this->addSql('ALTER TABLE responsable DROP FOREIGN KEY FK_52520D07F2C56620');
        $this->addSql('DROP INDEX IDX_52520D07B76F6B31 ON responsable');
        $this->addSql('DROP INDEX UNIQ_52520D07F2C56620 ON responsable');
        $this->addSql('ALTER TABLE responsable DROP tranche_id, DROP compte_id');
        $this->addSql('DROP INDEX IDX_21BCBFF8CE879FB1 ON type_instrument');
        $this->addSql('ALTER TABLE type_instrument DROP classe_instrument_id');
    }
}
