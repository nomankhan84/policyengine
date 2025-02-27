<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226203317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Role_Permission (id INT AUTO_INCREMENT NOT NULL, Role_id INT NOT NULL, Permission_id INT NOT NULL, INDEX IDX_6F7DF886D60322AC (Role_id), INDEX IDX_6F7DF886FED90CCA (Permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Role_Permission ADD CONSTRAINT FK_6F7DF886D60322AC FOREIGN KEY (Role_id) REFERENCES Role (id)');
        $this->addSql('ALTER TABLE Role_Permission ADD CONSTRAINT FK_6F7DF886FED90CCA FOREIGN KEY (Permission_id) REFERENCES Permission (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Role_Permission DROP FOREIGN KEY FK_6F7DF886D60322AC');
        $this->addSql('ALTER TABLE Role_Permission DROP FOREIGN KEY FK_6F7DF886FED90CCA');
        $this->addSql('DROP TABLE Role_Permission');
    }
}
