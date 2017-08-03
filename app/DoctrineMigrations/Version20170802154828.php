<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170802154828 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects ADD image_template_id INT DEFAULT NULL, ADD image_logo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4CA0C4436 FOREIGN KEY (image_template_id) REFERENCES file_storage (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A46C9F4396 FOREIGN KEY (image_logo_id) REFERENCES file_storage (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C93B3A4CA0C4436 ON projects (image_template_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5C93B3A46C9F4396 ON projects (image_logo_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4CA0C4436');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A46C9F4396');
        $this->addSql('DROP INDEX UNIQ_5C93B3A4CA0C4436 ON projects');
        $this->addSql('DROP INDEX UNIQ_5C93B3A46C9F4396 ON projects');
        $this->addSql('ALTER TABLE projects DROP image_template_id, DROP image_logo_id');
    }
}
