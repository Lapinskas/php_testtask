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
                `data` TEXT NOT NULL,
                `created` BIGINT NOT NULL,
                `modified` BIGINT NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }
}
