<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128180219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP id, CHANGE matricule matricule INT AUTO_INCREMENT NOT NULL, CHANGE soutenance nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE enseignant ADD PRIMARY KEY (matricule)');
        $this->addSql('ALTER TABLE etudiant MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP id, CHANGE nce nce INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (nce)');
        $this->addSql('ALTER TABLE soutenance MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON soutenance');
        $this->addSql('ALTER TABLE soutenance DROP id, CHANGE numjury numjury INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE soutenance ADD PRIMARY KEY (numjury)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseignant ADD id INT AUTO_INCREMENT NOT NULL, CHANGE matricule matricule INT NOT NULL, CHANGE nom soutenance VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE etudiant ADD id INT AUTO_INCREMENT NOT NULL, CHANGE nce nce INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE soutenance ADD id INT AUTO_INCREMENT NOT NULL, CHANGE numjury numjury INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
