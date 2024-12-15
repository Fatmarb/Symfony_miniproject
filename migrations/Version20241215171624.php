<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241215171624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soutenances_etudiants (numjury INT NOT NULL, NCE INT NOT NULL, INDEX IDX_FA104A54ED9A878 (numjury), INDEX IDX_FA104A558A7D001 (NCE), PRIMARY KEY(numjury, NCE)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soutenances_etudiants ADD CONSTRAINT FK_FA104A54ED9A878 FOREIGN KEY (numjury) REFERENCES soutenance (numjury)');
        $this->addSql('ALTER TABLE soutenances_etudiants ADD CONSTRAINT FK_FA104A558A7D001 FOREIGN KEY (NCE) REFERENCES etudiant (NCE)');
        $this->addSql('ALTER TABLE enseignant DROP id, CHANGE matricule matricule INT AUTO_INCREMENT NOT NULL, CHANGE soutenance nom VARCHAR(255) NOT NULL, ADD PRIMARY KEY (matricule)');
        $this->addSql('ALTER TABLE etudiant MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP id, CHANGE nce nce INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (nce)');
        $this->addSql('ALTER TABLE soutenance MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON soutenance');
        $this->addSql('ALTER TABLE soutenance ADD soutenances_enseignant INT NOT NULL, DROP id, CHANGE numjury numjury INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE soutenance ADD CONSTRAINT FK_4D59FF6E10EE9E30 FOREIGN KEY (soutenances_enseignant) REFERENCES enseignant (Matricule)');
        $this->addSql('CREATE INDEX IDX_4D59FF6E10EE9E30 ON soutenance (soutenances_enseignant)');
        $this->addSql('ALTER TABLE soutenance ADD PRIMARY KEY (numjury)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutenances_etudiants DROP FOREIGN KEY FK_FA104A54ED9A878');
        $this->addSql('ALTER TABLE soutenances_etudiants DROP FOREIGN KEY FK_FA104A558A7D001');
        $this->addSql('DROP TABLE soutenances_etudiants');
        $this->addSql('ALTER TABLE enseignant MODIFY matricule INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON enseignant');
        $this->addSql('ALTER TABLE enseignant ADD id INT NOT NULL, CHANGE matricule matricule INT NOT NULL, CHANGE nom soutenance VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD id INT AUTO_INCREMENT NOT NULL, CHANGE nce nce INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE soutenance DROP FOREIGN KEY FK_4D59FF6E10EE9E30');
        $this->addSql('DROP INDEX IDX_4D59FF6E10EE9E30 ON soutenance');
        $this->addSql('ALTER TABLE soutenance ADD id INT AUTO_INCREMENT NOT NULL, DROP soutenances_enseignant, CHANGE numjury numjury INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
