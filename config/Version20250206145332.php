<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206145332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5EDB3A7AE');
        $this->addSql('DROP INDEX IDX_FD71A9C5EDB3A7AE ON joueur');
        $this->addSql('ALTER TABLE joueur DROP id_equipe_id');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C579F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C579F37AE5');
        $this->addSql('ALTER TABLE joueur ADD id_equipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5EDB3A7AE FOREIGN KEY (id_equipe_id) REFERENCES equipes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FD71A9C5EDB3A7AE ON joueur (id_equipe_id)');
    }
}
