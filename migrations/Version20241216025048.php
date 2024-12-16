<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241216025048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enseignant (matricule INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(matricule)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (nce INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(nce)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soutenance (numjury INT AUTO_INCREMENT NOT NULL, enseignant_id INT NOT NULL, date_soutenance DATE DEFAULT NULL, note DOUBLE PRECISION DEFAULT NULL, INDEX IDX_4D59FF6EE455FCC0 (enseignant_id), PRIMARY KEY(numjury)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soutenances_etudiants (numjury INT NOT NULL, NCE INT NOT NULL, INDEX IDX_FA104A54ED9A878 (numjury), INDEX IDX_FA104A558A7D001 (NCE), PRIMARY KEY(numjury, NCE)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soutenance ADD CONSTRAINT FK_4D59FF6EE455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (Matricule)');
        $this->addSql('ALTER TABLE soutenances_etudiants ADD CONSTRAINT FK_FA104A54ED9A878 FOREIGN KEY (numjury) REFERENCES soutenance (numjury)');
        $this->addSql('ALTER TABLE soutenances_etudiants ADD CONSTRAINT FK_FA104A558A7D001 FOREIGN KEY (NCE) REFERENCES etudiant (NCE)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutenance DROP FOREIGN KEY FK_4D59FF6EE455FCC0');
        $this->addSql('ALTER TABLE soutenances_etudiants DROP FOREIGN KEY FK_FA104A54ED9A878');
        $this->addSql('ALTER TABLE soutenances_etudiants DROP FOREIGN KEY FK_FA104A558A7D001');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE soutenance');
        $this->addSql('DROP TABLE soutenances_etudiants');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
