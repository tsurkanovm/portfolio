<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170531085352 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, name VARCHAR(20) NOT NULL, full_name VARCHAR(40) DEFAULT NULL, description LONGTEXT DEFAULT NULL, work_description LONGTEXT DEFAULT NULL, my_role LONGTEXT DEFAULT NULL, challenge LONGTEXT DEFAULT NULL, weight SMALLINT DEFAULT 0 NOT NULL, status TINYINT(1) DEFAULT \'0\' NOT NULL, display_on_home_page TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX name_idx (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_solution (project_id INT NOT NULL, solution_id INT NOT NULL, INDEX IDX_A27DA200166D1F9C (project_id), INDEX IDX_A27DA2001C0BE183 (solution_id), PRIMARY KEY(project_id, solution_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solutions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_solution ADD CONSTRAINT FK_A27DA200166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE project_solution ADD CONSTRAINT FK_A27DA2001C0BE183 FOREIGN KEY (solution_id) REFERENCES solutions (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project_solution DROP FOREIGN KEY FK_A27DA200166D1F9C');
        $this->addSql('ALTER TABLE project_solution DROP FOREIGN KEY FK_A27DA2001C0BE183');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE project_solution');
        $this->addSql('DROP TABLE solutions');
    }
}
