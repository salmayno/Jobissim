<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309121958 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, title VARCHAR(255) DEFAULT NULL, subtitle VARCHAR(255) DEFAULT NULL, total DOUBLE PRECISION NOT NULL, option1 VARCHAR(255) DEFAULT NULL, option2 VARCHAR(255) DEFAULT NULL, option3 VARCHAR(255) DEFAULT NULL, option4 VARCHAR(255) DEFAULT NULL, option5 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_cv (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_emploi (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv_like (id INT AUTO_INCREMENT NOT NULL, cv_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_CD2DA06FCFE419E2 (cv_id), INDEX IDX_CD2DA06FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cvtheque (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, reference_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, disponible TINYINT(1) NOT NULL, cv VARCHAR(255) NOT NULL, experience INT NOT NULL, contrat VARCHAR(255) NOT NULL, metier VARCHAR(255) DEFAULT NULL, INDEX IDX_BB54F34912469DE2 (category_id), UNIQUE INDEX UNIQ_BB54F3491645DEA9 (reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emploi (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, auteur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date DATE NOT NULL, lieu VARCHAR(255) NOT NULL, typedecontrat VARCHAR(255) NOT NULL, duree INT DEFAULT NULL, salaire DOUBLE PRECISION DEFAULT NULL, mission LONGTEXT DEFAULT NULL, prerequis LONGTEXT DEFAULT NULL, organisme VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, clics INT DEFAULT NULL, candidatures INT DEFAULT NULL, totallike INT DEFAULT NULL, evaluation VARCHAR(255) DEFAULT NULL, hm VARCHAR(255) DEFAULT NULL, INDEX IDX_74A0B0FA12469DE2 (category_id), INDEX IDX_74A0B0FA60BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emploi_like (id INT AUTO_INCREMENT NOT NULL, emploi_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_7C9BD75CEC013E12 (emploi_id), INDEX IDX_7C9BD75CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, auteur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, date DATE NOT NULL, duree INT DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, places INT NOT NULL, diplomes VARCHAR(255) DEFAULT NULL, objectif LONGTEXT DEFAULT NULL, prerequis LONGTEXT DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, organisme VARCHAR(255) NOT NULL, eligible TINYINT(1) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, clics INT DEFAULT NULL, candidatures INT DEFAULT NULL, totallike INT DEFAULT NULL, evaluation VARCHAR(255) DEFAULT NULL, hm VARCHAR(255) DEFAULT NULL, INDEX IDX_404021BF12469DE2 (category_id), INDEX IDX_404021BF60BB6FE6 (auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation_like (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_FBBCA5F35200282E (formation_id), INDEX IDX_FBBCA5F3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, from_id_id INT NOT NULL, to_id_id INT NOT NULL, subject VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, is_read TINYINT(1) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_B6BD307F4632BB48 (from_id_id), INDEX IDX_B6BD307F7478AF67 (to_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oder_details (id INT AUTO_INCREMENT NOT NULL, my_order_id INT NOT NULL, product VARCHAR(255) NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, INDEX IDX_4BC9C155BFCDF877 (my_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL, is_paid TINYINT(1) NOT NULL, reference VARCHAR(255) NOT NULL, stripe_session_id VARCHAR(255) DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B9983CE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, cv VARCHAR(255) DEFAULT NULL, lettre VARCHAR(255) DEFAULT NULL, cvonline TINYINT(1) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, compte VARCHAR(255) DEFAULT NULL, naissance DATE DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, postale VARCHAR(255) DEFAULT NULL, about VARCHAR(600) DEFAULT NULL, annonces INT DEFAULT NULL, civilite VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cv_like ADD CONSTRAINT FK_CD2DA06FCFE419E2 FOREIGN KEY (cv_id) REFERENCES cvtheque (id)');
        $this->addSql('ALTER TABLE cv_like ADD CONSTRAINT FK_CD2DA06FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cvtheque ADD CONSTRAINT FK_BB54F34912469DE2 FOREIGN KEY (category_id) REFERENCES category_cv (id)');
        $this->addSql('ALTER TABLE cvtheque ADD CONSTRAINT FK_BB54F3491645DEA9 FOREIGN KEY (reference_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA12469DE2 FOREIGN KEY (category_id) REFERENCES category_emploi (id)');
        $this->addSql('ALTER TABLE emploi ADD CONSTRAINT FK_74A0B0FA60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE emploi_like ADD CONSTRAINT FK_7C9BD75CEC013E12 FOREIGN KEY (emploi_id) REFERENCES emploi (id)');
        $this->addSql('ALTER TABLE emploi_like ADD CONSTRAINT FK_7C9BD75CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF12469DE2 FOREIGN KEY (category_id) REFERENCES category_formation (id)');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF60BB6FE6 FOREIGN KEY (auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE formation_like ADD CONSTRAINT FK_FBBCA5F35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE formation_like ADD CONSTRAINT FK_FBBCA5F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F4632BB48 FOREIGN KEY (from_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F7478AF67 FOREIGN KEY (to_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE oder_details ADD CONSTRAINT FK_4BC9C155BFCDF877 FOREIGN KEY (my_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reset_password ADD CONSTRAINT FK_B9983CE5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cvtheque DROP FOREIGN KEY FK_BB54F34912469DE2');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA12469DE2');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF12469DE2');
        $this->addSql('ALTER TABLE cv_like DROP FOREIGN KEY FK_CD2DA06FCFE419E2');
        $this->addSql('ALTER TABLE emploi_like DROP FOREIGN KEY FK_7C9BD75CEC013E12');
        $this->addSql('ALTER TABLE formation_like DROP FOREIGN KEY FK_FBBCA5F35200282E');
        $this->addSql('ALTER TABLE oder_details DROP FOREIGN KEY FK_4BC9C155BFCDF877');
        $this->addSql('ALTER TABLE cv_like DROP FOREIGN KEY FK_CD2DA06FA76ED395');
        $this->addSql('ALTER TABLE cvtheque DROP FOREIGN KEY FK_BB54F3491645DEA9');
        $this->addSql('ALTER TABLE emploi DROP FOREIGN KEY FK_74A0B0FA60BB6FE6');
        $this->addSql('ALTER TABLE emploi_like DROP FOREIGN KEY FK_7C9BD75CA76ED395');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF60BB6FE6');
        $this->addSql('ALTER TABLE formation_like DROP FOREIGN KEY FK_FBBCA5F3A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F4632BB48');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F7478AF67');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('ALTER TABLE reset_password DROP FOREIGN KEY FK_B9983CE5A76ED395');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE category_cv');
        $this->addSql('DROP TABLE category_emploi');
        $this->addSql('DROP TABLE category_formation');
        $this->addSql('DROP TABLE cv_like');
        $this->addSql('DROP TABLE cvtheque');
        $this->addSql('DROP TABLE emploi');
        $this->addSql('DROP TABLE emploi_like');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE formation_like');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE oder_details');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE reset_password');
        $this->addSql('DROP TABLE user');
    }
}
