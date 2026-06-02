<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260602092014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campagne (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, objectif BIGINT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, cree_a DATETIME DEFAULT NULL, mise_a_jour DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, montant DOUBLE PRECISION DEFAULT NULL, cree_a DATETIME DEFAULT NULL, mise_a_jour DATETIME DEFAULT NULL, participant_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_B1DC7A1E9D1C3019 (participant_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE participants (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, cree_a DATETIME DEFAULT NULL, mise_a_jour DATETIME DEFAULT NULL, campagne_id INT DEFAULT NULL, INDEX IDX_7169709216227374 (campagne_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E9D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_7169709216227374 FOREIGN KEY (campagne_id) REFERENCES campagne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E9D1C3019');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_7169709216227374');
        $this->addSql('DROP TABLE campagne');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE participants');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
