<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160829134531 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_B08E074EC0EB25A3 ON email_address (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4534432C0EB25A3 ON company_tree (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_469F0169C0EB25A3 ON company_status (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_469F0169989D9B62 ON company_status (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFB34DC7C0EB25A3 ON company_type (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CFB34DC7989D9B62 ON company_type (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094FC0EB25A3 ON company (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E57F091C0EB25A3 ON phone_number_type (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4E57F091989D9B62 ON phone_number_type (slug)');
        $this->addSql('ALTER TABLE phone_number CHANGE extension extension VARCHAR(30) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6B01BC5BC0EB25A3 ON phone_number (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4ADAD40BC0EB25A3 ON province (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3701B297C0EB25A3 ON timezone (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4180C698C0EB25A3 ON locale (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_172E47E6C0EB25A3 ON region_item_type (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_172E47E6989D9B62 ON region_item_type (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F62F176C0EB25A3 ON region (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6BD3229C0EB25A3 ON region_item (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B0234C0EB25A3 ON city (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92093F9AC0EB25A3 ON language_ (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F81C0EB25A3 ON address (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F19287C2C0EB25A3 ON address_type (name_)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F19287C2989D9B62 ON address_type (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5373C966C0EB25A3 ON country (name_)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_D4E6F81C0EB25A3 ON address');
        $this->addSql('DROP INDEX UNIQ_F19287C2C0EB25A3 ON address_type');
        $this->addSql('DROP INDEX UNIQ_F19287C2989D9B62 ON address_type');
        $this->addSql('DROP INDEX UNIQ_2D5B0234C0EB25A3 ON city');
        $this->addSql('DROP INDEX UNIQ_4FBF094FC0EB25A3 ON company');
        $this->addSql('DROP INDEX UNIQ_469F0169C0EB25A3 ON company_status');
        $this->addSql('DROP INDEX UNIQ_469F0169989D9B62 ON company_status');
        $this->addSql('DROP INDEX UNIQ_F4534432C0EB25A3 ON company_tree');
        $this->addSql('DROP INDEX UNIQ_CFB34DC7C0EB25A3 ON company_type');
        $this->addSql('DROP INDEX UNIQ_CFB34DC7989D9B62 ON company_type');
        $this->addSql('DROP INDEX UNIQ_5373C966C0EB25A3 ON country');
        $this->addSql('DROP INDEX UNIQ_B08E074EC0EB25A3 ON email_address');
        $this->addSql('DROP INDEX UNIQ_92093F9AC0EB25A3 ON language_');
        $this->addSql('DROP INDEX UNIQ_4180C698C0EB25A3 ON locale');
        $this->addSql('DROP INDEX UNIQ_6B01BC5BC0EB25A3 ON phone_number');
        $this->addSql('ALTER TABLE phone_number CHANGE extension extension VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_4E57F091C0EB25A3 ON phone_number_type');
        $this->addSql('DROP INDEX UNIQ_4E57F091989D9B62 ON phone_number_type');
        $this->addSql('DROP INDEX UNIQ_4ADAD40BC0EB25A3 ON province');
        $this->addSql('DROP INDEX UNIQ_F62F176C0EB25A3 ON region');
        $this->addSql('DROP INDEX UNIQ_C6BD3229C0EB25A3 ON region_item');
        $this->addSql('DROP INDEX UNIQ_172E47E6C0EB25A3 ON region_item_type');
        $this->addSql('DROP INDEX UNIQ_172E47E6989D9B62 ON region_item_type');
        $this->addSql('DROP INDEX UNIQ_3701B297C0EB25A3 ON timezone');
    }
}
