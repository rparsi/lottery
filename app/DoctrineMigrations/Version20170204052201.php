<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170204052201 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE payout CHANGE value_ value_ NUMERIC(11, 2) NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD usergroup_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479D2112630 FOREIGN KEY (usergroup_id) REFERENCES usergroup (id)');
        $this->addSql('CREATE INDEX IDX_957A6479D2112630 ON fos_user (usergroup_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479D2112630');
        $this->addSql('DROP INDEX IDX_957A6479D2112630 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP usergroup_id');
        $this->addSql('ALTER TABLE payout CHANGE value_ value_ NUMERIC(11, 2) NOT NULL');
    }
}
