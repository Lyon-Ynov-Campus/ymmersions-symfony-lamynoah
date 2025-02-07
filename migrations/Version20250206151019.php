<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206151019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipes ADD id_joueur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipes ADD CONSTRAINT FK_76F7625A29D76B4B FOREIGN KEY (id_joueur_id) REFERENCES joueur (id)');
        $this->addSql('CREATE INDEX IDX_76F7625A29D76B4B ON equipes (id_joueur_id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C579F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C579F37AE5');
        $this->addSql('ALTER TABLE equipes DROP FOREIGN KEY FK_76F7625A29D76B4B');
        $this->addSql('DROP INDEX IDX_76F7625A29D76B4B ON equipes');
        $this->addSql('ALTER TABLE equipes DROP id_joueur_id');
    }
}
