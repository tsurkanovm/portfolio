<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170726152457 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE file_storage (
                     id INT AUTO_INCREMENT NOT NULL, 
                     updated DATETIME NOT NULL, 
                     file_name VARCHAR(255) DEFAULT NULL, 
                     file_original_name VARCHAR(255) DEFAULT NULL, 
                     file_mime_type VARCHAR(255) DEFAULT NULL, 
                     file_size INT DEFAULT NULL, 
                     PRIMARY KEY(id)) 
                     DEFAULT CHARACTER SET utf8 
                     COLLATE utf8_unicode_ci 
                     ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE solutions ADD logo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE solutions ADD CONSTRAINT FK_A90F77EF98F144A FOREIGN KEY (logo_id) REFERENCES file_storage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A90F77EF98F144A ON solutions (logo_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE solutions DROP FOREIGN KEY FK_A90F77EF98F144A');
        $this->addSql('DROP TABLE file_storage');
        $this->addSql('DROP INDEX UNIQ_A90F77EF98F144A ON solutions');
        $this->addSql('ALTER TABLE solutions DROP logo_id');
    }
}
