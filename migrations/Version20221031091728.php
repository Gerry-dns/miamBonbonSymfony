<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221031091728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse_livraison (id INT AUTO_INCREMENT NOT NULL, numero_rue VARCHAR(50) NOT NULL, nom_rue VARCHAR(150) NOT NULL, code_postal VARCHAR(15) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, adresse_livraison_id INT DEFAULT NULL, ref_commande VARCHAR(255) NOT NULL, date_commande DATE DEFAULT NULL, INDEX IDX_6EEAA67DBE2F0A35 (adresse_livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_produits (commande_id INT NOT NULL, produits_id INT NOT NULL, INDEX IDX_680DC71682EA2E54 (commande_id), INDEX IDX_680DC716CD11A2CF (produits_id), PRIMARY KEY(commande_id, produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, est_en_promo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DBE2F0A35 FOREIGN KEY (adresse_livraison_id) REFERENCES adresse_livraison (id)');
        $this->addSql('ALTER TABLE commande_produits ADD CONSTRAINT FK_680DC71682EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produits ADD CONSTRAINT FK_680DC716CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits ADD promotion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('CREATE INDEX IDX_BE2DDF8C139DF194 ON produits (promotion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C139DF194');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DBE2F0A35');
        $this->addSql('ALTER TABLE commande_produits DROP FOREIGN KEY FK_680DC71682EA2E54');
        $this->addSql('ALTER TABLE commande_produits DROP FOREIGN KEY FK_680DC716CD11A2CF');
        $this->addSql('DROP TABLE adresse_livraison');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_produits');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP INDEX IDX_BE2DDF8C139DF194 ON produits');
        $this->addSql('ALTER TABLE produits DROP promotion_id');
    }
}
