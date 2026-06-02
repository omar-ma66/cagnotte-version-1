<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260602093553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campagne CHANGE id id VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E9D1C3019 FOREIGN KEY (participant_id) REFERENCES participants (id)');
        $this->addSql('ALTER TABLE participants CHANGE campagne_id campagne_id VARCHAR(50) NULL');
        $this->addSql('ALTER TABLE participants ADD CONSTRAINT FK_7169709216227374 FOREIGN KEY (campagne_id) REFERENCES campagne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campagne CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E9D1C3019');
        $this->addSql('ALTER TABLE participants DROP FOREIGN KEY FK_7169709216227374');
        $this->addSql('ALTER TABLE participants CHANGE campagne_id campagne_id INT DEFAULT NULL');
    }
}
