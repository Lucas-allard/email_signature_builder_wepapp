<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116144642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(50) NOT NULL, position VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, phone_number VARCHAR(10) DEFAULT NULL, second_email VARCHAR(255) NOT NULL, third_email VARCHAR(255) NOT NULL, facebook_url VARCHAR(255) NOT NULL, instagram_url VARCHAR(255) DEFAULT NULL, linkedin_url VARCHAR(255) DEFAULT NULL, twitter_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD is_verified TINYINT(1) NOT NULL, DROP first_name, DROP last_name, DROP position, DROP picture, DROP phone_number, DROP second_email, DROP third_email, DROP facebook_url, DROP instagram_url, DROP linkedin_url, DROP twitter_url');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(30) NOT NULL, ADD last_name VARCHAR(50) NOT NULL, ADD position VARCHAR(255) NOT NULL, ADD picture VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(10) DEFAULT NULL, ADD second_email VARCHAR(255) NOT NULL, ADD third_email VARCHAR(255) NOT NULL, ADD facebook_url VARCHAR(255) NOT NULL, ADD instagram_url VARCHAR(255) DEFAULT NULL, ADD linkedin_url VARCHAR(255) DEFAULT NULL, ADD twitter_url VARCHAR(255) DEFAULT NULL, DROP is_verified');
    }
}
