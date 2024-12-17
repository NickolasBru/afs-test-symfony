<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241217123456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make id columns auto-incrementing for trade and transaction tables';
    }

    public function up(Schema $schema): void
    {
        // Create sequence for 'trade' table
        $this->addSql('CREATE SEQUENCE trade_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE trade ALTER COLUMN id SET DEFAULT nextval(\'trade_id_seq\')');

        // Create sequence for 'transaction' table
        $this->addSql('CREATE SEQUENCE transaction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE transaction ALTER COLUMN id SET DEFAULT nextval(\'transaction_id_seq\')');
    }

    public function down(Schema $schema): void
    {
        // Remove sequences and auto-increment settings
        $this->addSql('ALTER TABLE trade ALTER COLUMN id DROP DEFAULT');
        $this->addSql('DROP SEQUENCE trade_id_seq');

        $this->addSql('ALTER TABLE transaction ALTER COLUMN id DROP DEFAULT');
        $this->addSql('DROP SEQUENCE transaction_id_seq');
    }
}
