<?php

use Phinx\Migration\AbstractMigration;

class CreateDatabaseSchema extends AbstractMigration
{
    public function change()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `documents` (
                `id` CHAR(36) NOT NULL,
                `status` ENUM('draft','published') NOT NULL DEFAULT 'draft',
                `payload` TEXT NOT NULL,
                `createAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `modifyAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }
}
