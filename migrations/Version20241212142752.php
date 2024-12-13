<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20241212142752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE trade (id INT NOT NULL, number VARCHAR(10) NOT NULL, date DATE NOT NULL, note VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E1A436696901F54 ON trade (number)');

        $this->addSql('CREATE TABLE transaction (id INT NOT NULL, trade_id INT NOT NULL, client_name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, commodity VARCHAR(255) NOT NULL, volume INT NOT NULL, type VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_723705D1C2D9760 ON transaction (trade_id)');

        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C2D9760 FOREIGN KEY (trade_id) REFERENCES trade (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D1C2D9760');
        $this->addSql('DROP TABLE trade');
        $this->addSql('DROP TABLE transaction');
    }
}
