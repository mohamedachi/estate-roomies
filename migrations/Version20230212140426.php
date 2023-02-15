<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212140426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_promotion CHANGE description description VARCHAR(400) DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion DROP INDEX fk_promotion_categorie, ADD INDEX IDX_C11D7DD1B8CCB787 (id_categ_id)');
        $this->addSql('DROP INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion');
        $this->addSql('ALTER TABLE promotion CHANGE produit_id_id produit_id_id INT DEFAULT NULL, CHANGE id_categ_id id_categ_id INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion (produit_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_promotion CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE promotion DROP INDEX IDX_C11D7DD1B8CCB787, ADD UNIQUE INDEX fk_promotion_categorie (id_categ_id)');
        $this->addSql('DROP INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion');
        $this->addSql('ALTER TABLE promotion CHANGE produit_id_id produit_id_id INT NOT NULL, CHANGE id_categ_id id_categ_id INT NOT NULL');
        $this->addSql('CREATE INDEX UNIQ_C11D7DD14FD8F9C3 ON promotion (produit_id_id)');
    }
}
