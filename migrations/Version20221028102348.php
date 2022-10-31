<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221028102348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE filtre_produits (filtre_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_C1FD91F5CC9B96EA (filtre_id), INDEX IDX_C1FD91F5CD11A2CF (produits_id), PRIMARY KEY(filtre_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE filtre_produits ADD CONSTRAINT FK_C1FD91F5CC9B96EA FOREIGN KEY (filtre_id) REFERENCES filtre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filtre_produits ADD CONSTRAINT FK_C1FD91F5CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits ADD relation_produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8CE524A4E2 FOREIGN KEY (relation_produit_id) REFERENCES marques (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8CE524A4E2 ON produits (relation_produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE filtre_produits DROP FOREIGN KEY FK_C1FD91F5CC9B96EA');
        $this->addSql('ALTER TABLE filtre_produits DROP FOREIGN KEY FK_C1FD91F5CD11A2CF');
        $this->addSql('DROP TABLE filtre_produits');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8CE524A4E2');
        $this->addSql('DROP INDEX IDX_BE2DDF8CE524A4E2 ON produits');
        $this->addSql('ALTER TABLE produits DROP relation_produit_id');
    }
}
