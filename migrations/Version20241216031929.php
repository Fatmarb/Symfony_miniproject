<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216031929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutenances_etudiants DROP FOREIGN KEY FK_FA104A54ED9A878');
        $this->addSql('ALTER TABLE soutenances_etudiants DROP FOREIGN KEY FK_FA104A558A7D001');
        $this->addSql('DROP TABLE soutenances_etudiants');
        $this->addSql('ALTER TABLE etudiant ADD soutenance_numjury INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3E624747B FOREIGN KEY (soutenance_numjury) REFERENCES soutenance (numjury)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E3E624747B ON etudiant (soutenance_numjury)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soutenances_etudiants (numjury INT NOT NULL, NCE INT NOT NULL, INDEX IDX_FA104A558A7D001 (NCE), INDEX IDX_FA104A54ED9A878 (numjury), PRIMARY KEY(numjury, NCE)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE soutenances_etudiants ADD CONSTRAINT FK_FA104A54ED9A878 FOREIGN KEY (numjury) REFERENCES soutenance (numjury)');
        $this->addSql('ALTER TABLE soutenances_etudiants ADD CONSTRAINT FK_FA104A558A7D001 FOREIGN KEY (NCE) REFERENCES etudiant (nce)');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3E624747B');
        $this->addSql('DROP INDEX UNIQ_717E22E3E624747B ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP soutenance_numjury');
    }
}
