<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250206145709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipes (id INT AUTO_INCREMENT NOT NULL, id_tournoi_id INT DEFAULT NULL, id_versus_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, max_joueur INT NOT NULL, INDEX IDX_76F7625A538DF7DD (id_tournoi_id), INDEX IDX_76F7625A5A777E8B (id_versus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_equipes_id INT DEFAULT NULL, INDEX IDX_FD71A9C579F37AE5 (id_user_id), INDEX IDX_FD71A9C5D6F2806D (id_equipes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cashprice DOUBLE PRECISION DEFAULT NULL, max_equipes INT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, created_at DATETIME NOT NULL, description LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE versus (id INT AUTO_INCREMENT NOT NULL, id_tournoi_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, score VARCHAR(255) DEFAULT NULL, date_match DATETIME NOT NULL, INDEX IDX_31AEA469538DF7DD (id_tournoi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipes ADD CONSTRAINT FK_76F7625A538DF7DD FOREIGN KEY (id_tournoi_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE equipes ADD CONSTRAINT FK_76F7625A5A777E8B FOREIGN KEY (id_versus_id) REFERENCES versus (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C579F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C5D6F2806D FOREIGN KEY (id_equipes_id) REFERENCES equipes (id)');
        $this->addSql('ALTER TABLE versus ADD CONSTRAINT FK_31AEA469538DF7DD FOREIGN KEY (id_tournoi_id) REFERENCES tournament (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipes DROP FOREIGN KEY FK_76F7625A538DF7DD');
        $this->addSql('ALTER TABLE equipes DROP FOREIGN KEY FK_76F7625A5A777E8B');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C579F37AE5');
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C5D6F2806D');
        $this->addSql('ALTER TABLE versus DROP FOREIGN KEY FK_31AEA469538DF7DD');
        $this->addSql('DROP TABLE equipes');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE versus');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
