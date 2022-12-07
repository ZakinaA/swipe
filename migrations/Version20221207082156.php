<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207082156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260BAB22EE9');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260A6CC7B2');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526053C59D72');
        $this->addSql('DROP INDEX UNIQ_CFF6526053C59D72 ON compte');
        $this->addSql('DROP INDEX UNIQ_CFF65260A6CC7B2 ON compte');
        $this->addSql('DROP INDEX UNIQ_CFF65260BAB22EE9 ON compte');
        $this->addSql('ALTER TABLE compte DROP eleve_id, DROP responsable_id, DROP professeur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte ADD eleve_id INT DEFAULT NULL, ADD responsable_id INT DEFAULT NULL, ADD professeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526053C59D72 FOREIGN KEY (responsable_id) REFERENCES responsable (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF6526053C59D72 ON compte (responsable_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260A6CC7B2 ON compte (eleve_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFF65260BAB22EE9 ON compte (professeur_id)');
    }
}
