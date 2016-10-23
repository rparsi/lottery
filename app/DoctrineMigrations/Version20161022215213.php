<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161022215213 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE metric DROP FOREIGN KEY FK_87D62EE3E4789E1D');
        $this->addSql('ALTER TABLE lottery_draw_winning_numbers DROP FOREIGN KEY FK_8774012330A1DE10');
        $this->addSql('ALTER TABLE metric DROP FOREIGN KEY FK_87D62EE330A1DE10');
        $this->addSql('CREATE TABLE number_metric (id INT UNSIGNED AUTO_INCREMENT NOT NULL, lottery_type_id INT UNSIGNED NOT NULL, number_ INT UNSIGNED NOT NULL, updated_date DATE NOT NULL, total_times_won INT UNSIGNED DEFAULT 0 NOT NULL, times_won_last_10_draws INT UNSIGNED DEFAULT 0 NOT NULL, times_won_last_20_draws INT UNSIGNED DEFAULT 0 NOT NULL, times_won_last_30_draws INT UNSIGNED DEFAULT 0 NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_12D22DE2C49D070 (lottery_type_id), INDEX IDX_12D22DE24546A61A (number_), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE winning_number (lottery_draw_id INT UNSIGNED NOT NULL, number_ INT UNSIGNED NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_850C495BA6C09D5B (lottery_draw_id), INDEX IDX_850C495B4546A61A (number_), PRIMARY KEY(lottery_draw_id, number_)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE number_metric ADD CONSTRAINT FK_12D22DE2C49D070 FOREIGN KEY (lottery_type_id) REFERENCES lottery_type (id)');
        $this->addSql('ALTER TABLE winning_number ADD CONSTRAINT FK_850C495BA6C09D5B FOREIGN KEY (lottery_draw_id) REFERENCES lottery_draw (id)');
        $this->addSql('DROP TABLE lottery_draw_winning_numbers');
        $this->addSql('DROP TABLE metric');
        $this->addSql('DROP TABLE metric_type');
        $this->addSql('DROP TABLE number_');
        $this->addSql('ALTER TABLE payout CHANGE value_ value_ NUMERIC(11, 2) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lottery_draw_winning_numbers (lottery_draw_id INT UNSIGNED NOT NULL, number_id INT UNSIGNED NOT NULL, UNIQUE INDEX UNIQ_8774012330A1DE10 (number_id), INDEX IDX_87740123A6C09D5B (lottery_draw_id), PRIMARY KEY(lottery_draw_id, number_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metric (id INT UNSIGNED AUTO_INCREMENT NOT NULL, number_id INT UNSIGNED NOT NULL, lottery_type_id INT UNSIGNED NOT NULL, metric_type_id INT UNSIGNED NOT NULL, int_value INT UNSIGNED NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_87D62EE3C49D070 (lottery_type_id), INDEX IDX_87D62EE3E4789E1D (metric_type_id), INDEX IDX_87D62EE330A1DE10 (number_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metric_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, description_ VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, slug VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_3A4053EC0EB25A3 (name_), UNIQUE INDEX UNIQ_3A4053E989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE number_ (id INT UNSIGNED NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lottery_draw_winning_numbers ADD CONSTRAINT FK_8774012330A1DE10 FOREIGN KEY (number_id) REFERENCES number_ (id)');
        $this->addSql('ALTER TABLE lottery_draw_winning_numbers ADD CONSTRAINT FK_87740123A6C09D5B FOREIGN KEY (lottery_draw_id) REFERENCES lottery_draw (id)');
        $this->addSql('ALTER TABLE metric ADD CONSTRAINT FK_87D62EE330A1DE10 FOREIGN KEY (number_id) REFERENCES number_ (id)');
        $this->addSql('ALTER TABLE metric ADD CONSTRAINT FK_87D62EE3C49D070 FOREIGN KEY (lottery_type_id) REFERENCES lottery_type (id)');
        $this->addSql('ALTER TABLE metric ADD CONSTRAINT FK_87D62EE3E4789E1D FOREIGN KEY (metric_type_id) REFERENCES metric_type (id)');
        $this->addSql('DROP TABLE number_metric');
        $this->addSql('DROP TABLE winning_number');
        $this->addSql('ALTER TABLE payout CHANGE value_ value_ NUMERIC(11, 2) NOT NULL');
    }
}
