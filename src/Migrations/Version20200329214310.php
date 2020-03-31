<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329214310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE wording (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wording_article (wording_id INT NOT NULL, article_id INT NOT NULL, INDEX IDX_AEDE3357D34102DF (wording_id), INDEX IDX_AEDE33577294869C (article_id), PRIMARY KEY(wording_id, article_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wording_article ADD CONSTRAINT FK_AEDE3357D34102DF FOREIGN KEY (wording_id) REFERENCES wording (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wording_article ADD CONSTRAINT FK_AEDE33577294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wording_article DROP FOREIGN KEY FK_AEDE3357D34102DF');
        $this->addSql('DROP TABLE wording');
        $this->addSql('DROP TABLE wording_article');
    }
}
