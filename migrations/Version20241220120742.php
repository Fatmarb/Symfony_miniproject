<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241220120742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3E624747B');
        $this->addSql('DROP INDEX UNIQ_717E22E3E624747B ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP soutenance_numjury');
        $this->addSql('ALTER TABLE soutenance ADD etudiant_id INT NOT NULL');
        $this->addSql('ALTER TABLE soutenance ADD CONSTRAINT FK_4D59FF6EDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (NCE)');
        $this->addSql('CREATE INDEX IDX_4D59FF6EDDEAB1A3 ON soutenance (etudiant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD soutenance_numjury INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3E624747B FOREIGN KEY (soutenance_numjury) REFERENCES soutenance (numjury)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E3E624747B ON etudiant (soutenance_numjury)');
        $this->addSql('ALTER TABLE soutenance DROP FOREIGN KEY FK_4D59FF6EDDEAB1A3');
        $this->addSql('DROP INDEX IDX_4D59FF6EDDEAB1A3 ON soutenance');
        $this->addSql('ALTER TABLE soutenance DROP etudiant_id');
    }
}
