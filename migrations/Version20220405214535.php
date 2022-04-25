<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405214535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE part (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, active INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE part_vehicle (part_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_9BDC138D4CE34BEC (part_id), INDEX IDX_9BDC138D545317D1 (vehicle_id), PRIMARY KEY(part_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, bike_producer VARCHAR(255) DEFAULT NULL, series VARCHAR(255) DEFAULT NULL, size VARCHAR(255) DEFAULT NULL, configuration VARCHAR(255) DEFAULT NULL, bike_model VARCHAR(255) DEFAULT NULL, sales_name VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, cylinder VARCHAR(255) DEFAULT NULL, typeof_drive VARCHAR(255) DEFAULT NULL, engine_output VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, category1 VARCHAR(255) DEFAULT NULL, category2 VARCHAR(255) DEFAULT NULL, uuid INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE part_vehicle ADD CONSTRAINT FK_9BDC138D4CE34BEC FOREIGN KEY (part_id) REFERENCES part (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE part_vehicle ADD CONSTRAINT FK_9BDC138D545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE part_vehicle DROP FOREIGN KEY FK_9BDC138D4CE34BEC');
        $this->addSql('ALTER TABLE part_vehicle DROP FOREIGN KEY FK_9BDC138D545317D1');
        $this->addSql('DROP TABLE part');
        $this->addSql('DROP TABLE part_vehicle');
        $this->addSql('DROP TABLE vehicle');
    }
}
