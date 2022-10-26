<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007134048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE file ADD document_title VARCHAR(255) DEFAULT NULL, CHANGE autor autor VARCHAR(255) NOT NULL');
        //$this->addSql('ALTER TABLE gallery CHANGE laboratory_id laboratory_id INT NOT NULL, CHANGE link link VARCHAR(255) DEFAULT NULL, CHANGE modified modified DATETIME NOT NULL');
        //$this->addSql('ALTER TABLE laboratory CHANGE image_url image_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE file DROP document_title, CHANGE autor autor VARCHAR(255) DEFAULT NULL');
        //$this->addSql('ALTER TABLE gallery CHANGE laboratory_id laboratory_id INT DEFAULT NULL, CHANGE link link VARCHAR(255) DEFAULT \'\', CHANGE modified modified DATETIME DEFAULT \'0000-00-00 00:00:00\'');
        //$this->addSql('ALTER TABLE laboratory CHANGE image_url image_url VARCHAR(255) DEFAULT \'\'');
    }
}
