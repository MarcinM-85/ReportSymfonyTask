<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251118120834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, place_id INT NOT NULL, name VARCHAR(255) NOT NULL, export_date_time DATETIME NOT NULL, INDEX IDX_C42F7784A76ED395 (user_id), INDEX IDX_C42F7784DA6A219 (place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');

        $this->initalData();
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784DA6A219');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
    
    protected function initalData(): void
    {
        $this->addSql(<<<'SQL'
            INSERT INTO `user` (`id`, `name`) VALUES
                (1, 'User 1'),
                (2, 'User 2')
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO `place` (`id`, `name`) VALUES
                (1, 'Lokal 1'),
                (2, 'Lokal 2')
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO `report` (`id`, `user_id`, `place_id`, `name`, `export_date_time`) VALUES
                (1, 1, 1, 'Test', '2025-11-02 13:31:24'),
                (2, 1, 2, 'Test', '2025-11-12 13:31:40'),
                (3, 1, 2, 'Nowy raport', '2025-11-17 18:27:00'),
                (4, 2, 2, 'Nowy raport', '2025-11-18 16:47:03'),
                (5, 2, 2, 'Nowy raport', '2025-11-19 12:00:00'),
                (6, 1, 1, 'Nowy raport', '2025-11-19 22:00:00'),
                (7, 1, 1, 'Nowy raport', '2025-11-20 08:15:00'),
                (8, 2, 2, 'Nowy raport', '2025-11-20 10:00:00')
        SQL);
        
    }
}
