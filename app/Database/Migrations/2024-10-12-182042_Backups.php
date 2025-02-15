<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Backups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'backup_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'backup_file_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('backup_id', true);
        $this->forge->createTable('backups');
    }

    public function down()
    {
        $this->forge->dropTable('backups');
    }
}
