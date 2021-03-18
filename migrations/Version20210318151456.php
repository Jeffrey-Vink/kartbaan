<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318151456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activiteit (id INT AUTO_INCREMENT NOT NULL, soort_id INT DEFAULT NULL, datum DATE NOT NULL, tijd TIME NOT NULL, INDEX IDX_8E3A8C2E3DEE50DF (soort_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activiteit_user (activiteit_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8534EB375A8A0A1 (activiteit_id), INDEX IDX_8534EB37A76ED395 (user_id), PRIMARY KEY(activiteit_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soortactiviteit (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, min_leeftijd INT NOT NULL, tijdsduur INT NOT NULL, price NUMERIC(10, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, voorletters VARCHAR(10) NOT NULL, tussenvoegsel VARCHAR(25) DEFAULT NULL, achternaam VARCHAR(25) NOT NULL, adres VARCHAR(25) NOT NULL, postcode VARCHAR(20) NOT NULL, telefoon VARCHAR(15) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activiteit ADD CONSTRAINT FK_8E3A8C2E3DEE50DF FOREIGN KEY (soort_id) REFERENCES soortactiviteit (id)');
        $this->addSql('ALTER TABLE activiteit_user ADD CONSTRAINT FK_8534EB375A8A0A1 FOREIGN KEY (activiteit_id) REFERENCES activiteit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activiteit_user ADD CONSTRAINT FK_8534EB37A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activiteit_user DROP FOREIGN KEY FK_8534EB375A8A0A1');
        $this->addSql('ALTER TABLE activiteit DROP FOREIGN KEY FK_8E3A8C2E3DEE50DF');
        $this->addSql('ALTER TABLE activiteit_user DROP FOREIGN KEY FK_8534EB37A76ED395');
        $this->addSql('DROP TABLE activiteit');
        $this->addSql('DROP TABLE activiteit_user');
        $this->addSql('DROP TABLE soortactiviteit');
        $this->addSql('DROP TABLE user');
    }
}
