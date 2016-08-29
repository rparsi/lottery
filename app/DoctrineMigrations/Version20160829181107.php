<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160829181107 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE number_ (id INT UNSIGNED NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payout (id INT UNSIGNED AUTO_INCREMENT NOT NULL, lottery_draw_id INT UNSIGNED NOT NULL, number_of_picks INT UNSIGNED NOT NULL, value_ NUMERIC(11, 2) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_4E2EA902A6C09D5B (lottery_draw_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lottery_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, description_ VARCHAR(255) NOT NULL, number_of_picks INT UNSIGNED NOT NULL, min_pick_value INT UNSIGNED NOT NULL, max_pick_value INT UNSIGNED NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_1F44D1D8C0EB25A3 (name_), UNIQUE INDEX UNIQ_1F44D1D8989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lottery_draw (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type_id INT UNSIGNED NOT NULL, draw_date DATETIME NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_E3683BFEC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lottery_draw_winning_numbers (lottery_draw_id INT UNSIGNED NOT NULL, number_id INT UNSIGNED NOT NULL, INDEX IDX_87740123A6C09D5B (lottery_draw_id), UNIQUE INDEX UNIQ_8774012330A1DE10 (number_id), PRIMARY KEY(lottery_draw_id, number_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payout ADD CONSTRAINT FK_4E2EA902A6C09D5B FOREIGN KEY (lottery_draw_id) REFERENCES lottery_draw (id)');
        $this->addSql('ALTER TABLE lottery_draw ADD CONSTRAINT FK_E3683BFEC54C8C93 FOREIGN KEY (type_id) REFERENCES lottery_type (id)');
        $this->addSql('ALTER TABLE lottery_draw_winning_numbers ADD CONSTRAINT FK_87740123A6C09D5B FOREIGN KEY (lottery_draw_id) REFERENCES lottery_draw (id)');
        $this->addSql('ALTER TABLE lottery_draw_winning_numbers ADD CONSTRAINT FK_8774012330A1DE10 FOREIGN KEY (number_id) REFERENCES number_ (id)');
        $this->addSql('DROP INDEX slug_idx ON company_status');
        $this->addSql('DROP INDEX slug_idx ON company_type');
        $this->addSql('DROP INDEX slug_idx ON phone_number_type');
        $this->addSql('DROP INDEX slug_idx ON region_item_type');
        $this->addSql('DROP INDEX slug_idx ON address_type');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lottery_draw_winning_numbers DROP FOREIGN KEY FK_8774012330A1DE10');
        $this->addSql('ALTER TABLE lottery_draw DROP FOREIGN KEY FK_E3683BFEC54C8C93');
        $this->addSql('ALTER TABLE payout DROP FOREIGN KEY FK_4E2EA902A6C09D5B');
        $this->addSql('ALTER TABLE lottery_draw_winning_numbers DROP FOREIGN KEY FK_87740123A6C09D5B');
        $this->addSql('DROP TABLE number_');
        $this->addSql('DROP TABLE payout');
        $this->addSql('DROP TABLE lottery_type');
        $this->addSql('DROP TABLE lottery_draw');
        $this->addSql('DROP TABLE lottery_draw_winning_numbers');
        $this->addSql('CREATE INDEX slug_idx ON address_type (slug)');
        $this->addSql('CREATE INDEX slug_idx ON company_status (slug)');
        $this->addSql('CREATE INDEX slug_idx ON company_type (slug)');
        $this->addSql('CREATE INDEX slug_idx ON phone_number_type (slug)');
        $this->addSql('CREATE INDEX slug_idx ON region_item_type (slug)');
    }
}
