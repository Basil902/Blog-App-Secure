<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260624213253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment RENAME INDEX idx_5f9e962ae85f12b8 TO IDX_9474526CE85F12B8');
        $this->addSql('ALTER TABLE comment RENAME INDEX idx_5f9e962a9d86650f TO IDX_9474526C9D86650F');
        $this->addSql('ALTER TABLE post RENAME INDEX idx_885dbafa69ccbe9a TO IDX_5A8A6C8D69CCBE9A');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495E237E06 ON user (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment RENAME INDEX idx_9474526ce85f12b8 TO IDX_5F9E962AE85F12B8');
        $this->addSql('ALTER TABLE comment RENAME INDEX idx_9474526c9d86650f TO IDX_5F9E962A9D86650F');
        $this->addSql('ALTER TABLE post RENAME INDEX idx_5a8a6c8d69ccbe9a TO IDX_885DBAFA69CCBE9A');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D6495E237E06 ON user');
    }
}
