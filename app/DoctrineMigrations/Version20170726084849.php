<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170726084849 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE solutions ADD updated DATETIME NOT NULL, 
                           ADD image_name VARCHAR(255) DEFAULT NULL,
                           ADD image_original_name VARCHAR(255) DEFAULT NULL, 
                           ADD image_mime_type VARCHAR(255) DEFAULT NULL,
                           ADD image_size INT DEFAULT NULL'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE solutions DROP updated, 
                           DROP image_name, 
                           DROP image_original_name, 
                           DROP image_mime_type, 
                           DROP image_size'
        );
    }
}
