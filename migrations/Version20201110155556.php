<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201110155556 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_mecha (id INT AUTO_INCREMENT NOT NULL, joueur_id INT NOT NULL, INDEX IDX_69835266A9E2D76C (joueur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_mecha_mecha (liste_mecha_id INT NOT NULL, mecha_id INT NOT NULL, INDEX IDX_D8D4F3C2D6279F87 (liste_mecha_id), INDEX IDX_D8D4F3C2CAFAC47D (mecha_id), PRIMARY KEY(liste_mecha_id, mecha_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mecha (id INT AUTO_INCREMENT NOT NULL, chassis VARCHAR(50) NOT NULL, modele VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pilot (id INT AUTO_INCREMENT NOT NULL, mecha_id INT NOT NULL, nom VARCHAR(50) NOT NULL, piloting SMALLINT NOT NULL, gunnery SMALLINT NOT NULL, INDEX IDX_8D1E5F52CAFAC47D (mecha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liste_mecha ADD CONSTRAINT FK_69835266A9E2D76C FOREIGN KEY (joueur_id) REFERENCES joueur (id)');
        $this->addSql('ALTER TABLE liste_mecha_mecha ADD CONSTRAINT FK_D8D4F3C2D6279F87 FOREIGN KEY (liste_mecha_id) REFERENCES liste_mecha (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liste_mecha_mecha ADD CONSTRAINT FK_D8D4F3C2CAFAC47D FOREIGN KEY (mecha_id) REFERENCES mecha (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pilot ADD CONSTRAINT FK_8D1E5F52CAFAC47D FOREIGN KEY (mecha_id) REFERENCES mecha (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liste_mecha DROP FOREIGN KEY FK_69835266A9E2D76C');
        $this->addSql('ALTER TABLE liste_mecha_mecha DROP FOREIGN KEY FK_D8D4F3C2D6279F87');
        $this->addSql('ALTER TABLE liste_mecha_mecha DROP FOREIGN KEY FK_D8D4F3C2CAFAC47D');
        $this->addSql('ALTER TABLE pilot DROP FOREIGN KEY FK_8D1E5F52CAFAC47D');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE liste_mecha');
        $this->addSql('DROP TABLE liste_mecha_mecha');
        $this->addSql('DROP TABLE mecha');
        $this->addSql('DROP TABLE pilot');
    }
}
