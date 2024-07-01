<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240701140027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, id_veterinarian_id INT NOT NULL, id_owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, date_birth DATE NOT NULL, gender TINYINT(1) NOT NULL, color VARCHAR(255) NOT NULL, weight INT NOT NULL, INDEX IDX_6AAB231F6912419B (id_veterinarian_id), INDEX IDX_6AAB231F2EE78D6C (id_owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, date_appointment DATETIME NOT NULL, INDEX IDX_FE38F8448E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinarian (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6912419B FOREIGN KEY (id_veterinarian_id) REFERENCES veterinarian (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F2EE78D6C FOREIGN KEY (id_owner_id) REFERENCES owner (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8448E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6912419B');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F2EE78D6C');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8448E962C16');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE veterinarian');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
