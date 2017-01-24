<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170124032723 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE usergroup (id INT UNSIGNED AUTO_INCREMENT NOT NULL, description_ VARCHAR(255) NOT NULL, can_read_lottery TINYINT(1) DEFAULT \'1\' NOT NULL, can_add_lottery TINYINT(1) DEFAULT \'0\' NOT NULL, can_edit_lottery TINYINT(1) DEFAULT \'0\' NOT NULL, can_delete_lottery TINYINT(1) DEFAULT \'0\' NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_4A647817C0EB25A3 (name_), UNIQUE INDEX UNIQ_4A647817989D9B62 (slug), INDEX IDX_4A64781713629EA6 (can_read_lottery), INDEX IDX_4A647817CC10BC7C (can_add_lottery), INDEX IDX_4A647817157B4790 (can_edit_lottery), INDEX IDX_4A647817959659A3 (can_delete_lottery), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payout CHANGE value_ value_ NUMERIC(11, 2) NOT NULL');
        $this->addSql('ALTER TABLE fos_user DROP locked, DROP expired, DROP expires_at, DROP credentials_expired, DROP credentials_expire_at, CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479C05FB297 ON fos_user (confirmation_token)');

        // adding default values
        $userGroups = [
            "name_ = 'Admin/root users', slug = 'admin', description_ = 'Site administrators', can_read_lottery = 1, can_add_lottery = 1, can_edit_lottery = 1, can_delete_lottery = 1",
            "name_ = 'Standard users', slug = 'standard', description_ = 'Regular site users', can_read_lottery = 1, can_add_lottery = 0, can_edit_lottery = 0, can_delete_lottery = 0"
        ];
        foreach ($userGroups as $row) {
            $sql = 'INSERT INTO usergroup SET ';
            $sql .= $row;
            $sql .= ', created_date = NOW(), modified_date = NOW()';
            $this->addSql($sql);
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE usergroup');
        $this->addSql('DROP INDEX UNIQ_957A6479C05FB297 ON fos_user');
        $this->addSql('ALTER TABLE fos_user ADD locked TINYINT(1) NOT NULL, ADD expired TINYINT(1) NOT NULL, ADD expires_at DATETIME DEFAULT NULL, ADD credentials_expired TINYINT(1) NOT NULL, ADD credentials_expire_at DATETIME DEFAULT NULL, CHANGE salt salt VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE confirmation_token confirmation_token VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE payout CHANGE value_ value_ NUMERIC(11, 2) NOT NULL');
    }
}
