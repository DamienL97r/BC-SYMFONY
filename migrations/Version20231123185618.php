<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123185618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE selection ADD employee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE selection ADD CONSTRAINT FK_96A50CD78C03F15C FOREIGN KEY (employee_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_96A50CD78C03F15C ON selection (employee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE selection DROP FOREIGN KEY FK_96A50CD78C03F15C');
        $this->addSql('DROP INDEX IDX_96A50CD78C03F15C ON selection');
        $this->addSql('ALTER TABLE selection DROP employee_id');
    }
}
