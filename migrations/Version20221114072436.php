<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114072436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3E2ED6D6');
        $this->addSql('DROP INDEX IDX_9474526C3E2ED6D6 ON comment');
        $this->addSql('ALTER TABLE comment DROP recettes_id');
        $this->addSql('ALTER TABLE recette ADD comments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639063379586 FOREIGN KEY (comments_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX IDX_49BB639063379586 ON recette (comments_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD recettes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3E2ED6D6 FOREIGN KEY (recettes_id) REFERENCES recette (id)');
        $this->addSql('CREATE INDEX IDX_9474526C3E2ED6D6 ON comment (recettes_id)');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639063379586');
        $this->addSql('DROP INDEX IDX_49BB639063379586 ON recette');
        $this->addSql('ALTER TABLE recette DROP comments_id');
    }
}
