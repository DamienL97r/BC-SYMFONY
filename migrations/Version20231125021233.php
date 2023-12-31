<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231125021233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE selection ADD order_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE selection ADD CONSTRAINT FK_96A50CD7FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_96A50CD7FCDAEAAA ON selection (order_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE selection DROP FOREIGN KEY FK_96A50CD7FCDAEAAA');
        $this->addSql('DROP INDEX UNIQ_96A50CD7FCDAEAAA ON selection');
        $this->addSql('ALTER TABLE selection DROP order_id_id');
    }
}
