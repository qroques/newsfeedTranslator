<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230416161253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE newsfeed (uuid VARCHAR(255) NOT NULL, title_translation_id VARCHAR(255) DEFAULT NULL, subtitle_translation_id VARCHAR(255) DEFAULT NULL, body_translation_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', provider_id INT NOT NULL, provider_record_id INT NOT NULL, written_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', alert TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D39C3273CB1075C0 (title_translation_id), UNIQUE INDEX UNIQ_D39C3273E19F0501 (subtitle_translation_id), UNIQUE INDEX UNIQ_D39C3273417481D1 (body_translation_id), INDEX uuid_idx (uuid), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE translation (uuid VARCHAR(255) NOT NULL, original_text LONGTEXT NOT NULL, original_locale VARCHAR(255) NOT NULL, translated_text LONGTEXT NOT NULL, translated_locale VARCHAR(255) NOT NULL, INDEX uuid_idx (uuid), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE newsfeed ADD CONSTRAINT FK_D39C3273CB1075C0 FOREIGN KEY (title_translation_id) REFERENCES translation (uuid)');
        $this->addSql('ALTER TABLE newsfeed ADD CONSTRAINT FK_D39C3273E19F0501 FOREIGN KEY (subtitle_translation_id) REFERENCES translation (uuid)');
        $this->addSql('ALTER TABLE newsfeed ADD CONSTRAINT FK_D39C3273417481D1 FOREIGN KEY (body_translation_id) REFERENCES translation (uuid)');
        $this->addSql('CREATE UNIQUE INDEX provider_id_idx ON newsfeed (provider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE newsfeed DROP FOREIGN KEY FK_D39C3273CB1075C0');
        $this->addSql('ALTER TABLE newsfeed DROP FOREIGN KEY FK_D39C3273E19F0501');
        $this->addSql('ALTER TABLE newsfeed DROP FOREIGN KEY FK_D39C3273417481D1');
        $this->addSql('DROP TABLE newsfeed');
        $this->addSql('DROP TABLE translation');
    }
}
