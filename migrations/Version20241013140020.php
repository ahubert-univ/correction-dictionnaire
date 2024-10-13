<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241013140020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Table language and dictionary annd first value';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dictionary (id INT AUTO_INCREMENT NOT NULL, source_language_id INT NOT NULL, translation_language_id INT NOT NULL, word VARCHAR(255) NOT NULL, translation VARCHAR(255) NOT NULL, INDEX IDX_1FA0E526BE8EEA54 (source_language_id), INDEX IDX_1FA0E52619EFF0F5 (translation_language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, lang VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dictionary ADD CONSTRAINT FK_1FA0E526BE8EEA54 FOREIGN KEY (source_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE dictionary ADD CONSTRAINT FK_1FA0E52619EFF0F5 FOREIGN KEY (translation_language_id) REFERENCES language (id)');
        $this->addSql('INSERT INTO language (lang) VALUES (:lang)',["lang"=>"fr"]);
        $this->addSql('INSERT INTO language (lang) VALUES (:lang)',["lang"=>"en"]);
        $this->addSql('INSERT INTO language (lang) VALUES (:lang)',["lang"=>"es"]);
        $this->addSql('INSERT INTO dictionary(word,source_language_id,translation,translation_language_id) VALUES (:word,:sourceLanguage,:translation,:translationLanguage)',["word"=>"ordinateur","sourceLanguage" => 1,"translation"=>"erreur","translationLanguage"=>3]);
        $this->addSql('INSERT INTO dictionary(word,source_language_id,translation,translation_language_id) VALUES (:word,:sourceLanguage,:translation,:translationLanguage)',["word"=>"eat","sourceLanguage" => 1,"translation"=>"manger","translationLanguage"=>2]);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dictionary DROP FOREIGN KEY FK_1FA0E526BE8EEA54');
        $this->addSql('ALTER TABLE dictionary DROP FOREIGN KEY FK_1FA0E52619EFF0F5');
        $this->addSql('DROP TABLE dictionary');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
