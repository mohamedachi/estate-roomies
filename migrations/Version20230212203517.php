<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212203517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion');
        $this->addSql('ALTER TABLE promotion CHANGE produit_id_id produit_id_id INT DEFAULT NULL, CHANGE id_categ_id id_categ_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion (produit_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion');
        $this->addSql('ALTER TABLE promotion CHANGE produit_id_id produit_id_id INT NOT NULL, CHANGE id_categ_id id_categ_id INT NOT NULL');
        $this->addSql('CREATE INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion (produit_id_id)');
    }
}
